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
        $out = get_type_goods_by_page_order_by_sales('hot', $page, $page_size);
    }else{
        $out = get_type_goods_by_page_order_by_style('hot', $page, $page_size, $sort_by);
    }

    GZ_Api::outPut($out['goods'], $out['pager']);
