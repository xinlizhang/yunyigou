<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    include_once(EC_PATH . '/includes/lib_order.php');

    $user_id = $_SESSION['user_id'];

    // $user_id = _POST('user_id', 0);

    $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('user_address') .
            " WHERE user_id = '$user_id' ORDER BY address_id";

    $consignee_list =  $GLOBALS['db']->getAll($sql);

    $consignee = get_consignee($user_id);// 取得默认地址

    $result = array();

    foreach ($consignee_list as $key => $value)
    {

        $result[$key]['id'] = $value['address_id'];

        $result[$key]['consignee'] = $value['consignee'];

        $result[$key]['email'] = $value['email'];

        $result[$key]['province'] = $value['province'];
        $result[$key]['city'] = $value['city'];
        $result[$key]['district'] = $value['district'];

        $result[$key]['address'] = $value['address'];

        $result[$key]['tel'] = $value['tel'];
        $result[$key]['mobile'] = $value['mobile'];

        $country = $value['country'];
        $sql1 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$country'";
        $country = $GLOBALS['db']->getAll($sql1);
        $result[$key]['country_name'] = $country[0]['region_name'];

        $province = $value['province'];
        $sql2 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$province'";
        $province = $GLOBALS['db']->getAll($sql2);
        $result[$key]['province_name'] = $province[0]['region_name'];

        $city = $value['city'];
        $sql3 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$city'";
        $city = $GLOBALS['db']->getAll($sql3);
        $result[$key]['city_name'] = $city[0]['region_name'];

        $district = $value['district'];
        $sql4 = "SELECT * FROM " . $GLOBALS['ecs']->table('region') .
            " WHERE region_id = '$district'";
        $district = $GLOBALS['db']->getAll($sql4);
        $result[$key]['district_name'] = $district[0]['region_name'];

        if($value['address_id'] == $consignee['address_id'])
        {
            $result[$key]['default_address'] = 1;
        }
        else
        {
            $result[$key]['default_address'] = 0;
        }
    }

    GZ_Api::outPut($result);



