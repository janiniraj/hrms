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
	'EmployeeTravelRecord',
	'EmployeeTravelRecord',
	'Travel Requests',
	'EmployeeTravelRecordAdminAdapter',
	'',
	'',
	true,
	$options
));
echo \Classes\UIManager::getInstance()->renderModule($moduleBuilder);


$itemName = 'TravelRequest';
$moduleName = 'Travel Management';
$itemNameLower = strtolower($itemName);

include APP_BASE_PATH.'footer.php';
