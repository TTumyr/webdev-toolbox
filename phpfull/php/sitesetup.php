<?php

//initialization - set up configuration and root directory (rD)
require('classes/cfg.php');
$path = new Cfg();
$path->getRD();

//get classes
require(dirname(__DIR__,1) . $path->rD . '/php/classes/auth.php');
require(dirname(__DIR__,1) . $path->rD . '/php/classes/dbquery.php');
require(dirname(__DIR__,1) . $path->rD . '/php/classes/user.php');
?>