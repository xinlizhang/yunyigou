<?php

    if (!defined('IN_ECS'))
    {
        die('Hacking attempt');
    }

    GZ_Api::authSession();

    $GLOBALS['sess']->destroy_session();

    GZ_Api::outPut(array());