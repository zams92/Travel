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

if ($mod=='pengguna' AND $act=='menutambah'){
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
elseif ($mod=='pengguna' AND $act=='menuedit'){
	function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
	}
	$passwordds = $val->validasi($_POST['password'],'xss');
	$passw = anti_injection(md5($passwordds));
	if($currentRoleAccess->password == $passw){
	$today = date("H");
	$succes = md5($today);
	$id = $val->validasi($_POST['id'],'xss');	
	
	header('location:../../administrasi.php?mod='.$mod.'&act=edit&id='.$id.'&vp='.$succes);
	}else{
		header('location:../../404.php');
	}
	
}
// Delete User
elseif ($mod=='pengguna' AND $act=='deletepengguna'){
	function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
	}
	$passwordds = $val->validasi($_POST['password'],'xss');
	$passw = anti_injection(md5($passwordds));
	
	if($currentRoleAccess->HakAkses == "Admin" AND $passw == $currentRoleAccess->password){
		$id = $val->validasi($_POST['id'],'xss');
		$tabledel = new MyTable('tblusers');
		
		$tabledel->deleteBy('IDUser', $id);
		
		
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
elseif ($mod=='pengguna' AND $act=='input'){
	if($currentRoleAccess->HakAkses == "Admin"){
		function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
	}
		$ids = $val->validasi($_POST['id'],'xss');
		$nama = $val->validasi($_POST['nama'],'xss');
		$username = $val->validasi($_POST['username'],'xss');
		$password = $val->validasi($_POST['password'],'xss');
		$hakakses = $val->validasi($_POST['hakakses'],'xss');
		$idrekanan = $val->validasi($_POST['idrekanan'],'xss');
			$table = new MyTable('tblusers');
			$table->save(array(
				'IDUser' => $ids,
				'Nama' => $nama,
				'username' => $username,
				'password' => anti_injection(md5($password)),
				'HakAkses' => $hakakses,
				'IDRekanan' => $idrekanan
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
elseif ($mod=='pengguna' AND $act=='update'){
	if($currentRoleAccess->HakAkses == "Admin"){
		$ids = $val->validasi($_POST['id'],'xss');
		$nama = $val->validasi($_POST['nama'],'xss');
		$username = $val->validasi($_POST['username'],'xss');
		$hakakses = $val->validasi($_POST['hakakses'],'xss');
		$idrekanan = $val->validasi($_POST['idrekanan'],'xss');
		$data = array(
				'Nama' => $nama,
				'username' => $username,
				'HakAkses' => $hakakses,
				'IDRekanan' => $idrekanan
			);
		$table = new MyTable('tblusers');
		$table->updateBy('IDUser', $ids, $data);
				
		header('location:../../administrasi.php?mod='.$mod);
	}
    else{
		header('location:../../404.php');
	}
}
    
// Update user untuk member
elseif ($mod=='pengguna' AND $act=='updatepengguna'){
	if($currentRoleAccess->HakAkses =='Admin' OR $currentRoleAccess->HakAkses =='Operator' OR $currentRoleAccess->HakAkses =='Perwakilan' OR $currentRoleAccess->HakAkses =='Marketing'){
		$id = $val->validasi($_POST['iduser'],'xss');
		$namalengkap = $val->validasi($_POST['nama'],'xss');
		$extensionList = array("jpg", "jpeg", "png");
		$fileName = $_FILES['fupload']['name'];
		$tmpName = $_FILES['fupload']['tmp_name'];
		$fileType = $_FILES['fupload']['type'];
		$fileSize = $_FILES['fupload']['size'];
		$extensionList = array("jpg", "jpeg");
		$pecah = explode(".", $fileName);
		$ekstensi = $pecah[1];
		$nama_file_unik = $id.'.'.$ekstensi;
		$picture = 'user-'.$nama_file_unik;
			if(empty($tmpName)){
				if (empty($_POST['newpassword'])) {
					
						$data = array(
							'Nama' => $namalengkap
						);
					
					$table = new MyTable('tblusers');
					$table->updateBy('IDUser', $id, $data);
				}
	            else{
					$pass = md5($_POST['newpassword']);
						$data = array(
							'password' => $pass,
							'Nama' => $namalengkap
						);
					}
					$table = new MyTable('tblusers');
					$table->updateBy('IDUser', $id, $data);
				
				$tableuser = new MyTable('tblusers');
				$currentUser = $tableuser->findBy(username, $_SESSION['user']);
				$currentUser = $currentUser->current();
				session_start();
				$_SESSION['IDUser'] = $currentUser->IDUser;
				$_SESSION['user'] = $currentUser->username;
				$_SESSION['namalengkap'] = $currentUser->Nama;
				$_SESSION['pass'] = $currentUser->password;
				$_SESSION['hakakses'] = $currentUser->HakAkses;
				$_SESSION['idrekanan'] = $currentUser->IDRekanan;
				header('location:../../administrasi.php?mod=home');
			}
	        else{
        	if (in_array($ekstensi, $extensionList)){
				if (empty($_POST['newpassword'])) {
					$fileimage = "myuser/user-$id.jpg";
					if (file_exists("$fileimage")){
						unlink("myuser/user-$id.jpg");
					}
					UploadUser($nama_file_unik);
					
						$data = array(
							'Nama' => $namalengkap
						);
					
					$table = new MyTable('tblusers');
					$table->updateBy('IDUser', $id, $data);
				}
	            else{
					$fileimage = "myuser/user-$id.jpg";
					if (file_exists("$fileimage")){
						unlink("myuser/user-$id.jpg");
					}
					UploadUser($nama_file_unik);
					$pass = md5($_POST['newpassword']);
						$data = array(
							'password' => $pass,
							'Nama' => $namalengkap
						);
					
					$table = new MyTable('tblusers');
					$table->updateBy('IDUser', $id, $data);
				}
				$tableuser = new MyTable('tblusers');
				$currentUser = $tableuser->findBy(username, $_SESSION['user']);
				$currentUser = $currentUser->current();
				session_start();
				$_SESSION['IDUser'] = $currentUser->IDUser;
				$_SESSION['user'] = $currentUser->username;
				$_SESSION['namalengkap'] = $currentUser->Nama;
				$_SESSION['pass'] = $currentUser->password;
				$_SESSION['hakakses'] = $currentUser->HakAkses;
				$_SESSION['idrekanan'] = $currentUser->IDRekanan;
				header('location:../../administrasi.php?mod=home');
			}else{
	            echo "<script>window.alert('Pastikan File foto yang di Upload bertipe *.JPG / .PNG');
	                window.location=('../../administrasi.php?mod=$mod')</script>";
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