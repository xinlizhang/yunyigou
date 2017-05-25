<?php

/**
 * 取得购物车商品
 * @param   int     $type   类型：默认普通商品
 * @return  array   购物车商品数组
 */
function cart_goods_withPic($type = CART_GENERAL_GOODS)
{
    $sql = "SELECT rec_id, user_id, goods_id, goods_name, goods_sn, goods_number, " .
        "market_price, goods_price, goods_attr, is_real, extension_code, parent_id, is_gift, is_shipping, " .
        "goods_price * goods_number AS subtotal " .
        "FROM " . $GLOBALS['ecs']->table('cart') .
        " WHERE session_id = '" . SESS_ID . "' " .
        "AND rec_type = '$type'";

    $arr = $GLOBALS['db']->getAll($sql);

    /* 格式化价格及礼包商品 */
    foreach ($arr as $key => $value)
    {
        $arr[$key]['formated_market_price'] = price_format($value['market_price'], false);
        $arr[$key]['formated_goods_price']  = price_format($value['goods_price'], false);
        $arr[$key]['formated_subtotal']     = price_format($value['subtotal'], false);

        if ($value['extension_code'] == 'package_buy')
        {
            $arr[$key]['package_goods_list'] = get_package_goods($value['goods_id']);
        }

        // 商品图片
        $goods_thumb = $GLOBALS['db']->getOne("SELECT `goods_thumb` FROM " . $GLOBALS['ecs']->table('goods') . " WHERE `goods_id`='{$value['goods_id']}'");
        $goods_img = $GLOBALS['db']->getOne("SELECT `goods_img` FROM " . $GLOBALS['ecs']->table('goods') . " WHERE `goods_id`='{$value['goods_id']}'");
        $original_img = $GLOBALS['db']->getOne("SELECT `original_img` FROM " . $GLOBALS['ecs']->table('goods') . " WHERE `goods_id`='{$value['goods_id']}'");

        $arr[$key]['img']['small'] = API_DATA('PHOTO', get_image_path($value['goods_id'], $goods_thumb, true));
        $arr[$key]['img']['thumb'] = API_DATA('PHOTO', get_image_path($value['goods_id'], $goods_img, true));
        $arr[$key]['img']['url'] = API_DATA('PHOTO', get_image_path($value['goods_id'], $original_img, true));

    }

    return $arr;
}

/**
 * 查询某类商品的全列表
 *
 * @access  public
 * @param   string      $type       推荐类型，可以是 best, new, hot
 * @params  string      $sort_by    default:默认 price_asc:价格升序 price_desc:价格降序
 * @return  array
 */
function get_goods_by_type($type = '', $sort_by = 'default')
{
    if (!in_array($type, array('best', 'new', 'hot')))
        return array();

    $sql = 'SELECT * ' .
        ' FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
        ' WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ';

    if ($type == 'best') {
        $sql .= ' AND is_best = 1 ';
    } elseif ($type == 'new') {
        $sql .= ' AND is_new = 1 ';
    } elseif ($type == 'hot') {
        $sql .= ' AND is_hot = 1 ';
    }

    if ($sort_by == 'default') {
        $sql .= 'ORDER BY g.sort_order, g.last_update DESC';        // 默认排序
    } elseif ($sort_by == 'price_asc') {
        $sql .= 'ORDER BY g.shop_price ASC';                        // 价格升序
    } elseif ($sort_by == 'price_desc') {
        $sql .= 'ORDER BY g.shop_price DESC';                       // 价格降序
    }

    //取不同推荐对应的商品
    $type_goods = array();
    $result = $GLOBALS['db']->getAll($sql);
    foreach ($result AS $idx => $row)
    {
        if ($row['promote_price'] > 0)
        {
            $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
            $goods[$idx]['promote_price'] = $promote_price > 0 ? price_format($promote_price) : '';
        }
        else
        {
            $goods[$idx]['promote_price'] = '';
        }

        $goods[$idx]['id']           = $row['goods_id'];
        $goods[$idx]['name']         = $row['goods_name'];
        $goods[$idx]['brief']        = $row['goods_brief'];
        $goods[$idx]['goods_style_name']   = add_style($row['goods_name'],$row['goods_name_style']);

        $goods[$idx]['short_name']   = $GLOBALS['_CFG']['goods_name_length'] > 0 ?
            sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
        $goods[$idx]['short_style_name']   = add_style($goods[$idx]['short_name'],$row['goods_name_style']);
        $goods[$idx]['market_price'] = price_format($row['market_price']);
        $goods[$idx]['shop_price']   = price_format($row['shop_price']);
        $goods[$idx]['thumb']        = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $goods[$idx]['goods_thumb']        = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $goods[$idx]['goods_img']    = get_image_path($row['goods_id'], $row['goods_img']);
        $goods[$idx]['original_img']    = get_image_path($row['goods_id'], $row['original_img']);
        $goods[$idx]['url']          = build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']);

        $type_goods[] = $goods[$idx];
    }

    return $type_goods;
}

/**
 * 查询指定页数的某类商品 并按一定规则排序
 *
 * @access  public
 * @param   string      $type       推荐类型，可以是 best, new, hot
 * @params  integer     $page
 * @params  integer     $page_size
 * @params  string      $sort_by    default:默认 price_asc:价格升序 price_desc:价格降序
 * @return  array
 */
function get_type_goods_by_page_order_by_style($type = '', $page, $page_size, $sort_by = 'default')
{
    if (!in_array($type, array('best', 'new', 'hot')))
    {
        return array();
    }

    $sql_get_count = 'SELECT COUNT(*) ' .
        ' FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
        ' LEFT JOIN ' . $GLOBALS['ecs']->table('brand') . ' AS b ON b.brand_id = g.brand_id ' .
        ' WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0';

    switch ($type)
    {
        case 'best':
            $sql_get_count .= ' AND is_best = 1';
            $arr_goods = get_goods_by_type('best', $sort_by);
            break;
        case 'new':
            $sql_get_count .= ' AND is_new = 1';
            $arr_goods = get_goods_by_type('new', $sort_by);
            break;
        case 'hot':
            $sql_get_count .= ' AND is_hot = 1';
            $arr_goods = get_goods_by_type('hot', $sort_by);
            break;
    }

    $count = $GLOBALS['db']->getOne($sql_get_count);
    $page_count = ($count > 0) ? intval(ceil($count / $page_size)) : 1;

    $arr_goods = array_slice($arr_goods, ($page-1) * $page_size, $page_size);
    $ret_goods = array();

    if ( !empty($arr_goods) ) {
        foreach ( $arr_goods as $key => $val ) {
            $ret_goods[] = array(
                'id'=>$val['id'],
                'name'=>$val['name'],
                'market_price'=>$val['market_price'],
                'shop_price'=>$val['shop_price'],
                'promote_price'=>$val['promote_price'],
                'brief'=>$val['brief'],
                'img'=> array(
                    'small'=>API_DATA('PHOTO', $val['goods_thumb']),
                    'thumb'=>API_DATA('PHOTO', $val['goods_img']),
                    'url'=>API_DATA('PHOTO', $val['original_img'])
                )
            );
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
 * 查询指定页数的某类商品 并按销量从低到高排序
 *
 * @access  public
 * @param   string      $type       推荐类型，可以是 best, new, hot
 * @params  integer     $page
 * @params  integer     $page_size
 * @return  array
 */
function get_type_goods_by_page_order_by_sales($type = '', $page = 1, $page_size = 10)
{
    if (!in_array($type, array('best', 'new', 'hot')))
        return array();

    $sql_get_count = 'SELECT COUNT(*) ' .
        ' FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
        ' LEFT JOIN ' . $GLOBALS['ecs']->table('brand') . ' AS b ON b.brand_id = g.brand_id ' .
        ' WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ';

    switch ($type)
    {
        case 'best':
            $sql_type = 'AND g.is_best = 1 ';
            break;
        case 'new':
            $sql_type = 'AND g.is_new = 1 ';
            break;
        case 'hot':
            $sql_type = 'AND g.is_hot = 1 ';
            break;
    }

    $count = $GLOBALS['db']->getOne($sql_get_count . $sql_type);
    $page_count = ($count > 0) ? intval(ceil($count / $page_size)) : 1;

    $cats = get_children();
    $where = !empty($cats) ? "AND ($cats OR " . get_extension_goods($cats) . ") " : '';

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
        "AND g.is_alone_sale = 1 AND g.is_delete = 0 $sql_type $where $top10_time " ;
    //判断是否启用库存，库存数量是否大于0
    if ($GLOBALS['_CFG']['use_storage'] == 1)
    {
        $sql .= " AND g.goods_number > 0 ";
    }
    //$sql .= "AND (o.order_status = '" . OS_CONFIRMED .  "' OR o.order_status = '" . OS_SPLITED . "') " .
    //    "AND (o.pay_status = '" . PS_PAYED . "' OR o.pay_status = '" . PS_PAYING . "') " .
    //    "AND (o.shipping_status = '" . SS_SHIPPED . "' OR o.shipping_status = '" . SS_RECEIVED . "') ";

    $sql .= $sql_type;
    $sql .= 'GROUP BY g.goods_id ORDER BY og.goods_number DESC, g.goods_id DESC ';

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

/**
 *  获取用户指定范围的订单列表
 *
 * @access  public
 * @param   int         $user_id        用户ID号
 * @param   int         $num            列表最大数量
 * @param   int         $start          列表起始位置
 * @return  array       $order_list     订单列表
 */
function GZ_get_user_orders($user_id, $num = 10, $start = 0, $type = 'await_pay')
{
    /* 取得订单列表 */
    $arr    = array();

    $sql = "SELECT order_id, order_sn, order_status, shipping_status, pay_status, add_time, " .
        "(goods_amount + shipping_fee + insure_fee + pay_fee + pack_fee + card_fee + tax - discount) AS total_fee ".
        " FROM " .$GLOBALS['ecs']->table('order_info') .
        " WHERE user_id = '$user_id' " . GZ_order_query_sql($type) . " ORDER BY add_time DESC";
    // print_r($sql);exit;
    $res = $GLOBALS['db']->SelectLimit($sql, $num, $start);
    while ($row = $GLOBALS['db']->fetchRow($res))
    {

        $row['shipping_status'] = ($row['shipping_status'] == SS_SHIPPED_ING) ? SS_PREPARING : $row['shipping_status'];
        $row['order_status'] = $GLOBALS['_LANG']['os'][$row['order_status']] . ',' . $GLOBALS['_LANG']['ps'][$row['pay_status']] . ',' . $GLOBALS['_LANG']['ss'][$row['shipping_status']];

        $arr[] = array('order_id'       => $row['order_id'],
            'order_sn'       => $row['order_sn'],
            'order_time'     => local_date($GLOBALS['_CFG']['time_format'], $row['add_time']),
            'order_status'   => $row['order_status'],
            'total_fee'      => price_format($row['total_fee'], false));
    }

    return $arr;
}

/**
 * 取得订单商品
 * @param   int     $order_id   订单id
 * @return  array   订单商品数组
 */
function GZ_order_goods($order_id)
{
    $sql = "SELECT o.*, " .
        "o.goods_price * o.goods_number AS subtotal,g.goods_thumb,g.original_img,g.goods_img " .
        "FROM " . $GLOBALS['ecs']->table('order_goods') . " as o LEFT JOIN ".$GLOBALS['ecs']->table('goods') . " AS g ON o.goods_id = g.goods_id" .
        " WHERE o.order_id = '$order_id'";

    $res = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        if ($row['extension_code'] == 'package_buy')
        {
            $row['package_goods_list'] = get_package_goods($row['goods_id']);
        }
        $goods_list[] = $row;

    }
    //return $GLOBALS['db']->getAll($sql);
    return $goods_list;
}



