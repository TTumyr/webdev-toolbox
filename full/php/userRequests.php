<?php
    if(strpos($_SERVER['REQUEST_URI'], 'login')) {
        if(!isset($_POST['csrf'])) $_POST['csrf'] = '';
        echo('Form csrf: ' . $_POST['csrf']);
        echo('<br>');
        echo('Session csrf: ' . $_SESSION['csrf']);
        echo('<br><br>');
        //$logUser = (new UserCtrl)->register();
        if($_SESSION['csrf'] === $_POST['csrf']) {
            echo('Form matches session');
        } else {
            echo('Form does not match session');
        }
    } elseif (strpos($_SERVER['REQUEST_URI'], 'register')) {
        $userRegister = new User($_SERVER['HTTP_ORIGIN'], $_SESSION, $_POST, $path);
        $userRegister->register();
        if($userRegister->regFail == true) {
            //print_r($userRegister->insertedUser);
            require(dirname(__DIR__,1) . '/pages/userregfail.php');
        } else {
            require(dirname(__DIR__,1) . '/pages/userregsuccess.php');
        }
    } elseif (strpos($_SERVER['REQUEST_URI'], 'json/user')) {
        $file = file_get_contents('php://input');
        $postdata = json_decode(file_get_contents('php://input'), true);
        $db = new mySQL();
        $dbuser = new DBQuery($db->pdo);
        $dbuser->querySpecific($db->users['name'], $db->users['table'], $db->users['name'], $postdata['username']);
        $dbuser->get($dbuser->sql);
        echo(json_encode($dbuser->data));
    } elseif (strpos($_SERVER['REQUEST_URI'], 'json/email')) {
        $file = file_get_contents('php://input');
        $postdata = json_decode(file_get_contents('php://input'), true);
        $db = new mySQL();
        $dbuser = new DBQuery($db->pdo);
        $dbuser->querySpecific($db->users['email'], $db->users['table'], $db->users['email'], $postdata['email']);
        $dbuser->get($dbuser->sql);
        echo(json_encode($dbuser->data));
    }
?>