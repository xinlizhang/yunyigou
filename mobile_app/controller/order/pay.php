<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    include_once(EC_PATH . '/includes/lib_payment.php');
    include_once(EC_PATH . '/includes/lib_order.php');
    include_once(EC_PATH . '/includes/lib_clips.php');

    define('GZ_PATH', dirname(__FILE__));

    $order_id = _POST('order_id', 0);
    if (!$order_id) {
        GZ_Api::outPut(101);
    }
    $user_id = $_SESSION['user_id'];

    /* 订单详情 */
    $order = get_order_detail($order_id, $user_id);
    if ($order['pay_id'] > 0)
    {
      $payment = payment_info($order['pay_id']);
    }

    if ($order === false)
    {
        GZ_Api::outPut(8);
    }

    $base = sprintf('<base href="%s/" />', dirname($GLOBALS['ecs']->url()));
    $html = '<!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0">'.$base.'</head><body>%s</body></html>';

    if ($payment['pay_code'] == "upop")
    {
        include_once(GZ_PATH . '/payment/UPMP/upop_mobile.php');
        $upop = new UPOP_MOBILE();
        $pay_result = $upop->get_code($order,$payment);
        $out =array('pay_online' => sprintf($html, $order['pay_online']));

        if ($pay_result['upop_tn'])
        {
            $out['upop_tn'] = $pay_result['upop_tn'];
            $out['pay_wap'] = $pay_result['pay_url'];
        }

        GZ_Api::outPut($out);
    }
    else if ($payment['pay_code'] == "alipay")
    {
        include_once(GZ_PATH . '/payment/alipay/wap_md5/alipay_mobile.php');
        //require_once(GZ_PATH . "/payment/alipay/wap/alipay.config.php");
        $alipay_mobile = new ALIPAY_MOBILE_MD5();
        $wappay_url = $alipay_mobile->get_wappay_url($order);

        if ($wappay_url)
        {
            GZ_Api::outPut(array('pay_online' => sprintf($html, $order['pay_online']),
                                'pay_wap' => sprintf($html, $wappay_url)
                                ));
        }
        else
        {
            GZ_Api::outPut(array('pay_online' => sprintf($html, $order['pay_online'])
                                    ));
        }
    }
    else
    {
        GZ_Api::outPut(array('pay_online' => sprintf($html, $order['pay_online'])));
    }

?>