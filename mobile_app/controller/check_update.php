<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    $version_code = array('1.0');
    $is_necessary = array(0);

    $client_version = _POST('client_version', '');
    if( empty($client_version) )
        GZ_Api::outPut(101);

    $out = array();
    $isHaveRecorde = false;
    $out['is_hasUpdate'] = 0;                           // 是否有更新
    $out['is_necessary'] = 0;                           // 是否为强制更新
    for ( $i = 0; $i < count($version_code); $i++ )
    {
        if( $client_version == $version_code[$i] )
        {
            // 版本库列表中找到当前版本
            $isHaveRecorde = true;
            if( $i==(count($version_code)-1) )
            {
                // 当前版本为最后一条记录 则最新
                $out['is_hasUpdate'] = 0;
            }
            else
            {
                // 确定有更新后 遍历强制更新数组 只要后续版本有强制更新 则本次为强制
                $out['is_hasUpdate'] = 1;
                for( $j = $i; $j < count($is_necessary); $j++ )
                {
                    if( 1 == $is_necessary[$j] )
                    {
                        $out['is_necessary'] = 1;
                        break;
                    }
                }
            }
            break;
        }
    }
    if( $isHaveRecorde == false )
        GZ_Api::outPut(101);

    $out['server_version'] = $version_code[count($version_code)-1];
    $out['URL_Android'] = 'http://www.zhangxinli.com.cn/update_package/yunyigou_android_2.0.apk';
    $out['URL_Iphone'] = 'http://www.baidu.com';
    $out['URL_Ipad'] = 'http://www.baidu.com';

    GZ_Api::outPut($out);
