<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:../../404.php');
}else{
include_once '../../mylibrary/mydatabase.php';
include_once '../../mylibrary/myfunction.php';

$val = new Myvalidasi;
$mod = $_POST['mod'];
$act = $_POST['act'];

$tableroleaccess = new MyTable('tblusers');
$currentRoleAccess = $tableroleaccess->findByAnd(HakAkses, $_SESSION['hakakses'], username, $_SESSION['user']);
$currentRoleAccess = $currentRoleAccess->current();

if ($mod=='level' AND $act=='menutambah'){
	function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
	}
	$passwordds = $val->validasi($_POST['password'],'xss');
	$passw = anti_injection(md5($passwordds));
	if($currentRoleAccess->password == $passw){
	
	$today = date("H");
	$succes = md5($today);	
	header('location:../../administrasi.php?mod='.$mod.'&act=addnew&vp='.$succes);
	}else{
		header('location:../../404.php');
	}
	
}
elseif ($mod=='level' AND $act=='menuedit'){
	function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
	}
	$passwordds = $val->validasi($_POST['password'],'xss');
	$passw = anti_injection(md5($passwordds));
	if($currentRoleAccess->password == $passw){
	$today = date("H");
	$succes = md5($today);
	$id = $val->validasi($_POST['namalevel'],'xss');	
	
	header('location:../../administrasi.php?mod='.$mod.'&act=edit&id='.$id.'&vp='.$succes);
	}else{
		header('location:../../404.php');
	}
	
}
// Delete User
elseif ($mod=='level' AND $act=='deletelevel'){
	function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
	}
	$passwordds = $val->validasi($_POST['password'],'xss');
	$passw = anti_injection(md5($passwordds));
	
	if($currentRoleAccess->HakAkses == "Admin" AND $passw == $currentRoleAccess->password){
		$id = $val->validasi($_POST['namalevel'],'xss');
		$tabledel = new MyTable('tbllevel');
		
		$tabledel->deleteBy('NamaLevel', $id);
		
		
		header('location:../../administrasi.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Delete User Level
elseif ($mod=='user' AND $act=='deleteuserlevel'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new MyTable('user_level');
		$tabledel->deleteBy('id_level', $id);
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}
    
// Delete User jabatan
elseif ($mod=='perwakilan' AND $act=='deleteuserjabatan'){
	if($currentRoleAccess->HakAkses == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new MyTable('user_jabatan');
		$tabledel->deleteBy('id_jabatan', $id);
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Delete User Role
elseif ($mod=='user' AND $act=='deleteuserrole'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new MyTable('user_role');
		$tabledel->deleteBy('id_role', $id);
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Input user
elseif ($mod=='level' AND $act=='input'){
	if($currentRoleAccess->HakAkses == "Admin"){
		$ids = $val->validasi($_POST['namalevel'],'xss');
		$komisi = $val->validasi($_POST['komisi'],'xss');
		$keterangan = $val->validasi($_POST['keterangan'],'xss');
			$table = new MyTable('tbllevel');
			$table->save(array(
				'NamaLevel' => $ids,
				'Komisi' => $komisi,
				'Keterangan' => $keterangan
			));
			header('location:../../administrasi.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Input User Level
elseif ($mod=='user' AND $act=='adduserlevel'){
	if($currentRoleAccess->write_access == "Y"){
		$title = $val->validasi($_POST['title'],'xss');
			$table = new MyTable('user_level');
			$table->save(array(
				'level' => $title
			));
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Input User jabatan
elseif ($mod=='user' AND $act=='adduserjabatan'){
	if($currentRoleAccess->write_access == "Y"){
		$title = $val->validasi($_POST['title'],'xss');
			$table = new MyTable('user_jabatan');
			$table->save(array(
				'jabatan' => $title
			));
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}
    
// Input User Role
elseif ($mod=='user' AND $act=='adduserrole'){
	if($currentRoleAccess->write_access == "Y"){
		$title = $val->validasi($_POST['title'],'xss');
		$level = $val->validasi($_POST['level'],'xss');
		$read_access = $val->validasi($_POST['read_access'],'xss');
		$write_access = $val->validasi($_POST['write_access'],'xss');
		$modify_access = $val->validasi($_POST['modify_access'],'xss');
		$delete_access = $val->validasi($_POST['delete_access'],'xss');
			$table = new MyTable('user_role');
			$table->save(array(
				'id_level' => $level,
				'module' => $title,
				'read_access' => $read_access,
				'write_access' => $write_access,
				'modify_access' => $modify_access,
				'delete_access' => $delete_access
			));
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Update user
elseif ($mod=='level' AND $act=='update'){
	if($currentRoleAccess->HakAkses == "Admin"){
		$id = $val->validasi($_POST['namalevel'],'xss');
		$komisi = $val->validasi($_POST['komisi'],'xss');
		$keterangan = $val->validasi($_POST['keterangan'],'xss');
		$data = array(
			'Komisi' => $komisi,
			'Keterangan' => $keterangan
			);
		$table = new MyTable('tbllevel');
		$table->updateBy('NamaLevel', $id, $data);
				
		header('location:../../administrasi.php?mod='.$mod);
	}
    else{
		header('location:../../404.php');
	}
}
    
// Update user untuk member
elseif ($mod=='user' AND $act=='updatemember'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id'],'xss');
		$iduser = $val->validasi($_POST['iduser'],'xss');
		$namalengkap = $val->validasi($_POST['nama_lengkap'],'xss');
		$email = $val->validasi($_POST['email'],'xss');
		$telp = $val->validasi($_POST['no_telp'],'xss');
		$jabatan= $val->validasi($_POST['jabatan'],'xss');
		$alamat = $val->validasi($_POST['alamat'],'xss');
		$level = $val->validasi($_POST['level'],'xss');
		$blokir = $val->validasi($_POST['blokir'],'xss');
		$locktype = $val->validasi($_POST['locktype'],'xss');
		$data = $_POST[bio];
		$eutf = htmlspecialchars($data,ENT_QUOTES);
		$extensionList = array("jpg", "jpeg", "png");
		$fileName = $_FILES['fupload']['name'];
		$tmpName = $_FILES['fupload']['tmp_name'];
		$fileType = $_FILES['fupload']['type'];
		$fileSize = $_FILES['fupload']['size'];
		$extensionList = array("jpg", "jpeg");
		$pecah = explode(".", $fileName);
		$ekstensi = $pecah[1];
		$nama_file_unik = $iduser.'.'.$ekstensi;
		$picture = 'user-'.$nama_file_unik;
			if(empty($tmpName)){
				if (empty($_POST['newpassword'])) {
					if ($_SESSION[leveluser]=='1' OR $_SESSION[leveluser]=='2'){
						$data = array(
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'blokir' => $blokir,  
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'level' => $level,
							'bio' => $data,
							'locktype' => $locktype
						);
					}else{
						$data = array(
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'bio' => $data,
							'locktype' => $locktype
						);
					}
					$table = new MyTable('users');
					$table->updateBy('id_session', $id, $data);
				}
	            else{
					$pass = md5($_POST['newpassword']);
					if ($_SESSION[leveluser]=='1' OR $_SESSION[leveluser]=='2'){
						$data = array(
							'password' => $pass,
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'blokir' => $blokir,
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'level' => $level,
							'bio' => $data,
							'locktype' => $locktype
						);
					}else{
						$data = array(
							'password' => $pass,
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'bio' => $data,
							'locktype' => $locktype
						);
					}
					$table = new MyTable('users');
					$table->updateBy('id_session', $id, $data);
				}
				$tableuser = new MyTable('users');
				$currentUser = $tableuser->findBy(username, $_SESSION['namauser']);
				$currentUser = $currentUser->current();
				session_start();
				$_SESSION['iduser'] = $currentUser->id_user;
				$_SESSION['namauser'] = $currentUser->username;
				$_SESSION['namalengkap'] = $currentUser->nama_lengkap;
				$_SESSION['passuser'] = $currentUser->password;
				$_SESSION['leveluser'] = $currentUser->level;
				header('location:../../admin.php?mod=home');
			}
	        else{
        	if (in_array($ekstensi, $extensionList)){
				if (empty($_POST['newpassword'])) {
					$fileimage = "myuser/user-$iduser.jpg";
					if (file_exists("$fileimage")){
						unlink("myuser/user-$iduser.jpg");
					}
					UploadUser($nama_file_unik);
					if ($_SESSION[leveluser]=='1' OR $_SESSION[leveluser]=='2'){
						$data = array(
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'blokir' => $blokir,  
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'level' => $level,
							'userpicture' => $nama_file_unik,
							'bio' => $data,
							'locktype' => $locktype
						);
					}else{
						$data = array(
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'userpicture' => $nama_file_unik,
							'bio' => $data,
							'locktype' => $locktype
						);
					}
					$table = new MyTable('users');
					$table->updateBy('id_session', $id, $data);
				}
	            else{
					$fileimage = "myuser/user-$iduser.jpg";
					if (file_exists("$fileimage")){
						unlink("myuser/user-$iduser.jpg");
					}
					UploadUser($nama_file_unik);
					$pass = md5($_POST['newpassword']);
					if ($_SESSION[leveluser]=='1' OR $_SESSION[leveluser]=='2'){
						$data = array(
							'password' => $pass,
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'blokir' => $blokir,
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'level' => $level,
							'userpicture' => $nama_file_unik,
							'bio' => $data,
							'locktype' => $locktype
						);
					}else{
						$data = array(
							'password' => $pass,
							'nama_lengkap' => $namalengkap,
							'email' => $email,
							'no_telp' => $telp,
	                        'alamat' => $alamat,
	                        'jabatan' => $jabatan,
							'userpicture' => $nama_file_unik,
							'bio' => $data,
							'locktype' => $locktype
						);
					}
					$table = new MyTable('users');
					$table->updateBy('id_session', $id, $data);
				}
				$tableuser = new MyTable('users');
				$currentUser = $tableuser->findBy(username, $_SESSION['namauser']);
				$currentUser = $currentUser->current();
				session_start();
				$_SESSION['iduser'] = $currentUser->id_user;
				$_SESSION['namauser'] = $currentUser->username;
				$_SESSION['namalengkap'] = $currentUser->nama_lengkap;
				$_SESSION['passuser'] = $currentUser->password;
				$_SESSION['leveluser'] = $currentUser->level;
				header('location:../../admin.php?mod=home');
			}else{
	            echo "<script>window.alert('Pastikan File foto yang di Upload bertipe *.JPG / .PNG');
	                window.location=('../../admin.php?mod=$mod')</script>";
			}
			}	
	}
    else{
		header('location:../../404.php');
	}
}

// Edit User Level
elseif ($mod=='user' AND $act=='edituserlevel'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$title = $val->validasi($_POST['title'],'xss');
			$data = array(
				'level' => $title
			);
			$table = new MyTable('user_level');
			$table->updateBy('id_level', $id, $data);
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}
 
// Edit User jabatan
elseif ($mod=='user' AND $act=='edituserjabatan'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$title = $val->validasi($_POST['title'],'xss');
			$data = array(
				'jabatan' => $title
			);
			$table = new MyTable('user_jabatan');
			$table->updateBy('id_jabatan', $id, $data);
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}
    
// Edit User Role
elseif ($mod=='user' AND $act=='edituserrole'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$title = $val->validasi($_POST['title'],'xss');
		$level = $val->validasi($_POST['level'],'xss');
		$read_access = $val->validasi($_POST['read_access'],'xss');
		$write_access = $val->validasi($_POST['write_access'],'xss');
		$modify_access = $val->validasi($_POST['modify_access'],'xss');
		$delete_access = $val->validasi($_POST['delete_access'],'xss');
			$data = array(
				'id_level' => $level,
				'module' => $title,
				'read_access' => $read_access,
				'write_access' => $write_access,
				'modify_access' => $modify_access,
				'delete_access' => $delete_access
			);
			$table = new MyTable('user_role');
			$table->updateBy('id_role', $id, $data);
			header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}
    
// Set Headline
elseif ($mod=='user' AND $act=='setblokir'){
	if($currentRoleAccess->modify_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$headline = $val->validasi($_POST['blokir'],'xss');
			$data = array(
				'blokir' => $headline
			);
			$table = new MyTable('users');
			$table->updateBy('id_user', $id, $data);
	}else{
		echo "404 Not Found Access";
	}
}
}
?>