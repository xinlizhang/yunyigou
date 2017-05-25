<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

	GZ_Api::authSession();

	include_once(EC_PATH . '/includes/lib_order.php');
	
	$order_id = _POST('order_id', 0);
	if (!$order_id) 
	{
		GZ_Api::outPut(101);
	}
	$user_id = $_SESSION['user_id'];

	/* 订单详情 */
	$order = get_order_detail($order_id, $user_id);
	$order_time = _POST('order_time');	

	if ($order['pay_id'] > 0) 
	{
	 	 $payment = payment_info($order['pay_id']);
	}

	if ($payment['pay_code'] == "upop") 
	{
		include_once(GZ_PATH . '/payment/UPMP/upop_mobile.php');
		$upop = new UPOP_MOBILE();
		$pay_result = $upop->query($order,$payment,$order_time); 	
		GZ_Api::outPut($pay_result);
	}
?>