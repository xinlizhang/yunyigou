<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();
    $user_id = $_SESSION['user_id'];

    require_once(EC_PATH . '/languages/' .$_CFG['lang']. '/user.php');
    include_once(EC_PATH . '/includes/lib_order.php');
    include_once(EC_PATH . '/includes/lib_clips.php');
    include_once(EC_PATH . '/includes/lib_payment.php');

    $page_parm = GZ_Api::$pagination;
    $page = $page_parm['page'];
    $type = _POST('type', '');
    //await_pay 待付款
    //await_ship 待发货
    //shipped 待收货
    //finished 历史订单
    if (!in_array($type, array('await_pay', 'await_ship', 'shipped', 'finished', 'unconfirmed','')))
    {
        GZ_Api::outPut(101);
    }
    $record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = '$user_id'". GZ_order_query_sql($type));
    $pager  = get_pager('user.php', array('act' => $action), $record_count, $page, $page_parm['count']);
    $orders = GZ_get_user_orders($user_id, $pager['size'], $pager['start'], $type);
    // print_r($orders);exit;
    foreach ($orders as $key => $value) {
        unset($orders[$key]['order_status']);
        $orders[$key]['order_time'] = formatTime($value['order_time']);
        $goods_list = GZ_order_goods($value['order_id']);
        //$orders[$key]['ss'] = $goods_list;
        $goods_list_t = array();
        // $goods_list = API_DATA("SIMPLEGOODS", $goods_list);
        foreach ($goods_list as $v) {
            $goods_list_t[] = array(
              "goods_id" => $v['goods_id'],
              "name" => $v['goods_name'],
              "goods_number" => $v['goods_number'],
              "subtotal" => price_format($v['subtotal'], false),
              "formated_shop_price" => price_format($v['goods_price'], false),
              "img" => array(
                'small'=>API_DATA('PHOTO', $v['goods_thumb']),
                'thumb'=>API_DATA('PHOTO', $v['goods_img']),
                'url' => API_DATA('PHOTO', $v['original_img'])
                )
            );
        }

        // 商品列表
        $orders[$key]['goods_list'] = $goods_list_t;

        // 订单金额
        $order_detail = get_order_detail($value['order_id'], $user_id);

        $orders[$key]['formated_integral_money']   = $order_detail['formated_integral_money'];//积分 钱
        $orders[$key]['formated_bonus']   = $order_detail['formated_bonus'];//红包 钱
        $orders[$key]['formated_shipping_fee']   = $order_detail['formated_shipping_fee'];//运送费

        // 支付相关
        if ($order_detail['pay_id'] > 0) {
          $payment = payment_info($order_detail['pay_id']);
        }

        // 商品概览
        $subject = $orders[$key]['goods_list'][0]['name'].'等'.count($orders[$key]['goods_list']).'种商品';

        // 订单信息
        $orders[$key]['order_info'] = array(
            'pay_id' => $payment['pay_id'],
            'pay_name' => $payment['pay_name'],
            'pay_code' => $payment['pay_code'],
            'shipping_id' =>  $order_detail['shipping_id'],
            'shipping_name' =>  $order_detail['shipping_name'],
            'order_amount' => $order_detail['order_amount'],
            'order_id' => $order_detail['order_id'],
            'subject' => $subject,
            'desc' => $subject,
            'order_sn' => $order_detail['order_sn']
         );

        // 收货人信息
        $country = $order_detail['country'];
        $sql1 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$country'";
        $country = $GLOBALS['db']->getAll($sql1);
        $order_detail['country_name'] = $country[0]['region_name'];

        $province = $order_detail['province'];
        $sql2 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$province'";
        $province = $GLOBALS['db']->getAll($sql2);
        $order_detail['province_name'] = $province[0]['region_name'];

        $city = $order_detail['city'];
        $sql3 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$city'";
        $city = $GLOBALS['db']->getAll($sql3);
        $order_detail['city_name'] = $city[0]['region_name'];

        $district = $order_detail['district'];
        $sql4 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$district'";
        $district = $GLOBALS['db']->getAll($sql4);
        $order_detail['district_name'] = $district[0]['region_name'];

        $orders[$key]['addr_info'] = array(
            'consignee' => $order_detail['consignee'],
            'country_name' => $order_detail['country_name'],
            'province_name' => $order_detail['province_name'],
            'city_name' =>  $order_detail['city_name'],
            'district_name' =>  $order_detail['district_name'],
            'address' => $order_detail['address'],
            'zipcode' => $order_detail['zipcode'],
            'tel' => $order_detail['tel'],
            'mobile' => $order_detail['mobile'],
            'email' => $order_detail['email'],
            'best_time' => $order_detail['best_time'],
            'sign_building' => $order_detail['sign_building'],
            'postscript' => $order_detail['postscript'],
        );
    }
    // print_r($orders);exit;
    $pagero = array(
        "total"  => $pager['record_count'],
        "count"  => count($orders),
        "more"   => empty($pager['page_next']) ? 0 : 1
    );
    GZ_Api::outPut($orders, $pagero);

