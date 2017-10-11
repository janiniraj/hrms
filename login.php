<?php
define('CLIENT_PATH', dirname(__FILE__));
include("config.base.php");
include("include.common.php");
include("server.includes.inc.php");

error_log(print_r($_REQUEST, true));

if (empty($user)) {
	if (!isset($_REQUEST['f']) && isset($_COOKIE['icehrmLF'])
		&& $_REQUEST['login'] != 'no' && !isset($_REQUEST['username'])) {
		$tempUser = new \Users\Common\Model\User();
		$tempUser->Load("login_hash = ?", array($_COOKIE['icehrmLF']));

		if (!empty($tempUser->id) &&
			sha1($tempUser->email."_".$tempUser->password) == $_COOKIE['icehrmLF']) {
			$_REQUEST['username'] = $tempUser->username;
			$_REQUEST['password'] = $tempUser->password;
			$_REQUEST['hashedPwd'] = $tempUser->password;
			$_REQUEST['remember'] = true;
		}
	}

	if (!empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
		if (!isset($_REQUEST['hashedPwd'])) {
			$_REQUEST['hashedPwd'] = md5($_REQUEST['password']);
		}
		$suser = null;
		$ssoUserLoaded = false;

		include 'login.com.inc.php';

		if (empty($suser)) {
			$suser = new \Users\Common\Model\User();
			$suser->Load(
				"(username = ? or email = ?) and password = ?",
				array($_REQUEST['username'],$_REQUEST['username'],$_REQUEST['hashedPwd'])
			);
		}

		if ($suser->password == $_REQUEST['hashedPwd'] || $ssoUserLoaded) {
			$user = $suser;
			\Utils\SessionUtils::saveSessionObject('user', $user);
			$suser->last_login = date("Y-m-d H:i:s");
			$suser->Save();

			if (!$ssoUserLoaded && !empty(\Classes\BaseService::getInstance()->auditManager)) {
				\Classes\BaseService::getInstance()->auditManager->user = $user;
				\Classes\BaseService::getInstance()->audit(\Classes\IceConstants::AUDIT_AUTHENTICATION, "User Login");
			}

			if (!$ssoUserLoaded && isset($_REQUEST['remember'])) {
				//Add cookie
				$suser->login_hash = sha1($suser->email."_".$suser->password);
				$suser->Save();

				setcookie('icehrmLF', $suser->login_hash, strtotime('+30 days'));
			} else if (!isset($_REQUEST['remember'])) {
				setcookie('icehrmLF', '');
			}

			if (!isset($_REQUEST['remember'])) {
				setcookie('icehrmLF');
			}

			$redirectUrl = \Utils\SessionUtils::getSessionObject('loginRedirect');
			if (!empty($redirectUrl)) {
				header("Location:".$redirectUrl);
			} else {
				if ($user->user_level == "Admin") {
					if (\Utils\SessionUtils::getSessionObject('account_locked') == "1") {
						header("Location:".CLIENT_BASE_URL."?g=admin&n=billing&m=admin_System");
					} else {
						header("Location:".HOME_LINK_ADMIN);
					}
				} else {
					if (empty($user->default_module)) {
						header("Location:".HOME_LINK_OTHERS);
					} else {
						$defaultModule = new \Modules\Common\Model\Module();
						$defaultModule->Load("id = ?", array($user->default_module));
						if ($defaultModule->mod_group == "user") {
							$defaultModule->mod_group = "modules";
						}
						$homeLink = CLIENT_BASE_URL."?g=".$defaultModule->mod_group."&&n=".$defaultModule->name.
							"&m=".$defaultModule->mod_group."_".str_replace(" ", "_", $defaultModule->menu);
						header("Location:".$homeLink);
					}
				}
			}
		} else {
			header("Location:".CLIENT_BASE_URL."login.php?f=1");
		}
	}
} else {
	if ($user->user_level == "Admin") {
		header("Location:".HOME_LINK_ADMIN);
	} else {
		if (empty($user->default_module)) {
			header("Location:".HOME_LINK_OTHERS);
		} else {
			$defaultModule = new \Modules\Common\Model\Module();
			$defaultModule->Load("id = ?", array($user->default_module));
			if ($defaultModule->mod_group == "user") {
				$defaultModule->mod_group = "modules";
			}
			$homeLink = CLIENT_BASE_URL."?g=".$defaultModule->mod_group."&n=".$defaultModule->name.
				"&m=".$defaultModule->mod_group."_".str_replace(" ", "_", $defaultModule->menu);
			header("Location:".$homeLink);
		}
	}
}

$tuser = \Utils\SessionUtils::getSessionObject('user');
$logoFileUrl = \Classes\UIManager::getInstance()->getCompanyLogoUrl();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=APP_NAME?> Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../theme/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../theme/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../theme/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../theme/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="login.php"><b>HRMS</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php if (!isset($_REQUEST['cp'])) {?>
        <form id="loginForm" action="login.php" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" type="password" id="password" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <?php if (isset($_REQUEST['f'])) {?>
                <div class="clearfix alert alert-error" style="font-size:11px;margin-bottom: 5px;">
                    Login failed
                    <?php if (isset($_REQUEST['fm'])) {
                        echo $_REQUEST['fm'];
                    }?>
                </div>
            <?php } ?>
            <?php if (isset($_REQUEST['c'])) {?>
                <div class="clearfix alert alert-info" style="font-size:11px;margin-bottom: 5px;">
                    Password changed successfully
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="remember" name="remember" checked> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="button" onclick="submitLogin();return false;" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>

            <a href="#" onclick="showForgotPassword();return false;" >I forgot my password</a>
        </form>
        <form id="requestPasswordChangeForm" style="display:none;" action="">
            <div class="form-group has-feedback">
                <input class="form-control" type="text" id="usernameChange" name="usernameChange" placeholder="Username or Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div id="requestPasswordChangeFormAlert" class="clearfix alert alert-info" style="display:none;"></div>
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2"">
                    <button onclick="requestPasswordChange();return false;" type="button" class="btn btn-primary btn-block btn-flat">Request Password Change</button>
                </div>
            </div>

        </form>
        <?php } else {?>
            <form id="newPasswordForm" action="">
                <fieldset>
                    <div class="clearfix">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input class="span2" type="password" id="password" name="password" placeholder="New Password">
                        </div>
                    </div>
                    <div id="newPasswordFormAlert" class="clearfix alert alert-error" style="font-size:11px;width:147px;margin-bottom: 5px;display:none;">

                    </div>
                    <button class="btn" style="margin-top: 5px;" type="button" onclick="changePassword();return false;">Change Password&nbsp;&nbsp;<span class="icon-arrow-right"></span></button>
                </fieldset>
            </form>
        <?php }?>
        <!-- /.social-auth-links -->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../theme/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../theme/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<script type="text/javascript">
    var key = "";
    <?php if (isset($_REQUEST['key'])) {?>
    key = '<?=$_REQUEST['key']?>';
    key = key.replace(/ /g,"+");
    <?php }?>

    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        $("#password").keydown(function(event){
            if(event.keyCode == 13) {
                submitLogin();
                return false;
            }
        });
    });

    function showForgotPassword(){
        $("#loginForm").hide();
        $("#requestPasswordChangeForm").show();
    }

    function requestPasswordChange(){
        $("#requestPasswordChangeFormAlert").hide();
        var id = $("#usernameChange").val();
        $.post("service.php", {'a':'rpc','id':id}, function(data) {
            if(data.status == "SUCCESS"){
                $("#requestPasswordChangeFormAlert").show();
                $("#requestPasswordChangeFormAlert").html(data.message);
            }else{
                $("#requestPasswordChangeFormAlert").show();
                $("#requestPasswordChangeFormAlert").html(data.message);
            }
        },"json");
    }

    function changePassword(){
        $("#newPasswordFormAlert").hide();
        var password = $("#password").val();

        var passwordValidation =  function (str) {
            var val = /^[a-zA-Z0-9]\w{6,}$/;
            return str != null && val.test(str);
        };


        if(!passwordValidation(password)){
            $("#newPasswordFormAlert").show();
            $("#newPasswordFormAlert").html("Password may contain only letters, numbers and should be longer than 6 characters");
            return;
        }


        $.post("service.php", {'a':'rsp','key':key,'pwd':password,"now":"1"}, function(data) {
            if(data.status == "SUCCESS"){
                top.location.href = "login.php?c=1";
            }else{
                $("#newPasswordFormAlert").show();
                $("#newPasswordFormAlert").html(data.message);
            }
        },"json");
    }

    function submitLogin(){
        try{
            localStorage.clear();
        }catch(e){}
        $("#loginForm").submit();
    }

</script>
</body>
</html>
