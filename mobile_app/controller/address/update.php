<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }
    GZ_Api::authSession();

    $address = _POST('address', array());
    $address['address_id'] = _POST('address_id', 0);

    if (empty($address['address_id']))
    {
        GZ_Api::outPut(101);
    }

    unset($address['id']);
    $address['user_id'] = $_SESSION['user_id'];
    $a = update_address($address);

    GZ_Api::outPut(array());
