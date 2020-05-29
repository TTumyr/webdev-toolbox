<?php

//set up session
session_name('sid');
session_start();
if(!isset($_COOKIE['sid'])) {
    $_SESSION['auth'] = false;
}

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
    case $path->rD . '/login'   :
    case $path->rD . '/register'   :
    case $path->rD . '/json/username' :
    case $path->rD . '/json/email' :
        require __DIR__ . '/php/userRequests.php';
        break;
    default:
        require __DIR__ . '/pages/404.php';
        break;
}
?>