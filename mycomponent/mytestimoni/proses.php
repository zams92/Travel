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

// Delete Testimoni
if ($mod=='testimoni' AND $act=='delete'){
	$id = $val->validasi($_POST['id'],'sql');
	$tabledel = new MyTable('testimoni');
	$tabledel->deleteBy('id_testimoni', $id);
	header('location:../../admin.php?mod='.$mod);
}

// Multi Delete Testimoni
elseif ($mod=='testimoni' AND $act=='multidelete'){
	$totaldata = $val->validasi($_POST['totaldata'],'xss');
	if ($totaldata != "0"){
		$itemdel = $_POST['item'];
		$tabledel = new MyTable('testimoni');
		foreach ($itemdel as $item){
			$id = $val->validasi($item['deldata'],'xss');
			$tabledel->deleteBy('id_testimoni', $id);
		}
		header('location:../../admin.php?mod='.$mod);
	}else{
		header('location:../../404.php');
	}
}

// Input Testimoni
elseif ($mod=='testimoni' AND $act=='input'){
$nama = $val->validasi($_POST['nama'],'xss');
$testimoni = stripslashes(htmlspecialchars($_POST['testimoni'],ENT_QUOTES));
$picture = $val->validasi($_POST['picture'],'xss');
$date = $val->validasi($_POST['date'],'xss');
	$table = new MyTable('testimoni');
	$table->save(array(
		'nama' => $nama,
		'testimoni' => $testimoni,
		'picture' => $picture,
		'date' => $date
	));
	header('location:../../admin.php?mod='.$mod);
}

// Edit Testimoni
elseif ($mod=='testimoni' AND $act=='update'){
$id = $val->validasi($_POST['id'],'sql');
$nama = $val->validasi($_POST['nama'],'xss');
$testimoni = stripslashes(htmlspecialchars($_POST['testimoni'],ENT_QUOTES));
$picture = $val->validasi($_POST['picture'],'xss');
$date = $val->validasi($_POST['date'],'xss');
	$data = array(
		'nama' => $nama,
		'testimoni' => $testimoni,
		'picture' => $picture,
		'date' => $date
	);
	$table = new MyTable('testimoni');
	$table->updateBy('id_testimoni', $id, $data);
	header('location:../../admin.php?mod='.$mod);
}
}
?>