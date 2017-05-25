<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    $address = _POST('address', array());

    $address['address_id'] = $address['id'];

    unset($address['id']);

    $address['user_id'] = $_SESSION['user_id'];
    $address['defalut'] = 1;
    $address['default'] = 1;

    $a = update_address($address);

    GZ_Api::outPut(array());