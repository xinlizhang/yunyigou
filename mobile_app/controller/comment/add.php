<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    $user_id = empty($_SESSION['user_id']) ? 0 : $_SESSION['user_id'];
    $user_name =_POST('user_name', '');
    $email = _POST('email', '');
    $goods_id = _POST('goods_id', 32);
    $content = _POST('content', '');
    $comment_rank = _POST('comment_rank', 0);
    $status = 1 - $GLOBALS['_CFG']['comment_check'];

    /* 保存评论内容 */
    $sql = "INSERT INTO " .$GLOBALS['ecs']->table('comment') .
        "(comment_type, id_value, email, user_name, content, comment_rank, add_time, status, parent_id, user_id) VALUES " .
        "('" .'0'. "', '" .$goods_id. "', '$email', '$user_name', '" .$content."', '".$comment_rank."', ".gmtime().", '$status', '0', '$user_id')";


    $result = $GLOBALS['db']->query($sql);
    if( !result )
        GZ_Api::outPut(8);

    GZ_Api::outPut(array());


