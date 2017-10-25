<?php
error_reporting(E_ERROR);
ini_set("error_log", "../data/hrms_install.log");
define('CURRENT_PATH',dirname(__FILE__));
define('CLIENT_APP_PATH',realpath(dirname(__FILE__)."/..")."/");
define('APP_PATH',realpath(dirname(__FILE__)."/../..")."/");
define('APP_NAME',"HRMS");
define('APP_ID',"hrms");//check the effect
