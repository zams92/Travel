<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:../../404.php');
}else{
include_once '../../mylibrary/mydatabase.php';
include_once '../../mylibrary/myfunction.php';

$val = new Myvalidasi;
$mod = $_POST['mod'];
$act = $_POST['act'];

$tableroleaccess = new MyTable('user_role');
$currentRoleAccess = $tableroleaccess->findByAnd(id_level, $_SESSION['leveluser'], module, $mod);
$currentRoleAccess = $currentRoleAccess->current();

// Delete User
if ($mod=='user' AND $act=='deleteuser'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new MyTable('users');
		$currentSearch = $tabledel->findBy(id_user, $id);
		$currentSearch = $currentSearch->current();
		if ($ekstensi=='jpg'){
			unlink("myuser/user-$id.jpg");
			$tabledel->deleteBy('id_user', $id);
		}else{
			unlink("myuser/user-$id.jpg");
			$tabledel->deleteBy('id_user', $id);
		}
		header('location:../../admin.php?mod='.$mod);
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
elseif ($mod=='user' AND $act=='deleteuserjabatan'){
	if($currentRoleAccess->delete_access == "Y"){
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
elseif ($mod=='user' AND $act=='input'){
	if($currentRoleAccess->write_access == "Y"){
		$username = $val->validasi($_POST['username'],'xss');
		$pass = md5($_POST[password]);
		$namalengkap = $val->validasi($_POST['nama_lengkap'],'xss');
		$email = $val->validasi($_POST['email'],'xss');
		$telp = $val->validasi($_POST['no_telp'],'xss');
		$level = $val->validasi($_POST['level'],'xss');
		$alamat = $val->validasi($_POST['alamat'],'xss');
			$tableuser = new MyTable('users');
			$users = $tableuser->findAll('id_user', 'ASC');
			foreach($users as $user){
				$user = $user->id_user;
			}
			$id_user = $user + 1;
			$table = new MyTable('users');
			$table->save(array(
				'id_user' => $id_user,
				'username' => $username,
				'password' => $pass,
				'nama_lengkap' => $namalengkap,
				'email' => $email, 
				'no_telp' => $telp,
				'alamat' => $alamat,
				'level' => $level,
				'tgl_daftar' => $tgl_sekarang,
				'id_session' => $pass
			));
			header('location:../../admin.php?mod='.$mod);
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
elseif ($mod=='user' AND $act=='update'){
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
        $extensionList = array("jpg", "JPG");
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
				header('location:../../admin.php?mod='.$mod);
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
				header('location:../../admin.php?mod='.$mod);
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