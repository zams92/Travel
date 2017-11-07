<?php
function anti_injection($data){
	$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
}
$activeuser = anti_injection($_GET['activeuser']);
$key = anti_injection($_GET['key']);
if (!empty($activeuser) AND !empty($key)){
?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="Copyright" content="Cyber Programming TGD" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Activation" />
    <meta name="keywords" content="activation" />
    <meta name="author" content="Budi Setiawan" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <title>Activation Account</title>
    <link rel="shortcut icon" type="image/png" href="favicon.png" />

	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="css/plugins.css" />
	<link type="text/css" rel="stylesheet" href="css/main.css" />
	<link type="text/css" rel="stylesheet" href="css/themes.css" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">

	<script type="text/javascript" src="js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
</head>
<body>
    <div class="top"><div class="colors"></div></div>
	<!-- <img src="images/placeholders/backgrounds/login_full_bg.jpg" alt="Login Full Background" class="full-bg animation-pulseSlow">
	 --><div id="login-container" class="animation-fadeIn">
		<div class="login-title text-center">
			<h1><strong>Activation Account Panel</strong></h1>
		</div>
		<div class="block remove-margin">
			<?php
				include_once '../mylibrary/mydatabase.php';
				$table = new MyTable('users');
				$currentUser = $table->findByAnd(username, $activeuser, id_session, $key);
				$currentUser = $currentUser->current();
				if ($currentUser > 0){
					if ($currentUser->blokir == "Y"){
						$data = array(
							'blokir' => 'N'
						);
						$table->updateByAnd('username', $activeuser, 'id_session', $key, $data);
						?>
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="fa fa-check-circle"></i> Success</h4>
								Your account have been <a href="javascript:void(0)" class="alert-link">activated</a> !
							</div>
						<?php
					}else{
						?>
							<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="fa fa-exclamation-circle"></i> Info</h4>
								Your account already <a href="javascript:void(0)" class="alert-link">activated</a> !
							</div>
						<?php
					}
				}else{?>
		        <script language="javascript">
		            alert("Maaf, Account anda sudah aktif!");
		            document.location=".././";
		        </script>
			<?php
				}
			?>
			<form action="login.php" autocomplete="off" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
				<input type="hidden" name="mod" value="login" />
                <input type="hidden" name="act" value="proclogin" />
                <div class="form">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group form-item">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="username" class="form-control input-lg" placeholder="Username" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group form-item">
                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                <input type="text" name="password" class="form-control input-lg" placeholder="Password" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions box-action" style="display:none;">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-8 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Login to Dashboard</button>
                        </div>
                    </div>
                </div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/vendor/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript">
        gradient();
    </script>
</body>
</html>
<?php
}
else{
	header('location:./');
}
?>