<?php
/*















------------------------------------------------------------------



 */

$moduleName = 'travel';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';

$options = array();
$options['setRemoteTable'] = 'true';

$moduleBuilder = new \Classes\ModuleBuilder\ModuleBuilder();
$moduleBuilder->addModuleOrGroup(new \Classes\ModuleBuilder\ModuleTab(
	'OvertimeCategory','OvertimeCategory','Overtime Categories','OvertimeCategoryAdapter','','',true,$options
));
$moduleBuilder->addModuleOrGroup(new \Classes\ModuleBuilder\ModuleTab(
	'EmployeeOvertime','EmployeeOvertime','Overtime Requests','EmployeeOvertimeAdminAdapter','','',false,$options
));
echo \Classes\UIManager::getInstance()->renderModule($moduleBuilder);


$itemName = 'OvertimeRequest';
$moduleName = 'Time Management';
$itemNameLower = strtolower($itemName);

include APP_BASE_PATH.'footer.php';
