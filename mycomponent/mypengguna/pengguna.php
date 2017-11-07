<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:404.php');
}else{
include_once 'mylibrary/mydatabase.php';
$aksi="mycomponent/mypengguna/proses.php";
?>
	<div class="content-header">
		<div class="header-section"><h1><?=$languser1;?></h1></div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li><a href="admin.php?mod=home"><?=$langmenu1;?></a></li>
		<li><?=$languser2;?></li>
	</ul>
<?php
switch($_GET[act]){
	default: 
    if ($_SESSION[hakakses]=='Admin'){
    ?>
        <div class="row">
            <div class="col-md-12">
                    <div class="block full">
                        <div class="block-title">
                            <h2><?=$languser1;?></h2>
                            <div class="block-options pull-right">
                                <a  data-toggle="modal" data-target="#tambahbaru" class="enable-tooltip btn btn-alt btn-sm btn-warning" data-placement="bottom" title="New User"><i class='gi gi-group'></i> Add New</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <?php
                            $tableuser = new MyTable('tblusers');
                            $users = $tableuser->findAll(IDUser, DESC);
                            echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered' id='table-datatable'>
                                <thead><tr>
                                    <th class='text-center'style='font-size: 13px;'>Nama</th>
                                    <th class='text-center'style='font-size: 13px;'>User Name</th>
                                    <th class='text-center'style='font-size: 13px;'>Hak Akses</th>
                                    <th class='text-center'style='font-size: 13px;'>ID Rekanan</th>
                                    <th class='text-center'style='font-size: 13px;'>Action</th>
                                </tr></thead>"; 
                                $no=1;
                                foreach($users as $user){
									if($user->HakAkses == 'Admin'){
										$hakakses = "<span class='label label-success'>Administrator</span>";
									}
									elseif($user->HakAkses == 'Operator') {
										$hakakses = "<span class='label label-info'>Operator</span>";									
									}
									elseif($user->HakAkses == 'Marketing') {
										$hakakses = "<span class='label label-info'>Marketing</span>";									
									}
									elseif($user->HakAkses == 'Perwakilan') {
										$hakakses = "<span class='label label-info'>Perwakilan</span>";									
									}
									if($user->HakAkses == 'Admin'){
									 echo "<tr>
                                        <td>$user->Nama</td>
                                        <td>$user->username</td>
                                        <td>$hakakses</td>
                                        <td bgcolor='silver'></td>
                                        <td class='text-center'>
                                            <div class='text-center'><div class='btn-group btn-group-xs'>
                                               <a data-placement='left' class='enable-tooltip btn btn-xs btn-default alertdeljabatan' id='$user->IDUser' title='Edit'><i class='fa fa-pencil'></i></a>
											</div></div>
                                        </td>
                                    </tr>";	
									}
									elseif($user->HakAkses == 'Operator'){
                                    echo "<tr>
                                        <td>$user->Nama</td>
                                        <td>$user->username</td>
                                        <td>$hakakses</td>
                                        <td bgcolor='silver'></td>
                                        <td class='text-center'>
                                            <div class='text-center'><div class='btn-group btn-group-xs'>
                                               <a data-placement='left' class='enable-tooltip btn btn-xs btn-default alertdeljabatan' id='$user->IDUser' title='Edit'><i class='fa fa-pencil'></i></a>
											   <a data-placement='right' class='enable-tooltip btn btn-xs btn-danger alertdel' id='$user->IDUser' title='Delete'><i class='fa fa-times'></i></a>
                                            </div></div>
                                        </td>
                                    </tr>";
									}
									else{
                                    echo "<tr>
                                        <td>$user->Nama</td>
                                        <td>$user->username</td>
                                        <td>$hakakses</td>
                                        <td>$user->IDRekanan</td>
                                        <td class='text-center'>
                                            <div class='text-center'><div class='btn-group btn-group-xs'>
                                               <a data-placement='left' class='enable-tooltip btn btn-xs btn-default alertdeljabatan' id='$user->IDUser' title='Edit'><i class='fa fa-pencil'></i></a>
											   <a data-placement='right' class='enable-tooltip btn btn-xs btn-danger alertdel' id='$user->IDUser' title='Delete'><i class='fa fa-times'></i></a>
                                            </div></div>
                                        </td>
                                    </tr>";
									}
                                    $no++;
									
                                }
                            echo "</tbody></table>";
                        ?>
                        </div>
                    </div>
            </div>
        </div>
    <?php
        } 
		?>
	<div id="alertdel" class="modal fade"  role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i>  Input Password to delete this data  </h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="pengguna">
						<input type="hidden" name="act" value="deletepengguna">
						<input type="hidden" id="delid" name="id">
						<div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-8">
                        <input class="form-control" type="password" id="password" name="password">
                        </div>
                    </div>
						
						<?=$langdelete2;?>
					</div>
					<div class="modal-footer">
						<div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> OK </button>
                        <button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
                        </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="alertdeljabatan" class="modal fade" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-info-circle text-info"> </i> Input Password to Open Edit Data Platform </h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="pengguna">
						<input type="hidden" name="act" value="menuedit">
						<input type="hidden" id="delidjabatan" name="id">
						<div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-8">
                        <input class="form-control" type="password" id="password" name="password">
                        </div>
                    </div>
						
						<?=$langdelete2;?>
					</div>
					<div class="modal-footer">
						<div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> OK </button>
                        <button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
                        </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="tambahbaru" class="modal fade" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-info-circle text-info"> </i> Input Password to Open Add New Data Platform </h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="pengguna">
						<input type="hidden" name="act" value="menutambah">
						<div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-8">
                        <input class="form-control" type="password" id="password" name="password">
                        </div>
                    </div>
						
						<?=$langdelete2;?>
					</div>
					<div class="modal-footer">
						<div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> OK </button>
                        <button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
                        </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<p style="width:100%;">&nbsp;</p>
<?php
    break;

	case "addnew":
	$valid = $val->validasi($_GET['vp'],'xss');
	$today = date("H");
	$succes = md5($today);
    if ($_SESSION[hakakses]=='Admin' AND $succes == $valid){
		
		
		
?>

	<div class="block">
        <div class="block-title">
            <h2><strong>Add</strong> Pengguna</h2>
        </div>
        <div class="row">
            <div class="col-sm-14 ">
            <div class="col-sm-7">
		      <form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
                <fieldset>
                    <input type="hidden" name="mod" value="pengguna">
                    <input type="hidden" name="act" value="input">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Username <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Repeat Password <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="password" id="repeatPass" name="repeatpass" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">HakAkses <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <select class="form-control" id="selectmenu" name="hakakses" onchange="myFunction()">
						<option> ----Pilih Hak Akses---- </option>
                        <option value="Admin"> Administrator </option>
                        <option value="Operator"> Operator </option>
                        <option value="Perwakilan"> Perwakilan </option>
                        <option value="Marketing"> Marketing </option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">ID Rekanan </label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="idrekanan" name="idrekanan" >
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                </fieldset>
            </form>
            </div>
        </div>
	</div>
<script>
function myFunction(){
	$val = document.getElementById("selectmenu").value;
	if($val=='Perwakilan'|| $val=='Marketing'){
	document.getElementById("idrekanan").readOnly = false;
	}
	else{
	document.getElementById("idrekanan").readOnly = true;
	}
}
myFunction();
</script>
<?php
    }else{
?>
	<div class="block block-alt-noborder">
		<h3 class="sub-header">Ooops! <?=$langpagenotfound1;?></h3>
		<p>&nbsp;</p>
		<p align="center">
			<?php
				$url = rtrim("http://".$_SERVER['HTTP_HOST'], "/").$_SERVER['PHP_SELF'];
				$url2 = preg_replace("/\/(admin\.php$)/","",$url);
				$siteurl = $url2;
			?>
			<a title="Back to Previous page" class="btn btn-sm btn-primary" onClick="history.back();"><?=$langpagenotfound3;?></a>
			<a href="<?=$siteurl;?>" title="Back to the website" class="btn btn-sm btn-primary"><?=$langpagenotfound2;?></a>
		</p>
		<p>&nbsp;</p>
	</div>
	<p style="width:100%; height:250px;">&nbsp;</p>
<?php
    }
    break;
    
	case "edit":
	
	$valid1 = $val->validasi($_GET['vp'],'xss');
	$today = date("H");
	$succes = md5($today);
	
	$valid = $val->validasi($_GET['id'],'xss');
	$table = new MyTable('tblusers');
	$currentUser = $table->findBy(IDUser, $valid);
	$currentUser = $currentUser->current();
	if ($currentUser == '0'){
?>
	<div class="block block-alt-noborder">
		<h3 class="sub-header">Ooops! <?=$langpagenotfound1;?></h3>
		<p>&nbsp;</p>
		<p align="center">
			<?php
				$url = rtrim("http://".$_SERVER['HTTP_HOST'], "/").$_SERVER['PHP_SELF'];
				$url2 = preg_replace("/\/(administrasi\.php$)/","",$url);
				$siteurl = $url2;
			?>
			<a title="Back to Previous page" class="btn btn-sm btn-primary" onClick="history.back();"><?=$langpagenotfound3;?></a>
			<a href="<?=$siteurl;?>" title="Back to the website" class="btn btn-sm btn-primary"><?=$langpagenotfound2;?></a>
		</p>
		<p>&nbsp;</p>
	</div>
	<p style="width:100%; height:250px;">&nbsp;</p>
<?php
	}else{
		if ($_SESSION[hakakses]=='Admin' AND $succes == $valid1){
?>
	<div class="block">
        <div class="block-title">
            <h2><strong>Edit</strong> Pengguna</h2>
        </div>
        <div class="row">
            <div class="col-sm-14 ">
            <div class="col-sm-7">
		      <form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
                <fieldset>
                    <input type="hidden" name="mod" value="pengguna">
                    <input type="hidden" name="act" value="update">
                    <input type="hidden" id="id" name="id" value="<?=$currentUser->IDUser?>">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Username <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="username" name="username" value="<?=$currentUser->username?>" required>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="col-md-4 control-label">HakAkses <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <select class="form-control" id="selectmenu" name="hakakses" onchange="myFunction()">
						<option> ----Pilih Hak Akses---- </option>
                        <option value="Admin"> Administrator </option>
                        <option value="Operator"> Operator </option>
                        <option value="Perwakilan"> Perwakilan </option>
                        <option value="Marketing"> Marketing </option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="nama" name="nama" value="<?=$currentUser->Nama?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">ID Rekanan </label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="idrekanan" name="idrekanan" value="<?=$currentUser->IDRekanan?>" >
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                </fieldset>
            </form>
			<script>

document.getElementById('selectmenu').value = "<?=$currentUser->HakAkses?>";
function myFunction(){
	$val = document.getElementById("selectmenu").value;
	if($val=='Perwakilan'|| $val=='Marketing'){
	document.getElementById("idrekanan").readOnly = false;
	}
	else{
	document.getElementById("idrekanan").readOnly = true;
	}
}
myFunction();
</script>
            </div>
        </div>
	</div>
<?php
		} 
	}
    break;

	case "profile":
	
	$valid = $val->validasi($_GET['id'],'xss');
	$table = new MyTable('tblusers');
	$currentUser = $table->findBy(IDUser, $valid);
	$currentUser = $currentUser->current();
	$dutf=html_entity_decode($currentUser->bio);
	if ($currentUser == '0'){
?>
	<div class="block block-alt-noborder">
		<h3 class="sub-header">Ooops! <?=$langpagenotfound1;?></h3>
		<p>&nbsp;</p>
		<p align="center">
			<?php
				$url = rtrim("http://".$_SERVER['HTTP_HOST'], "/").$_SERVER['PHP_SELF'];
				$url2 = preg_replace("/\/(admin\.php$)/","",$url);
				$siteurl = $url2;
			?>
			<a title="Back to Previous page" class="btn btn-sm btn-primary" onClick="history.back();"><?=$langpagenotfound3;?></a>
			<a href="<?=$siteurl;?>" title="Back to the website" class="btn btn-sm btn-primary"><?=$langpagenotfound2;?></a>
		</p>
		<p>&nbsp;</p>
	</div>
	<p style="width:100%; height:250px;">&nbsp;</p>
<?php
	}else{
		if ($_SESSION[hakakses]=='Admin' OR $_SESSION[hakakses]=='Operator' OR $_SESSION[hakakses]=='Perwakilan' OR $_SESSION[hakakses]=='Marketing'){
		?>
		
		<div class="block full">
		<div class="block-title"><h2>Edit Profile</h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" enctype="multipart/form-data" autocomplete="off">
			<fieldset>
				<input type="hidden" name="iduser" value="<?=$currentUser->IDUser;?>">
				<input type="hidden" name="mod" value="pengguna">
				<input type="hidden" name="act" value="updatepengguna">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="<?=$currentUser->username;?>" disabled>
                            <span class="help-block">Username can not be changed, except from direct database (phpmyadmin)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" id="newpassword" name="newpassword">
                            <span class="help-block">If the password is not changed, just empty</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="nama" name="nama" value="<?=$currentUser->Nama;?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto Pengguna</label><br>
                            <a href="myuser/user-<?=$currentUser->IDUser;?>.jpg" data-toggle="lightbox-image">
                                <?php
                                    $filename = "myuser/user-$currentUser->IDUser.jpg";
                                    if (file_exists("$filename")){
                                        echo "<img src='myuser/user-$currentUser->IDUser.jpg' alt='avatar' style='width:100px;'/>";
                                    }else{
                                        echo "<img src='myuser/user-editor.jpg' alt='avatar' style='width:100px;'/>";
                                    }
                                ?>
                            </a>
                            <input id="fileInput" name="fupload" type="file">
                        </div>
                    </div>
                </div>
				<div class="form-group form-actions">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					<button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
				</div>
			</fieldset>
		</form>
	</div>
	<?php
		}
	}
}
}
?>