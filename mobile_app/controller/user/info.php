<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    include_once(EC_PATH . '/includes/lib_order.php');

    $user_info = GZ_user_info($_SESSION['user_id']);
    GZ_Api::outPut($user_info);

?>