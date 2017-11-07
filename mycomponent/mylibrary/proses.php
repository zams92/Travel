<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:../../404.php');
}else{
include_once '../../../mylibrary/mydatabase.php';
include_once '../../../mylibrary/myfunction.php';

$val = new Myvalidasi;
$mod = $_POST['mod'];
$act = $_POST['act'];

$tableroleaccess = new MyTable('user_role');
$currentRoleAccess = $tableroleaccess->findByAnd(id_level, $_SESSION['leveluser'], module, $mod);
$currentRoleAccess = $currentRoleAccess->current();

// Hapus Media
if ($mod=='library' AND $act=='delete'){
	if($currentRoleAccess->delete_access == "Y"){
		$id = $val->validasi($_POST['id'],'sql');
		$tabledel = new MyTable('media');
		$currentSearch = $tabledel->findBy(id_media, $id);
		$currentSearch = $currentSearch->current();
		$picture = $currentSearch->file_name;
		$pecah = explode(".", $picture);
		$ekstensi = $pecah[1];
		if ($ekstensi=='jpg'){
			unlink("../../../mycontent/myupload/$picture");
			unlink("../../../mycontent/myupload/medium-$picture");
			$tabledel->deleteBy('id_media', $id);
		}else{
			unlink("../../../mycontent/myupload/$picture");
			$tabledel->deleteBy('id_media', $id);
		}
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Multi Delete Media
elseif ($mod=='library' AND $act=='multidelete'){
	if($currentRoleAccess->delete_access == "Y"){
		$totaldata = $val->validasi($_POST['totaldata'],'xss');
		if ($totaldata != "0"){
			$itemdel = $_POST['item'];
			$tabledel = new MyTable('media');
			foreach ($itemdel as $item){
				$id = $val->validasi($item['deldata'],'xss');
				$tabledel = new MyTable('media');
				$currentSearch = $tabledel->findBy(id_media, $id);
				$currentSearch = $currentSearch->current();
				$picture = $currentSearch->file_name;
				$pecah = explode(".", $picture);
				$ekstensi = $pecah[1];
				if ($ekstensi=='jpg'){
					unlink("../../../mycontent/myupload/$picture");
					unlink("../../../mycontent/myupload/medium-$picture");
					$tabledel->deleteBy('id_media', $id);
				}else{
					unlink("../../../mycontent/myupload/$picture");
					$tabledel->deleteBy('id_media', $id);
				}
			}
			header('location:../../admin.php?mod='.$mod);
		}else{
			header('location:../../404.php');
		}
	}else{
		header('location:../../404.php');
	}
}

// Input Media
elseif ($mod=='library' AND $act=='input'){
	if($currentRoleAccess->write_access == "Y"){
		$extensionList = array("jpg", "png", "xls", "xlsx", "ppt", "pptx", "txt", "doc", "docx", "pdf", "psd");
		$fileName = $_FILES['fupload']['name'];
		$tmpName = $_FILES['fupload']['tmp_name'];
		$fileType = $_FILES['fupload']['type'];
		$fileSize = $_FILES['fupload']['size'];
		$pecah = explode(".", $fileName);
		$ekstensi = $pecah[1];
		$title = $pecah[0];
		$seotitle = seo_title($title);
		$acak = rand(000000,999999);
		$nama_file = "-library.";
		$nama_file_unik = $seotitle.'-'.$acak.$nama_file.$ekstensi;
		$namaDir = '../../../mycontent/myupload/';
        $path = '../../../mycontent/myupload/';
        $new=$path.$nama_file_unik;
		if (!empty($tmpName)){
			if (in_array($ekstensi, $extensionList)){
				if ($ekstensi=='jpg'){
                    watermark_image($new);
					UploadImage($nama_file_unik);
					$table = new MyTable('media');
					$table->save(array(
						'file_name' => $nama_file_unik,
						'file_type' => $fileType,
						'file_size' => $fileSize,  
						'date' => $tgl_sekarang,
						'editor' => $_SESSION['iduser']
					));
					header('location:../../admin.php?mod='.$mod);
				}else{
					move_uploaded_file($tmpName, $pathFile);
					$table = new MyTable('media');
					$table->save(array(
						'file_name' => $nama_file_unik,
						'file_type' => $fileType,
						'file_size' => $fileSize,  
						'date' => $tgl_sekarang,
						'editor' => $_SESSION['iduser']
					));
					header('location:../../admin.php?mod='.$mod);
				}
			}else{
	            echo "<script>window.alert('Pastikan File foto yang di Upload bertipe *.JPG / .PNG');
	                window.location=('../../admin.php?mod=$mod')</script>";
			}
		}else{
			header('location:../../404.php');
		}
	}else{
		header('location:../../404.php');
	}
}
}
?>