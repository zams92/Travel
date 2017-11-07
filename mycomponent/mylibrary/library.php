<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
$aksi="mycomponent/mylibrary/proses.php";
?>
	<div class="content-header">
		<div class="header-section">
            <h1><?=$langlibrary1;?></h1>
            <small>Awesome custom!</small>
        </div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li><a href="admin.php?mod=home"><?=$langmenu1;?></a></li>
		<li><?=$langlibrary2;?></li>
	</ul>
<?php
switch($_GET[act]){
	default:
?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <i class="fa fa-check"></i> <strong>Pastikan</strong> Salinan Posting Editor bertipe *.DOC / *.PDF / *.TXT.
        </div>
        <div class="widget uploader-wrapper">
            <div id="uploader"><p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="block full">
            <div class="block-title">
                <div class="block-options pull-left">
                    <a href="admin.php?mod=library" data-toggle="modal" class="enable-tooltip btn btn-sm btn-primary" data-placement="bottom" title="Refresh"><i class="gi gi-refresh gi-3x"></i></a>
                </div>
                <h2><?=$langlibrary1;?></h2>
            </div>
            <div class="table-responsive">
                <form method="post" action="<?=$aksi;?>">
                    <input type="hidden" name="mod" value="library">
                    <input type="hidden" name="act" value="multidelete">
                    <input type="hidden" value="0" name="totaldata" id="totaldata">
                    <table cellpadding="0" cellspacing="0" border="0" class="dTableAjax table table-vcenter table-condensed table-hover" id="dynamic">
                        <thead><tr>
                            <th style="width:10px;" class="text-center"><i class="fa fa-check-circle-o"></i></th>
                            <th class="text-center">User</th>
                            <th class="text-center"><?=$langlibrary3;?></th>
                            <th class="text-center"><?=$langlibrary4;?></th>
                            <th class="text-center"><?=$langlibrary5;?></th>
                            <th class="text-center"><?=$langlibrary6;?></th>
                            <th class="text-center"><?=$langlibrary7;?></th>
                        </tr></thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td style="width:10px;" class="text-center"><input type="checkbox" id="titleCheck" data-toggle="tooltip" title="<?=$langaction5;?>" /></td>
                                <td colspan="6">
                                    <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#alertalldel"><i class="fa fa-trash-o"></i> Delete Selected Item</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
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
						<input type="hidden" name="mod" value="library">
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
	<p style="width:100%;">&nbsp;</p>
<?php
    break;
}
}
?>