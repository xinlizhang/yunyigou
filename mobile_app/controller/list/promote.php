<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    $page_size = GZ_Api::$pagination['count'];
    $page = GZ_Api::$pagination['page'];

    if((int)$page < 1)
        GZ_Api::outPut(101);

    $sort_by = _POST('sort_by', 'default');

    if($sort_by == 'sales_desc'){
        $out = get_promote_goods_by_page_order_by_sales($page, $page_size);
    }else{
        $out = get_promote_goods_by_page_order_by_style($page, $page_size, $sort_by);
    }

    GZ_Api::outPut($out['goods'], $out['pager']);



/**
 * 查询指定页数的限时打折商品 并按一定规则排序
 *
 * @access  public
 * @params  integer     $page
 * @params  integer     $page_size
 * @params  string      $sort_by    default:默认 price_asc:价格升序 price_desc:价格降序
 * @return  array
 */
function get_promote_goods_by_page_order_by_style($page = 1, $page_size = 10, $sort_by = 'default')
{
    $time = gmtime();

    $count = $GLOBALS['db']->getOne('SELECT COUNT(*) ' .
        'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
        'LEFT JOIN ' . $GLOBALS['ecs']->table('brand') . ' AS b ON b.brand_id = g.brand_id ' .
        "LEFT JOIN " . $GLOBALS['ecs']->table('member_price') . " AS mp ".
        "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' ".
        'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ' .
        " AND g.is_promote = 1 AND promote_start_date <= '$time' AND promote_end_date >= '$time' ");

    $page_count = ($count > 0) ? intval(ceil($count / $page_size)) : 1;

    $sql = 'SELECT g.goods_id, g.goods_name, g.goods_name_style, g.market_price, g.shop_price AS org_price, g.promote_price, ' .
        "IFNULL(mp.user_price, g.shop_price * '$_SESSION[discount]') AS shop_price, ".
        "promote_start_date, promote_end_date, g.goods_brief, g.goods_thumb, goods_img, g.original_img, b.brand_name, " .
        "g.is_best, g.is_new, g.is_hot, g.is_promote, RAND() AS rnd " .
        'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
        'LEFT JOIN ' . $GLOBALS['ecs']->table('brand') . ' AS b ON b.brand_id = g.brand_id ' .
        "LEFT JOIN " . $GLOBALS['ecs']->table('member_price') . " AS mp ".
        "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' ".
        'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ' .
        " AND g.is_promote = 1 AND promote_start_date <= '$time' AND promote_end_date >= '$time' ";

    if ($sort_by == 'default') {
        $sql .= 'ORDER BY g.goods_id DESC';              // 默认排序
    } elseif ($sort_by == 'price_asc') {
        $sql .= 'ORDER BY g.promote_price ASC';          // 价格升序
    } elseif ($sort_by == 'price_desc') {
        $sql .= 'ORDER BY g.promote_price DESC';         // 价格降序
    }

    $res = $GLOBALS['db']->selectLimit($sql, $page_size, ($page-1) * $page_size);

    $arr = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $promote_price = '';
        if ($row['promote_price'] > 0)
        {
            $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
        }

        $arr[] = array(
            'id'=>$row['goods_id'],
            'name'=>$row['goods_name'],
            'market_price'=>$row['market_price'],
            'shop_price'=>$row['shop_price'],
            'promote_price'=>$promote_price,
            'promote_start_date'=>$row['promote_start_date'],
            'promote_end_date'=>$row['promote_end_date'],
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
 * 查询指定页数的限时打折商品 并按销量由低到高排序
 *
 * @access  public
 * @params  integer     $page
 * @params  integer     $page_size
 * @return  array
 */
function get_promote_goods_by_page_order_by_sales($page = 1, $page_size = 10)
{
    $time = gmtime();

    $count = $GLOBALS['db']->getOne('SELECT COUNT(*) ' .
        'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
        'LEFT JOIN ' . $GLOBALS['ecs']->table('brand') . ' AS b ON b.brand_id = g.brand_id ' .
        "LEFT JOIN " . $GLOBALS['ecs']->table('member_price') . " AS mp ".
        "ON mp.goods_id = g.goods_id AND mp.user_rank = '$_SESSION[user_rank]' ".
        'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ' .
        " AND g.is_promote = 1 AND promote_start_date <= '$time' AND promote_end_date >= '$time' ");

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
        "AND g.is_promote = 1 AND promote_start_date <= '$time' AND promote_end_date >= '$time' ".
        "AND g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 $where $top10_time " ;
    //判断是否启用库存，库存数量是否大于0
    if ($GLOBALS['_CFG']['use_storage'] == 1)
    {
        $sql .= " AND g.goods_number > 0 ";
    }
    //$sql .= "AND (o.order_status = '" . OS_CONFIRMED .  "' OR o.order_status = '" . OS_SPLITED . "') " .
    //    "AND (o.pay_status = '" . PS_PAYED . "' OR o.pay_status = '" . PS_PAYING . "') " .
    //    "AND (o.shipping_status = '" . SS_SHIPPED . "' OR o.shipping_status = '" . SS_RECEIVED . "') " .
    $sql .= 'GROUP BY g.goods_id ORDER BY og.goods_number DESC, g.goods_id DESC ';

    $res = $GLOBALS['db']->selectLimit($sql, $page_size, ($page-1) * $page_size);

    $arr = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $promote_price = '';
        if ($row['promote_price'] > 0)
        {
            $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
        }

        $arr[] = array(
            'id'=>$row['goods_id'],
            'name'=>$row['goods_name'],
            'market_price'=>$row['market_price'],
            'shop_price'=>$row['shop_price'],
            'promote_price'=>$promote_price,
            'promote_start_date'=>$row['promote_start_date'],
            'promote_end_date'=>$row['promote_end_date'],
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