<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    $page_size = GZ_Api::$pagination['count'];
    $page = GZ_Api::$pagination['page'];

    if((int)$page < 1)
        GZ_Api::outPut(101);

    $category_id = _POST('category_id', 0);
    $sort_by = _POST('sort_by', 'default');

    if($sort_by == 'sales_desc'){
        $out = get_category_goods_by_page_order_by_sales($category_id, $page, $page_size);
    }else{
        $out = get_category_goods_by_page_order_by_style($category_id, $page, $page_size, $sort_by);
    }

    GZ_Api::outPut($out['goods'], $out['pager']);


    /**
     * 查询指定页数的分类下商品列表 并按一定规则排序
     *
     * @access  public
     * @param   string      $category_id    分类ID
     * @params  integer     $page
     * @params  integer     $page_size
     * @params  string      $sort_by        default:默认 price_asc:价格升序 price_desc:价格降序
     * @return  array
     */
    function get_category_goods_by_page_order_by_style($category_id, $page, $page_size, $sort_by = 'default')
    {
        $sql_get_count = 'SELECT COUNT(*) ' .
            ' FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
            ' LEFT JOIN ' . $GLOBALS['ecs']->table('brand') . ' AS b ON b.brand_id = g.brand_id ' .
            ' WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.cat_id = ' . $category_id . ' ';

        $count = $GLOBALS['db']->getOne($sql_get_count);
        $page_count = ($count > 0) ? intval(ceil($count / $page_size)) : 1;

        $sql = 'SELECT g.goods_id, g.goods_name, g.goods_name_style, g.market_price, g.shop_price AS org_price, g.promote_price, ' .
            "IFNULL(mp.user_price, g.shop_price * '$_SESSION[discount]') AS shop_price, ".
            "promote_start_date, promote_end_date, g.goods_brief, g.goods_thumb, g.goods_img, RAND() AS rnd " .
            'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
            "LEFT JOIN " . $GLOBALS['ecs']->table('member_price') . " AS mp ".
            "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' ";
        if ($sort_by == 'default') {
            $sql .= 'ORDER BY g.sort_order, g.last_update DESC';        // 默认排序
        } elseif ($sort_by == 'price_asc') {
            $sql .= 'ORDER BY g.shop_price ASC';                     // 价格升序
        } elseif ($sort_by == 'price_desc') {
            $sql .= 'ORDER BY g.shop_price DESC';                    // 价格降序
        }

        $arr_goods = $GLOBALS['db']->getAll($sql);

        $arr_goods = array_slice($arr_goods, ($page-1) * $page_size, $page_size);
        $ret_goods = array();

        if ( !empty($arr_goods) ) {
            foreach ($arr_goods AS $idx => $row) {
                if ($row['promote_price'] > 0) {
                    $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
                    $ret_goods[$idx]['promote_price'] = $promote_price > 0 ? price_format($promote_price) : '';
                } else {
                    $ret_goods[$idx]['promote_price'] = '';
                }

                $ret_goods[$idx]['id'] = $row['goods_id'];
                $ret_goods[$idx]['name'] = $row['goods_name'];
                $ret_goods[$idx]['brief'] = $row['goods_brief'];
                $ret_goods[$idx]['brand_name'] = isset($goods_data['brand'][$row['goods_id']]) ? $goods_data['brand'][$row['goods_id']] : '';
                $ret_goods[$idx]['goods_style_name'] = add_style($row['goods_name'], $row['goods_name_style']);

                $ret_goods[$idx]['short_name'] = $GLOBALS['_CFG']['goods_name_length'] > 0 ?
                    sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
                $ret_goods[$idx]['short_style_name'] = add_style($ret_goods[$idx]['short_name'], $row['goods_name_style']);
                $ret_goods[$idx]['market_price'] = price_format($row['market_price']);
                $ret_goods[$idx]['shop_price'] = price_format($row['shop_price']);
                $ret_goods[$idx]['thumb'] = get_image_path($row['goods_id'], $row['goods_thumb'], true);
                $ret_goods[$idx]['goods_thumb'] = get_image_path($row['goods_id'], $row['goods_thumb'], true);
                $ret_goods[$idx]['goods_img'] = get_image_path($row['goods_id'], $row['goods_img']);
                $ret_goods[$idx]['original_img'] = get_image_path($row['goods_id'], $row['original_img']);
                $ret_goods[$idx]['url'] = build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']);
            }
        }

        $pager = array(
            "total"  => $count,
            "count"  => count($ret_goods),
            "more"   => $page < $page_count ? 1 : 0
        );

        $cmt = array('goods' => array_values($ret_goods), 'pager' => $pager);

        return $cmt;
    }

    /**
     * 查询指定页数的分类下商品列表 并按销量从低到高排序
     *
     * @access  public
     * @param   string      $category_id   推荐类型，可以是 best, new, hot
     * @params  integer     $page
     * @params  integer     $page_size
     * @return  array
     */
    function get_category_goods_by_page_order_by_sales($category_id, $page = 1, $page_size = 10)
    {
        $sql_get_count = 'SELECT COUNT(*) ' .
            ' FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
            ' LEFT JOIN ' . $GLOBALS['ecs']->table('brand') . ' AS b ON b.brand_id = g.brand_id ' .
            ' WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.cat_id = ' . $category_id . ' ';

        $count = $GLOBALS['db']->getOne($sql_get_count);
        $page_count = ($count > 0) ? intval(ceil($count / $page_size)) : 1;

        /* 排行统计的时间 */
        switch ($GLOBALS['_CFG']['top10_time'])
        {
            case 1: // 一年
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 365 * 86400) . "'";
                break;
            case 2: // 半年
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 180 * 86400) . "'";
                break;
            case 3: // 三个月
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 90 * 86400) . "'";
                break;
            case 4: // 一个月
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 30 * 86400) . "'";
                break;
            default:
                $top10_time = '';
        }

        $sql = 'SELECT g.goods_id, g.goods_name, g.goods_name_style, g.market_price, g.shop_price AS org_price, g.promote_price, ' .
            "IFNULL(mp.user_price, g.shop_price * '$_SESSION[discount]') AS shop_price, ".
            "promote_start_date, promote_end_date, g.goods_brief, g.goods_thumb, goods_img, g.original_img, b.brand_name, " .
            "g.is_best, g.is_new, g.is_hot, g.is_promote, RAND() AS rnd " .
            'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
            "LEFT JOIN " . $GLOBALS['ecs']->table('brand') . " AS b ON b.brand_id = g.brand_id " .
            "LEFT JOIN " . $GLOBALS['ecs']->table('member_price') . " AS mp ".
            "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' ".
            "LEFT JOIN " . $GLOBALS['ecs']->table('order_goods') . " AS og ON og.goods_id = g.goods_id ".
            "LEFT JOIN " . $GLOBALS['ecs']->table('order_info') . " AS o ON o.order_id = og.order_id ".
            'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ' .
            "AND g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 $top10_time " ;
        //判断是否启用库存，库存数量是否大于0
        if ($GLOBALS['_CFG']['use_storage'] == 1)
        {
            $sql .= " AND g.goods_number > 0 ";
        }
        //$sql .= "AND (o.order_status = '" . OS_CONFIRMED .  "' OR o.order_status = '" . OS_SPLITED . "') " .
        //    "AND (o.pay_status = '" . PS_PAYED . "' OR o.pay_status = '" . PS_PAYING . "') " .
        //    "AND (o.shipping_status = '" . SS_SHIPPED . "' OR o.shipping_status = '" . SS_RECEIVED . "') ";

        $sql .= 'AND g.cat_id = ' . $category_id;
        $sql .= ' GROUP BY g.goods_id ORDER BY og.goods_number DESC, g.goods_id DESC ';

        $res = $GLOBALS['db']->selectLimit($sql, $page_size, ($page-1) * $page_size);

        $arr = array();
        while ($row = $GLOBALS['db']->fetchRow($res))
        {
            $arr[] = array(
                'id'=>$row['goods_id'],
                'name'=>$row['goods_name'],
                'market_price'=>$row['market_price'],
                'shop_price'=>$row['shop_price'],
                'promote_price'=>$row['promote_price'],
                'brief'=>$row['goods_brief'],
                'img'=> array(
                    'small'=>API_DATA('PHOTO', get_image_path($row['goods_id'], $row['goods_thumb'], true)),
                    'thumb'=>API_DATA('PHOTO', get_image_path($row['goods_id'], $row['goods_img'])),
                    'url'=>API_DATA('PHOTO', get_image_path($row['goods_id'], $row['original_img']))
                )
            );
        }

        $pager = array(
            "total"  => $count,
            "count"  => count($arr),
            "more"   => $page < $page_count ? 1 : 0
        );

        $cmt = array('goods' => array_values($arr), 'pager' => $pager);

        return $cmt;
    }

?>