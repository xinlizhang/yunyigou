<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

	GZ_Api::authSession();

    $user_id = $_SESSION['user_id'];

    include_once(EC_PATH . '/includes/lib_order.php');
    include_once(EC_PATH . '/includes/lib_clips.php');
    include_once(EC_PATH . '/includes/lib_payment.php');

	$order_id = _POST('order_id', 0);
	if (!$order_id) 
	{
		GZ_Api::outPut(101);
	}

	/* 订单详情 */
	$order = get_order_detail($order_id, $user_id);
    if( $order != false )
    {
        $goods_list = GZ_order_goods($order_id);
        $goods_list_t = array();
        foreach ($goods_list as $v) {
            $goods_list_t[] = array(
                "goods_id" => $v['goods_id'],
                "name" => $v['goods_name'],
                "goods_number" => $v['goods_number'],
                "subtotal" => price_format($v['subtotal'], false),
                "formated_shop_price" => price_format($v['goods_price'], false),
                "img" => array(
                    'small' => API_DATA('PHOTO', $v['goods_thumb']),
                    'thumb' => API_DATA('PHOTO', $v['goods_img']),
                    'url' => API_DATA('PHOTO', $v['original_img'])
                )
            );
        }
        $order['goods_list'] = $goods_list_t;
    }

    GZ_Api::outPut($order);