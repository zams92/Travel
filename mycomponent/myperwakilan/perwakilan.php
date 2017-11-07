<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:404.php');
}else{
include_once 'mylibrary/mydatabase.php';
$aksi="mycomponent/myperwakilan/proses.php";
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
                            $tableuser = new MyTable('tblperwakilan');
                            $users = $tableuser->findAll(KodePerwakilan, DESC);
                            echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered' id='table-datatable'>
                                <thead><tr>
                                    <th class='text-center'style='font-size: 13px;'>ID</th>
                                    <th class='text-center'style='font-size: 13px;'>Nama</th>
                                    <th class='text-center'style='font-size: 13px;'>Alamat</th>
                                    <th class='text-center'style='font-size: 13px;'>No Ponsel</th>
                                    <th class='text-center'style='font-size: 13px;'>Email</th>
                                    <th class='text-center'style='font-size: 13px;'>Tanggal Lahir</th>
                                    <th class='text-center'style='font-size: 13px;'>Jenis Kelamin</th>
                                    <th class='text-center'style='font-size: 13px;'>Status</th>
                                    <th class='text-center'style='font-size: 13px;'>Keterangan</th>
                                    <th class='text-center'style='font-size: 13px;'>Jumlah Marketing Level 1</th>
                                    <th class='text-center'style='font-size: 13px;'>Action</th>
                                </tr></thead>"; 
                                $no=1;
                                foreach($users as $user){
                                    $tablelevel = new MyTable('tblperwakilan');
                                    $currentLevel = $tablelevel->findBy(KodePerwakilan, $user->KodePerwakilan);
                                    $currentLevel = $currentLevel->current();
									if($user->Status == 'Y'){
										$status = "<span class='label label-success'>Aktif</span>";
									}else {
										$status = "<span class='label label-info'>Tidak Aktif</span>";									
									}
									if($user->JenisKelamin == 'L') {
										$gender = "Laki-laki";
									}else {
										$gender = "Perempuan";
									}
                                    echo "<tr>
                                        <td>$user->IDPerwakilan</td>
                                        <td>$user->Nama</td>
                                        <td>$user->Alamat</td>
                                        <td>$user->NoPonsel</td>
                                        <td>$user->Email</td>
                                        <td>$user->TanggalLahir</td>
                                        <td>$gender</td>
                                        <td class='text-center'>$status</td>
                                        <td>$user->Keterangan</td>";
										$tablejumlah = new MyTable('tblmarketing');
										$datajumlah = $tablejumlah->numRowBy(IDPerwakilan,$user->IDPerwakilan);
                                    echo"    <td>$datajumlah</td>
                                        <td class='text-center'>
                                            <div class='text-center'><div class='btn-group btn-group-xs'>
                                               <a data-placement='left' class='enable-tooltip btn btn-xs btn-default alertdeljabatan' id='$user->KodePerwakilan' title='Edit'><i class='fa fa-pencil'></i></a>
											   <a data-placement='right' class='enable-tooltip btn btn-xs btn-danger alertdel' id='$user->KodePerwakilan' title='Delete'><i class='fa fa-times'></i></a>
                                            </div></div>
                                        </td>
                                    </tr>";
                                    $no++;
                                }
                            echo "</tbody></table>";
                        ?>
                        </div>
                    </div>
            </div>
        </div>
    <?php
        } elseif ($_SESSION[hakakses]=='Operator'){
		?>
		<div class="row">
            <div class="col-md-12">
                    <div class="block full">
                        <div class="block-title">
                            <h2><?=$languser1;?></h2>
                        </div>
                        <div class="table-responsive">
                        <?php
                            $tableuser = new MyTable('tblperwakilan');
                            $users = $tableuser->findAll(KodePerwakilan, DESC);
                            echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered' id='table-datatable'>
                                <thead><tr>
                                    <th class='text-center'style='font-size: 13px;'>ID</th>
                                    <th class='text-center'style='font-size: 13px;'>Nama</th>
                                    <th class='text-center'style='font-size: 13px;'>Alamat</th>
                                    <th class='text-center'style='font-size: 13px;'>No Ponsel</th>
                                    <th class='text-center'style='font-size: 13px;'>Email</th>
                                    <th class='text-center'style='font-size: 13px;'>Tanggal Lahir</th>
                                    <th class='text-center'style='font-size: 13px;'>Jenis Kelamin</th>
                                    <th class='text-center'style='font-size: 13px;'>Status</th>
                                    <th class='text-center'style='font-size: 13px;'>Keterangan</th>
                                </tr></thead>"; 
                                $no=1;
                                foreach($users as $user){
                                    $tablelevel = new MyTable('tblperwakilan');
                                    $currentLevel = $tablelevel->findBy(KodePerwakilan, $user->KodePerwakilan);
                                    $currentLevel = $currentLevel->current();
									if($user->Status == 'Y'){
										$status = "<span class='label label-success'>Aktif</span>";
									}else {
										$status = "<span class='label label-info'>Tidak Aktif</span>";									
									}
									if($user->JenisKelamin == 'L') {
										$gender = "Laki-laki";
									}else {
										$gender = "Perempuan";
									}
                                    echo "<tr>
                                        <td>$user->IDPerwakilan</td>
                                        <td>$user->Nama</td>
                                        <td>$user->Alamat</td>
                                        <td>$user->NoPonsel</td>
                                        <td>$user->Email</td>
                                        <td>$user->TanggalLahir</td>
                                        <td>$gender</td>
                                        <td class='text-center'>$status</td>
                                        <td>$user->Keterangan</td>
                                        
                                    </tr>";
                                    $no++;
                                }
                            echo "</tbody></table>";
                        ?>
                        </div>
                    </div>
            </div>
        </div>
		<?php }?>
	<div id="alertdel" class="modal fade"  role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i>  Input Password to delete this data  </h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="perwakilan">
						<input type="hidden" name="act" value="deleteperwakilan">
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
						<input type="hidden" name="mod" value="perwakilan">
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
						<input type="hidden" name="mod" value="perwakilan">
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
		function acakangkahuruf($panjang) 
		{ 
		$karakter= 'ABCDEFGHIJKL1234567890'; $string = ''; 
		do {
		for ($i = 0; $i < $panjang; $i++) 
		{ 
		$pos = rand(0, strlen($karakter)-1); 
		$string .= $karakter{$pos}; 
		} 
		$table1  = new MyTable('tblrekanan');
		$total1  = $table1->numRowBy(IDRekanan, $string);
		}
		while (total1 > 0);
		return $string; 
		}
		
		
?>
	<div class="block">
        <div class="block-title">
            <h2><strong>Add</strong> Perwakilan</h2>
        </div>
        <div class="row">
            <div class="col-sm-14 ">
            <div class="col-sm-7">
		      <form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
                <fieldset>
                    <input type="hidden" name="mod" value="perwakilan">
                    <input type="hidden" name="act" value="input">

                    <div class="form-group">
                        <label class="col-md-4 control-label">ID <span class="text-danger"></span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="idper" name="idper"  value="<?php echo acakangkahuruf(15) ?>" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="text" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Alamat<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="text" id="alamat" name="alamat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No Ponsel <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="noponsel" name="noponsel" maxlength=15 onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Email <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="email" name="email" required>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-4 control-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="date" id="tanggallahir" name="tanggallahir" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Jenis Kelamin<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <Select class="form-control" name="jeniskelamin"  >
						<option value="L" >Laki-laki</option>
						<option value="P" >Perempuan</option>
						</Select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Status <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <Select class="form-control" name="status" >
						<option value="Y" >Aktif</option>
						<option value="N" >Tidak Aktif</option>
						</Select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Keterangan<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="textarea" id="keterangan" name="keterangan" required>
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
	$table = new MyTable('tblperwakilan');
	$currentUser = $table->findBy(KodePerwakilan, $valid);
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
            <h2><strong>Edit</strong> Perwakilan</h2>
        </div>
        <div class="row">
            <div class="col-sm-14 ">
            <div class="col-sm-7">
		      <form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
                <fieldset>
				
                    <input type="hidden" name="kodeperwakilan" value="<?=$currentUser->KodePerwakilan; ?>">
                    <input type="hidden" name="mod" value="perwakilan">
                    <input type="hidden" name="act" value="update">

                    <div class="form-group">
                        <label class="col-md-4 control-label">ID <span class="text-danger"></span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="idper" name="idper"  value="<?=$currentUser->IDPerwakilan; ?>" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="text" id="nama" name="nama" value="<?=$currentUser->Nama; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Alamat<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="text" id="alamat" name="alamat" value="<?=$currentUser->Alamat; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No Ponsel <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="noponsel" name="noponsel" maxlength=15 onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="<?=$currentUser->NoPonsel; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Email <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="email" name="email" value="<?=$currentUser->Email; ?>" required>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-4 control-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="date" id="tanggallahir" name="tanggallahir" value="<?=$currentUser->TanggalLahir; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Jenis Kelamin<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <Select class="form-control" name="jeniskelamin"  >
						<?php
						if($currentUser->JenisKelamin == 'L'){
						?>
						<option value="L" >Laki-laki</option>
						<option value="P" >Perempuan</option>
						<?php
						}
						else{
						?>
						<option value="P" >Perempuan</option>
						<option value="L" >Laki-laki</option>
						<?php
						}
						?>
						</Select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Status <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <Select class="form-control" name="status" >
						<?php
						if($currentUser->Status == 'Y'){
						?>
						<option value="Y" >Aktif</option>
						<option value="N" >Tidak Aktif</option>
						<?php
						}
						else{
						?>
						<option value="N" >Tidak Aktif</option>
						<option value="Y" >Aktif</option>
						<?php
						}
						?>
						</Select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Keterangan<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="textarea" id="keterangan" name="keterangan" value="<?=$currentUser->Keterangan; ?>" required>
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
<?php
		} 
	}
    break;  
}
}
?>