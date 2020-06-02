<?php

//set up session
session_name('sid');
session_start();

require('php/sitesetup.php');

//apache rewrite
switch ($path->redirect) {
    case $path->rD . '/'  :
    case $path->rD . ''   :
        $pgID=1;
        require __DIR__ . '/pages/home.php';
        break;
    case $path->rD . '/about'   :
        $pgID=2;
        require __DIR__ . '/pages/about.php';
        break;
    case $path->rD . '/contact'   :
        $pgID=3;
        require __DIR__ . '/pages/contact.php';
        break;
    case $path->rD . '/admin'   :
        $pgID=4;
        require __DIR__ . '/pages/admin.php';
        break;
    case $path->rD . '/account'   :
        $pgID=5;
        require __DIR__ . '/pages/useraccount.php';
        break;
    case $path->rD . '/logout'   :
        //temporary logout with session destroy
        setcookie (session_id(), "", time() - 3600);
        session_destroy();
        session_write_close();
        header("Location: http://localhost/");
        break;
    case $path->rD . '/login'   :
    case $path->rD . '/register'   :
    case $path->rD . '/json/client/validate' :
        require __DIR__ . '/php/userRequests.php';
        break;
    default:
        require __DIR__ . '/pages/404.php';
        break;
}
?>