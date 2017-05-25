<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    include_once(EC_PATH . '/includes/lib_order.php');

    $user_id = $_SESSION['user_id'];

    $order_id = _POST('order_id', 0);
    affirm_received($order_id, $user_id);

    GZ_Api::outPut(array());