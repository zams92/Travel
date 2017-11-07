<?php
session_start();
error_reporting(0);
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
    include_once 'mylibrary/mydatabase.php';
    $tableset = new MyTable('setting');
    $currentSet = $tableset->findBy(id_setting, '1');
    $currentSet = $currentSet->current();
    $member_register = $currentSet->member_register;
    if(!empty($_GET['errormsg'])){
        if($_GET['errormsg'] == 1){
            $errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Please complete all form!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
        }elseif($_GET['errormsg'] == 2){
            $errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Username or password not correct!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
        }else{
            header('location:./');
        }
    }
?>
<!DOCTYPE html">
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="Copyright" content="Softmed Consultindo" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Login Panel" />
    <meta name="keywords" content="login panel" />
    <meta name="author" content="Softmed Consultindo" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <title>E-Performence</title>
    <link rel="shortcut icon" type="image/png" href="favicon.ico" />

    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
	<link type="text/css" rel="stylesheet" href="css/plugins.css" />
	<link type="text/css" rel="stylesheet" href="css/main.css" />
	<link type="text/css" rel="stylesheet" href="css/themes.css" />
    <link type="text/css" rel="stylesheet" href="js/video/video-js.css" />    

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">

	<script type="text/javascript" src="js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
</head>
<body>
    <img src="images/index.jpg" alt="Login Full Background" class="full-bg animation-pulseSlow">
    <div id="page-container" class="sidebar-no-animations footer-fixed">
        <div id="main-container">
            <div id="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <img class="index_logo" src="images/logo.png"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="widget">
                        	<?php include("video.php"); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="col-md-12">
                            <?=$errormsg;?>
                        </div>
                        <form action="login.php" class="form-signin" method="post">
                            <h3 class="form-signin-heading"><i class="icon-lock"></i>  login E-Performence</h3>
                                <input type="hidden" name="mod" value="login" />
                                <input type="hidden" name="act" value="proclogin" />
                                <input type="text" class="input-block-level" id="username" name="username" placeholder="Nama pengguna" required>
                                <input type="password" class="input-block-level" id="password" name="password" placeholder="Kata kunci" required>
                                <button data-placement="right" title="Klik tombol ini untuk login" id="signin" name="login" class="btn btn-info" type="submit"><i class="icon-signin icon-large"></i> Masuk</button>
                        </form>
                        <div id="button_form" class="form-signin" >
                            <h3 class="form-signin-heading"><i class="icon-edit"></i> Pendaftaran Baru </h3>
                            <p class="form-signin-heading">Mau umroh gratis ???</p>
                            <p class="form-signin-heading">
                              <button data-placement="top" title="Ayo daftar" id="sign_up_m" onclick="window.location='register.php'" id="btn_student" name="login" class="btn btn-info" type="submit">
                              Daftar Sekarang
                              </button>
                            </p>
                        </div> 
                    </div>
                </div>
            </div>

            <footer class="clearfix">
            </footer>
         </div>
    </div>
    <script type="text/javascript" src="js/vendor/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/video/video.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript">
        gradient();
    </script>
</body>
</html>
<?php
}else{
    header('location:admin.php?mod=home');
}
?>