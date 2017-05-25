<?php

    define('DEBUG_MODE', 7);

    $php_self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    if ('/' == substr($php_self, -1))
    {
        $php_self .= 'index.php';
    }
    define('PHP_SELF', $php_self);

    /* 兼容ECShopV2.5.1版本载入库文件 */
    if (!function_exists('addslashes_deep'))
    {
        require(ROOT_PATH . 'includes/lib_base.php');
    }

    /* 兼容ECShopV2.5.1版本 */
    if (!defined('EC_CHARSET'))
    {
        define('EC_CHARSET', 'utf-8');
    }

    /* 创建 ECSHOP 对象 */
    $ecs = new ECS($db_name, $prefix);

    /* 初始化数据库类 */
    $db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
    $db->set_disable_cache_tables(array($ecs->table('sessions'), $ecs->table('sessions_data'), $ecs->table('cart')));
    $db_host = $db_user = $db_pass = $db_name = NULL;

    /* 载入系统参数 */
    $_CFG = load_config();


    $data = array(
        'service_phone' => $_CFG['service_phone'],
        'site_url' => dirname($GLOBALS['ecs']->url()),
        'goods_url' => dirname($GLOBALS['ecs']->url()).'/goods.php?id=',
        'shop_closed' => $_CFG['shop_closed'],
        'close_comment' => $_CFG['close_comment'],
        'shop_reg_closed' => $_CFG['shop_reg_closed'],
        'shop_desc' => $_CFG['shop_desc'],
        'currency_format' => $_CFG['currency_format'],
        "time_format" => $_CFG['time_format']
    );


    GZ_Api::outPut(array('data' => $data));