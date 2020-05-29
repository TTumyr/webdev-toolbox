<?php
    if(strpos($_SERVER['REQUEST_URI'], 'login')) {
        if(!isset($_POST['csrf'])) $_POST['csrf'] = '';
        $userLogin = new User($_SERVER['HTTP_ORIGIN'], $_SESSION, $_POST);
        $userLogin->login();
        header("Location: http://localhost/");
    } elseif (strpos($_SERVER['REQUEST_URI'], 'register')) {
        $userRegister = new User($_SERVER['HTTP_ORIGIN'], $_SESSION, $_POST);
        $userRegister->register();
        if($userRegister->regFail == true) {
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