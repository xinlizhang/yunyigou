<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    include_once(EC_PATH . '/includes/lib_order.php');

    $name = _POST('name');
    $password = _POST('password');

    function logResult($word='')
    {
        $fp = fopen("log.txt","a");
        flock($fp, LOCK_EX) ;
        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    logResult('************login begin*****************');
    logResult(var_export($_COOKIE, true));
    logResult(var_export($_POST, true));

    $sess = GZ_Api::createSession();

    if (!$user->login($name, $password, true)) {
        GZ_Api::outPut(6);
    }

    $user_info = GZ_user_info($_SESSION['user_id']);

    $out = array(
        'session' => array(
            'sid' => SESS_ID.$sess->gen_session_key(SESS_ID),
            'uid' => $_SESSION['user_id']
        ),

        'user' => $user_info
    );


    update_user_info();
    recalculate_price();

    logResult(var_export($out, true));
    logResult('*************login end****************');

    GZ_Api::outPut($out);