<?php
    require(dirname(__DIR__,1) . $cfg->rD . '/php/classes/auth.php');
    require(dirname(__DIR__,1) . $cfg->rD . '/php/classes/validate.php');
    require(dirname(__DIR__,1) . $cfg->rD . '/php/classes/dbquery.php');
    if(strpos($_SERVER['REQUEST_URI'], 'login')) {
        if(!isset($_POST['csrf'])) $_POST['csrf'] = '';
        echo('Form csrf: ' . $_POST['csrf']);
        echo('<br>');
        echo('Session csrf: ' . $_SESSION['csrf']);
        echo('<br><br>');
        if($_SESSION['csrf'] === $_POST['csrf']) {
            echo('Form matches session');
        } else {
            echo('Form does not match session');
        }
    } elseif (strpos($_SERVER['REQUEST_URI'], 'register')) {
        $auth = new Auth($cfg->origin, $_SERVER['HTTP_ORIGIN'], $_SESSION['csrf'], $_POST['csrf']);
        $auth->check();
        if($auth->verified === true) {
            $reg = new User_Reg_Validate($db->pdo);
            $reg->registerUser();
        }
    }
?>