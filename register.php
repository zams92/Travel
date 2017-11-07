<?php
session_start();
error_reporting(0);
include_once 'mylibrary/mydatabase.php';
include_once 'mylibrary/myfunction.php';
$tableset = new MyTable('setting');
$currentSet = $tableset->findBy(id_setting, '1');
$currentSet = $currentSet->current();
$member_register = $currentSet->member_register;
if ($member_register == "Y"){
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
	if(!empty($_GET['errormsg'])){
		if($_GET['errormsg'] == 1){
			$errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Please complete all form!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
		}elseif($_GET['errormsg'] == 2){
			$errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Please type correct email!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
		}elseif($_GET['errormsg'] == 3){
			$errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Please type another email!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
		}elseif($_GET['errormsg'] == 4){
			$errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Please insert code coloum!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
		}elseif($_GET['errormsg'] == 5){
			$errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Code not same with image!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
		}elseif($_GET['errormsg'] == 6){
            $errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Please type another username!<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
        }elseif($_GET['errormsg'] == 7){
            $errormsg = "<div style='margin-top:10px;' class='alert alert-success'><strong>Terima Kasih</strong> telah melakukan pendaftaran, Kami akan segera melakukan verifikasi akun anda.<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
        }elseif($_GET['errormsg'] == 8){
			$errormsg = "<div style='margin-top:10px;' class='alert alert-warning'>Silahkan pilih status pendaftaran anda<a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a></div>";
		}else{
			header('location:register.php');
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
    <meta http-equiv="Copyright" content="NonkTech" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Pendaftaran" />
    <meta name="keywords" content="Pendaftaran" />
    <meta name="author" content="Dwira Survivor" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <title>Pendaftaran</title>
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
                            <?php echo $errormsg; ?>
                        </div>
					<?php 					
					$table = new MyTable('temp');
					$currentUser = $table->findAll(KodeDaftar, DESC);
					$currentUser = $currentUser->current();		
					$tgl = $currentUser->TanggalLahir;
					if(empty($tgl)){
					$tanggal = "Tgl Lahir";
					$bulan = "Bulan Lahir";
					$tahun = "Tahun Lahir";
					}else{			
					$tanggal = substr($tgl,8,2);
					$bulan = getBulan(substr($tgl,5,2));
					$tahun = substr($tgl,0,4);
					}
									if($currentUser->DaftarSebagai == '1'){
										$status = "Marketing";
									}elseif($currentUser->DaftarSebagai == '2'){ 
										$status = "Haji";
									}elseif($currentUser->DaftarSebagai == '3') {
										$status = "Umroh";									
									}else{
									$status = "----Pilih Status----";	}
									
									
									if($currentUser->JenisKelamin == 'L') {
										$gender = "Laki-laki";
									}elseif($currentUser->JenisKelamin == 'P') {
										$gender = "Perempuan";
									}else{
										$gender = "----Jenis Kelamin----";
									}
					?>
                    
                        <form id="form-validation" action="actregister.php" class="form-signin" method="post" autocomplet="off">
                            <h3 class="form-signin-heading"><i class="icon-lock"></i> Formulir Pendaftaran</h3>
                            <hr>
                            
                            <div class="form-group">
                                <div class="col-md-8">
                                    <select id="status"  name="status" class="form-control" >
                                        <option value="<?php echo $user->DaftarSebagai; ?>"><?php echo $status; ?></option>
                                        <option value="1">Marketing</option>
                                        <option value="2">Haji</option>
                                        <option value="3">Umroh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="username" value="<?php echo $currentUser->Nama; ?>" name="username" class="form-control" placeholder="Nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="alamat" value="<?php echo $currentUser->Alamat; ?>" name="alamat" class="form-control" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="email"value="<?php echo $currentUser->Email; ?>" name="email" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                    <?php
                                    echo"<div class=col-md-4>
                                        <select name=tgl id=tgl  class=form-control>
                                        <option value='$tanggal'>$tanggal</option>";
                                        for($tgl=1; $tgl<=31; $tgl++) {
                                            echo "<option value=$tgl>$tgl</option>";
                                        }
                                        echo"</select></div>&nbsp;";
                                        $nama_bln=array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nov","Des");
                                        echo "
                                        <div class=col-md-4>
                                        <select name=bulan id=bulan class=form-control>
                                                <option value='$bulan'>$bulan</option>";
                                        for($bln=1; $bln<=12; $bln++) {
                                            echo "<option value=$bln>$nama_bln[$bln]</option>";
                                        }
                                        echo "</select>
                                        </div>&nbsp;";

                                        $thn_sekarang=date("Y");
                                        echo "<div class=col-md-4>
                                        <select name=tahun id=tahun class=form-control>
                                                <option value='$tahun'>$tahun</option>";
                                        for($thn=1970; $thn<=$thn_sekarang; $thn++) {
                                            echo "<option value=$thn>$thn</option>";
                                        }
                                        echo "</select></div>";
                                    ?>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input type="text" id="masked_phone" value="<?php echo $currentUser->NoPonsel; ?>" name="noponsel" class="form-control" placeholder="Nomor Ponsel" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input type="text" id="kode"value="<?php echo $currentUser->IDRekanan; ?>" name="kode" class="form-control" placeholder="Kode Marketing">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <select id="jenkel" name="jenkel" class="form-control">
                                        <option value="<?php echo $currentUser->JenisKelamin;?>"><?php echo $gender; ?></option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <p>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <img src="captcha.php">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="captcha" name="captcha" placeholder="Masukkan Kode" required>                        
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <p>
                            <div class="col-md-4">
                            <button id="signin" name="login" class="btn btn-info" type="submit">
                                <i class="icon-check icon-large"></i> Daftar
                            </button>
                            </div>
                             <a onClick="window.location='index.php'" id="btn_login" name="login" class="btn">
                                <i class="icon-signin icon-large"></i>  Menu Utama
                            </a>
                        </form>
                         
                           
                    </div>
                </div>
            </div>

            <footer class="clearfix">
                <div class="pull-right">
                    Create with <i class="fa fa-heart text-danger"></i> by <a href="#" target="_blank">Softmed Consultindo</a>
                </div>
                <div class="pull-left">
                    <span id="year-copy"></span> &copy; <a href="#" target="_blank">E-Performence</a>
                </div>
            </footer>
         </div>
    </div>
	<script type="text/javascript" src="js/vendor/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/video/video.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/pages/formsValidation.js"></script>
    <script>$(function(){ FormsValidation.init(); });</script>
    <script type="text/javascript">
        gradient();
    </script>
</body>
</html>
<?php
}else{
	header('location:admin.php?mod=home');
}
}else{
	header('location:./');
}
?>