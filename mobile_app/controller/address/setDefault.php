<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    $address_id = _POST('address_id', 0);

    if (empty($address_id))
    {
        GZ_Api::outPut(101);
    }

    $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('user_address') . " WHERE address_id = '$address_id'";
    $arr = $GLOBALS['db']->getRow($sql);
    if (empty($arr))
    {
        GZ_Api::outPut(8);
    }

    /* 保存到session */
    $_SESSION['flow_consignee'] = stripslashes_deep($arr);
    $address = array('address_id'=>$address_id);

    $sql = "UPDATE " . $GLOBALS['ecs']->table('users') .
        " SET address_id = '$address_id' WHERE user_id = '$_SESSION[user_id]'";

    $res = $GLOBALS['db']->query($sql);

    GZ_Api::outPut(array());