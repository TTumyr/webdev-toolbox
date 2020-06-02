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
    } elseif (strpos($_SERVER['REQUEST_URI'], 'json/client/validate')) {
        $file = file_get_contents('php://input');
        $userCheck = new User($_SERVER['HTTP_ORIGIN'], $_SESSION, $file);
        $userCheck->checkStatus();
    } 
?>