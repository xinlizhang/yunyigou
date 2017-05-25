<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    include_once(EC_PATH . '/includes/lib_order.php');

    // ID验证
    $username = _POST('username', '');
    if (empty($username))
    {
        GZ_Api::outPut(101);
    }

    // 修改信息处理
    $sex = empty($_POST['sex']) ? '' : trim($_POST['sex']);
    $email = empty($_POST['email']) ? '' : trim($_POST['email']);
    $birthday = empty($_POST['birthday']) ? '' : trim($_POST['birthday']);
    $old_password = empty($_POST['old_password']) ? '' : trim($_POST['old_password']);
    $new_password = empty($_POST['new_password']) ? '' : trim($_POST['new_password']);

    $users  =& init_users();

    if( !empty($old_password) && !empty($new_password) )
    {
        $newInfoArray = array('username'=>$username, 'gender'=>$sex, 'email'=>$email, 'bday'=>$birthday, 'old_password'=>$old_password, 'password'=>$new_password );
        if ( $users->edit_user($newInfoArray) )
        {
            $sql="UPDATE ".$ecs->table('users'). "SET `ec_salt`='0' WHERE user_id= '".$_SESSION['user_id']."'";
            $db->query($sql);
            //$user->logout();
        }
        else
        {
            GZ_Api::outPut(8);
        }
    }
    else
    {
        if ( !$users->edit_user(array('username'=>$username,  'gender'=>$sex, 'email'=>$email, 'bday'=>$birthday )) )
        {
            GZ_Api::outPut(8);
        }
    }

    $user_info = GZ_user_info($_SESSION['user_id']);
    GZ_Api::outPut($user_info);


