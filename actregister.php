<?php
error_reporting(0);
session_start();
include_once 'mylibrary/mydatabase.php';
include_once 'mylibrary/myfunction.php';
function anti_injection($data){
	$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
}
$Stts = anti_injection($_POST['status']);
$Nama = anti_injection($_POST['username']);
$Alamat = anti_injection($_POST['alamat']);
$NoPonsel = anti_injection($_POST['noponsel']);
$Email = anti_injection($_POST['email']);
$tanggal = anti_injection($_POST['tgl']);
$bulan = anti_injection($_POST['bulan']);
$tahun = anti_injection($_POST['tahun']);
$Kode = anti_injection($_POST['kode']);
$Jenkel = anti_injection($_POST['jenkel']);
$TanggalLahir = "$tahun-$bulan-$tanggal";
//$date = "$tahun-$bulan-$tgl";

						$tabledel = new MyTable('temp');
						$tabledel->delete();
						$table = new MyTable('temp');
						$table->save(array(				
							'Nama' => $Nama,
							'Alamat' => $Alamat,
							'NoPonsel' => $NoPonsel, 
							'Email' => $Email,
							'TanggalLahir' => $TanggalLahir,
							'JenisKelamin' => $Jenkel,
							'Status' => 'N',
							'DaftarSebagai' => $Stts,
							'IDRekanan' => $Kode
						));

	if(!(preg_match("/^[\.A-z0-9_\-\+]+@((gmail)|(yahoo)|(ymail)|(rocketmail)|(hotmail)|(mail)|(telkom)|(plaza)|(inbox)|(lifedeary)|(aim)|(aol))+.((com)|(co.id)|(edu)|(net))$/", $Email))){
		header('location:register.php?errormsg=2');
	}else{
		$table = new MyTable('tblpendaftaran');
		$currentEmail = $table->findBy(Email, $Email);
		$currentEmail = $currentEmail->current();
			if(!empty($_POST['captcha'])){
				if($_POST['captcha']==$_SESSION['captcha_session']){
					$currentUser = $table->findBy(Nama, $Nama);
					$currentUser = $currentUser->current();
						$tableuser = new MyTable('tblpendaftaran');
						$users = $tableuser->findAll('KodeDaftar', 'ASC');
						foreach($users as $user){
							$user = $user->id_user;
						}
						$id_user = $user + 1;
						$iduser = buatkode($id_user, 166, 5);
						$sesi = (md5($iduser));
						$table = new MyTable('tblpendaftaran');
						$table->save(array(				
							'Nama' => $Nama,
							'Alamat' => $Alamat,
							'NoPonsel' => $NoPonsel, 
							'Email' => $Email,
							'TanggalLahir' => $TanggalLahir,
							'JenisKelamin' => $Jenkel,
							'Status' => 'N',
							'DaftarSebagai' => $Stts,
							'IDRekanan' => $Kode
						));
						header('location:register.php?errormsg=7');
						$tabledel = new MyTable('temp');
						$tabledel->delete();
				}else{
					header('location:register.php?errormsg=5');
				}
			}else{
				header('location:register.php?errormsg=4');
			}
	}
?>