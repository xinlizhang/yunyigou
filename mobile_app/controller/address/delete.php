<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    $address_id = _POST('address_id', 0);
    if (empty($address_id)) {
        GZ_Api::outPut(101);
    }
    drop_consignee($address_id);

    GZ_Api::outPut(array());