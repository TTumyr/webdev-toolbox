<?php

//initialization
require('php/classes/cf.php');
$cfg = new Cf();
$cfg->getRD();
$db = new MySQL;

//set up session
session_name('sid');
session_start();

//apache rewrite
switch ($cfg->redirect) {
    case $cfg->rD . '/'  :
    case $cfg->rD . ''   :
        $pgID=1;
        require __DIR__ . '/pages/home.php';
        break;
    case $cfg->rD . '/about'   :
        $pgID=2;
        require __DIR__ . '/pages/about.php';
        break;
    case $cfg->rD . '/contact'   :
        $pgID=3;
        require __DIR__ . '/pages/contact.php';
        break;
    case $cfg->rD . '/login'   :
    case $cfg->rD . '/register'   :
        require __DIR__ . '/php/user.php';
        break;
    default:
        require __DIR__ . '/pages/404.php';
        break;
}
?>