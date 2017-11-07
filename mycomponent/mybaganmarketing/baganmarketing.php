<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:404.php');
}else{
include_once 'mylibrary/mydatabase.php';
$aksi="mycomponent/mybaganmarketing/proses.php";

switch($_GET[act]){
	default: 
    if ($_SESSION[hakakses]=='Marketing'){
    ?>
        <div class="row">
            <div class="col-md-12">
                    <div class="block full">
                        
                        <div class="table-responsive">
						<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered' >
                                <thead><tr>
                                    <th class='text-center'style='font-size: 13px;'>Nama Level</th>
                                    <th class='text-center'style='font-size: 13px;'>Komisi</th>
                                    <th class='text-center'style='font-size: 13px;'>Keterangan</th>
                                    <th class='text-center'style='font-size: 13px;'>Action</th>
                                </tr></thead>
								<tbody>

								</tbody>
						</table>
                        
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
						<input type="hidden" name="mod" value="level">
						<input type="hidden" name="act" value="deletelevel">
						<input type="hidden" id="delid" name="namalevel">
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
						<input type="hidden" name="mod" value="level">
						<input type="hidden" name="act" value="menuedit">
						<input type="hidden" id="delidjabatan" name="namalevel">
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
						<input type="hidden" name="mod" value="level">
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
            <h2><strong>Add</strong> Level</h2>
        </div>
        <div class="row">
            <div class="col-sm-14 ">
            <div class="col-sm-7">
		      <form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
                <fieldset>
                    <input type="hidden" name="mod" value="level">
                    <input type="hidden" name="act" value="input">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Nama Level <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="namalevel" name="namalevel"   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Komisi <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="text" id="komisi" name="komisi" maxlength=15 onkeyup="this.value=this.value.replace([.]/[^0-9]/g,'')" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Keterangan<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <textarea class="form-control" type="textarea" id="keterangan" name="keterangan" required></textarea>
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
	$table = new MyTable('tbllevel');
	$currentUser = $table->findBy(NamaLevel, $valid);
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
            <h2><strong>Edit</strong> Level</h2>
        </div>
        <div class="row">
            <div class="col-sm-14 ">
            <div class="col-sm-7">
		      <form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
                <fieldset>
				
                    
                    <input type="hidden" name="mod" value="level">
                    <input type="hidden" name="act" value="update">

                    <div class="form-group">
                        <label class="col-md-4 control-label">NamaLevel <span class="text-danger"></span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="namalevel" name="namalevel"  value="<?=$currentUser->NamaLevel; ?>" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Komisi <span class="text-danger">*</span></label>
                        <div class="col-md-8">
						<input class="form-control" type="text" id="komisi" name="komisi" maxlength=15 onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" value="<?=$currentUser->Komisi; ?>" required>
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