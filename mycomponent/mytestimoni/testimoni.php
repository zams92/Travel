<?php
//Author  	= 'CompoGen';
//Contact 	= 'mailto:info@nonktech.org';
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
$aksi="mycomponent/mytestimoni/proses.php";
?>
	<div class="content-header">
		<div class="header-section"><h1>Testimoni Management</h1></div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li><a href="admin.php?mod=home"><?=$langmenu1;?></a></li>
		<li>Add, update, delete Testimoni management</li>
	</ul>
<?php
switch($_GET[act]){
	default:
?>
	<div class="block full">
		<div class="block-title">
            <h2>Testimoni Management</h2>
            <div class="block-options pull-right">
				<a href="admin.php?mod=testimoni&act=addnew" class="btn btn-sm btn-primary" title="Add New"><i class="fa fa-plus-square-o"></i> Add New</a>
			</div>
        </div>
		<div class="table-responsive">
			<form method="post" action="<?=$aksi;?>">
				<input type="hidden" name="mod" value="testimoni">
				<input type="hidden" name="act" value="multidelete">
				<input type="hidden" value="0" name="totaldata" id="totaldata">
				<table cellpadding="0" cellspacing="0" border="0" class="dTableAjax table table-vcenter table-condensed table-bordered" id="dynamic">
					<thead><tr>
						<th style="width:80px;" class="text-center"><i class="fa fa-check-circle-o"></i></th>
                        <th>Id Data</th>
						<th>Nama</th>
						<th>Gambar</th>
						<th>Date</th>
                        <th>Action</th>
					</tr></thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<td style="width:80px;" class="text-center"><input type="checkbox" id="titleCheck" data-toggle="tooltip" title="<?=$langaction5;?>" /></td>
							<td colspan="6">
								<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#alertalldel"><i class="fa fa-trash-o"></i> Delete Selected Item</button>
							</td>
						</tr>
					</tfoot>
				</table>
			</form>
		</div>
	</div>
	<div id="alertdel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="testimoni">
						<input type="hidden" name="act" value="delete">
						<input type="hidden" id="delid" name="id">
						<?=$langdelete2;?>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> <?=$langdelete3;?></button>
						<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> <?=$langdelete4;?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<p style="width:100%; height:350px;">&nbsp;</p>
<?php
    break;

	case "addnew":
?>
	<div class="block full">
		<div class="block-title"><h2>Add New</h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" autocomplete="off">
            <fieldset>
				<input type="hidden" name="mod" value="testimoni" />
				<input type="hidden" name="act" value="input" />
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="nama" name="nama" required />
                        </div>
                    <div class="form-group">
                        <label>Testimoni <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="8" cols="" id="testimoni" name="testimoni"></textarea>
                        <span class="help-block">Field limited to 600 characters.</span>
                    </div>
                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                            <label>Gambar <span class="text-danger">*</span></label>
                            <div class="col-md-12 input-group">
                                <input class="form-control" type="text" id="picture" name="picture">
                                <span class="input-group-btn">
                                    <a href="js/plugins/filemanager/dialog.php?type=1&field_id=picture" class="btn btn-success" id="browse-file">Browse</a>
                                </span>
                            </div>                                
                            </div>
                            <div class="col-md-6">
                                <label>Date <span class="text-danger">*</span></label>
                                <input type="text" id="date" name="date" class="form-control input-datepicker-close masked_date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required />
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
	<p style="width:100%; height:500px;">&nbsp;</p>
<?php
	break;

	case "edit":
	$valid = $val->validasi($_GET['id'],'sql');
	$table = new MyTable('testimoni');
	$currentTestimoni = $table->findBy(id_testimoni, $valid);
	$currentTestimoni = $currentTestimoni->current();
	$dutf=html_entity_decode($currentUser->testimoni);
	if ($currentTestimoni == '0'){
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
	<p style="width:100%; height:500px;">&nbsp;</p>
<?php
	}else{
?>
	<div class="block full">
		<div class="block-title"><h2>Edit Testimoni</h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" autocomplete="off">
            <fieldset>
				<input type="hidden" name="mod" value="testimoni" />
				<input type="hidden" name="act" value="update" />
                <input type="hidden" name="id" value="<?=$currentTestimoni->id_testimoni;?>">
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="nama" name="nama" value="<?=$currentTestimoni->nama;?>" required />
                        </div>
                    <div class="form-group">
                        <?php $dutf = html_entity_decode($currentTestimoni->testimoni); ?>
                        <label>Testimoni <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="8" cols="" id="testimoni" name="testimoni"><?=$dutf;?></textarea>
                        <span class="help-block">Field limited to 600 characters.</span>
                    </div>
                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                            <label>Gambar <span class="text-danger">*</span></label>
                            <a data-toggle="lightbox-image" href="../mycontent/myupload/<?=$currentTestimoni->picture;?>">Existing Image Preview</a>
                            <div class="col-md-12 input-group">
                                <input class="form-control" type="text" id="picture" name="picture">
                                <span class="input-group-btn">
                                    <a href="js/plugins/filemanager/dialog.php?type=1&field_id=picture" class="btn btn-success" id="browse-file">Browse</a>
                                </span>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <label>Date <span class="text-danger">*</span></label>
                            <input type="text" id="date" name="date" class="form-control input-datepicker-close masked_date" data-date-format="yyyy-mm-dd" value="<?=$currentTestimoni->date;?>" placeholder="yyyy-mm-dd" required />
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
	<p style="width:100%; height:450px;">&nbsp;</p>
<?php
	}
    break;
}
}
?>