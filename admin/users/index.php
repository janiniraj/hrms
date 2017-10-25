<?php 
/*















------------------------------------------------------------------

  

 */

$moduleName = 'users';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';

?><div class="span9">
			  
	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
		<li class="active"><a id="tabUser" href="#tabPageUser"><?=t('Users')?></a></li>
		<li class=""><a id="tabUserRole" href="#tabPageUserRole"><?=t('User Roles')?></a></li>
	</ul>
	 
	<div class="tab-content">
		<div class="tab-pane active" id="tabPageUser">
			<div id="User" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="UserForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
        <div class="tab-pane" id="tabPageUserRole">
            <div id="UserRole" class="reviewBlock" data-content="List" style="padding-left:5px;">

            </div>
            <div id="UserRoleForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">

            </div>
        </div>
	</div>

</div>
<script>
var modJsList = new Array();
modJsList['tabUser'] = new UserAdapter('User');
<?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == "new" && isset($_REQUEST['object'])){?>
modJsList['tabUser'].newInitObject = JSON.parse(Base64.decode('<?=$_REQUEST['object']?>'));
<?php }?>
modJsList['tabUserRole'] = new UserRoleAdapter('UserRole');
var modJs = modJsList['tabUser'];

</script>
<?php include APP_BASE_PATH.'footer.php';?>      
