<?php

//initialization - set up configuration and root directory (rD)
require('classes/cfg.php');
$cfg = new Cfg();
$cfg->getRD();

//get classes
require(dirname(__DIR__,1) . $cfg->rD . '/php/classes/auth.php');
require(dirname(__DIR__,1) . $cfg->rD . '/php/classes/validate.php');
require(dirname(__DIR__,1) . $cfg->rD . '/php/classes/dbquery.php');
require(dirname(__DIR__,1) . $cfg->rD . '/php/classes/userctrl.php');
?>