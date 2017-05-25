<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    $flash_arr = array();

    function get_flash_xml()
    {
        $flashdb = array();
        if (file_exists(ROOT_PATH . DATA_DIR . '/flash_data.xml'))
        {
            // 兼容v2.7.0及以前版本
            if (!preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"\ssort="([^"]*)"/', file_get_contents(ROOT_PATH . DATA_DIR . '/flash_data.xml'), $t, PREG_SET_ORDER))
            {
                preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"/', file_get_contents(ROOT_PATH . DATA_DIR . '/flash_data.xml'), $t, PREG_SET_ORDER);
            }

            if (!empty($t))
            {
                foreach ($t as $key => $val)
                {
                    $val[4] = isset($val[4]) ? $val[4] : 0;
                    $val[2] = substr($val[2], 0, 4) == 'http' ? $val[2] : dirname($GLOBALS['ecs']->url()).'/'.$val[2];
                    $flashdb[] = array('photo'=>array('small'=>API_DATA('PHOTO', $val[1]), 'thumb'=>API_DATA('PHOTO', $val[1]), 'url'=>API_DATA('PHOTO', $val[1])),'url'=>$val[2],'description'=>$val[3]);
                }
            }
        }
        return $flashdb;
    }

    $flash_arr['player'] = get_flash_xml();

    // url解析
    function api_get_url($url) {

        $out = array(
                'action' => '',
                'action_id' => 0
            );

        $site_url = dirname($GLOBALS['ecs']->url());

        if (strpos($url, $site_url) === false)
        {
            return $out;
        }

        if (strpos($url, '/goods.php') !== false)
        {
            $action = 'goods';
            $act_arr = explode('/goods.php', $url);
            if (strpos($act_arr[1], '?id=') !== false)
            {
                $action_id = ltrim($act_arr[1], '?id=');
            }
        }
        else if (strpos($url, '/category.php') !== false)
        {
            $action = 'category';
            $act_arr = explode('/category.php', $url);
            if (strpos($act_arr[1], '?id=') !== false)
            {
                $action_id = ltrim($act_arr[1], '?id=');
            }
        } else if (strpos($url, '/brand.php') !== false)
        {
            $action = 'brand';
            $act_arr = explode('/brand.php', $url);
            if (strpos($act_arr[1], '?id=') !== false)
            {
                $action_id = ltrim($act_arr[1], '?id=');
            }
        }
        else
        {
            return $out;
        }

        $out['action'] = $action;
        $out['action_id'] = (int)$action_id;

        return $out;
    }

    foreach ($flash_arr['player'] as $key => $val)
    {
        $action_info = api_get_url($val['url']);
        $flash_arr['player'][$key]['action'] = $action_info['action'];
        $flash_arr['player'][$key]['action_id'] = $action_info['action_id'];
    }

    $flash_arr['promote_goods'] = array();

    GZ_Api::outPut($flash_arr);

