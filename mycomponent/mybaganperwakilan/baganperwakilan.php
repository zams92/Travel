<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:404.php');
}else{
include_once 'mylibrary/mydatabase.php';
$aksi="mycomponent/mybaganperwakilan/proses.php";
?>
<style type="text/css">
    .bb td, .bb th {
     border-bottom: 1px solid black !important;
    }
	.table {
    border-bottom:0px !important;
		}
		.table th, .table td {
			border: 0px !important;
			text-align: center;
		}
		.fixed-table-container {
			border:0px !important;
			text-align: center;
		}
  </style>
  
<div class="content-header">
		<div class="header-section"> 
		<table class='table' data-striped="true" >
		<thead>
		<tr>
		<th colspan='4' style="text-align: center;">Data Simbol Warna</th>
		</tr>
		</thead>
		<tr>
		<th>
		<div 
style="
width:20px;
height:15px;
-webkit-border-radius: 26px 26px 26px 26px;
-moz-border-radius:    26px 26px 26px 26px;
border-radius:         26px 26px 26px 26px;
background-color:#C2E3BF;
-webkit-box-shadow: #B3B3B3 2px 2px 2px;
-moz-box-shadow:    #B3B3B3 2px 2px 2px;
box-shadow:         #B3B3B3 2px 2px 2px;
">
</div>
		</th>
		<th>
		<div 
style="
width:20px;
height:15px;
-webkit-border-radius: 26px 26px 26px 26px;
-moz-border-radius:    26px 26px 26px 26px;
border-radius:         26px 26px 26px 26px;
background-color:#1baaed;
-webkit-box-shadow: #B3B3B3 2px 2px 2px;
-moz-box-shadow:    #B3B3B3 2px 2px 2px;
box-shadow:         #B3B3B3 2px 2px 2px;
">
</div></th>
		<th>
		<div 
style="
width:20px;
height:15px;
-webkit-border-radius: 26px 26px 26px 26px;
-moz-border-radius:    26px 26px 26px 26px;
border-radius:         26px 26px 26px 26px;
background-color:#eadb3a;
-webkit-box-shadow: #B3B3B3 2px 2px 2px;
-moz-box-shadow:    #B3B3B3 2px 2px 2px;
box-shadow:         #B3B3B3 2px 2px 2px;
">
</div></th>
		<th>
		<div 
style="
width:20px;
height:15px;
-webkit-border-radius: 26px 26px 26px 26px;
-moz-border-radius:    26px 26px 26px 26px;
border-radius:         26px 26px 26px 26px;
background-color:#dbdbdb;
-webkit-box-shadow: #B3B3B3 2px 2px 2px;
-moz-box-shadow:    #B3B3B3 2px 2px 2px;
box-shadow:         #B3B3B3 2px 2px 2px;
">
</div></th>
		</tr>
		<tr>
		<th style="text-align: left;">Perwakilan</th>
		<th style="text-align: left;">Marketing Level 1</th>
		<th style="text-align: left;">Marketing Level 2-5</th>
		<th style="text-align: left;">Data Tidak Ada</th>
		</tr>
		</table>
		</div>
	</div>
<?php
switch($_GET[act]){
	default: 
    if ($_SESSION[hakakses]=='Perwakilan'){
    ?>
        <div class="row">
            <div class="col-md-12">
                    <div class="block full">
                        <div class="block-title">
                            <h2><?=$languser1;?></h2>
                            <div class="block-options pull-right">
                            </div>
                        </div>
                        <div class="table-responsive">
                        

<table  style='text-align: center;
			border-spacing: 5px;
    border-collapse: separate;'>
<thead><tr >
<th ></th>
<th ></th>
<th style='text-align: center'>
<div 
style="
width:200px;
height:150px;
-webkit-border-radius: 26px 26px 26px 26px;
-moz-border-radius:    26px 26px 26px 26px;
border-radius:         26px 26px 26px 26px;
background-color:#C2E3BF;
-webkit-box-shadow: #B3B3B3 2px 2px 2px;
-moz-box-shadow:    #B3B3B3 2px 2px 2px;
box-shadow:         #B3B3B3 2px 2px 2px;
		margin: 10px 10px 10px 10px;
">

<br> <h1>&nbsp; <?=$_SESSION["namalengkap"]?></h1>

</div>
</th>
<th ></th>
<th ></th>
</tr>
</thead>

<tr>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
</tr>

<tr>
<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = $val->validasi($_GET['page'],'xss');
	$valid -=1;
	$valid *= 5;
    $users = $tableuser->findAllLimitByRow(KodeMarketing,IDPerwakilan, $_SESSION['idrekanan'], ASC,$valid,5);
	$no=1;
    foreach($users as $user){	
		echo"
		<th >
		<div 
		style='
		width:200px;
		height:150px;
		-webkit-border-radius: 26px 26px 26px 26px;
		-moz-border-radius:    26px 26px 26px 26px;
		border-radius:         26px 26px 26px 26px;
		background-color:#1baaed;
		-webkit-box-shadow: #B3B3B3 2px 2px 2px;
		-moz-box-shadow:    #B3B3B3 2px 2px 2px;
		box-shadow:         #B3B3B3 2px 2px 2px;
		margin: 10px 10px 10px 10px;
		text-align: left;
		'>

		<br> &nbsp; Nama : $user->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $user->IDMarketing
		<br> &nbsp; No Telp : $user->NoPonsel

		</div>
		</th>";
		$no++;
	}
	$sisa = 7-$no;
	for ($i = $sisa;$i>1;$i--)
	{
		echo"<th><div 
		style='
		width:200px;
		height:150px;
		-webkit-border-radius: 26px 26px 26px 26px;
		-moz-border-radius:    26px 26px 26px 26px;
		border-radius:         26px 26px 26px 26px;
		background-color:#dbdbdb;
		-webkit-box-shadow: #B3B3B3 2px 2px 2px;
		-moz-box-shadow:    #B3B3B3 2px 2px 2px;
		box-shadow:         #B3B3B3 2px 2px 2px;
		margin: 10px 10px 10px 10px;
		text-align: left;
		'>
		<br> &nbsp; Nama :
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID :
		<br> &nbsp; No Telp :
		
		</div></th>";
	}
	
?>

</tr>

<tr>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
<th style='text-align: center'><img height="30" width="20" src="arrow_down.png"/></th>
</tr>
<tr>

<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = $val->validasi($_GET['page'],'xss');
	$valid = $valid - 1;
	$valid = $valid * 5;
    $users = $tableuser->findAllLimitByRow(KodeMarketing,IDPerwakilan, $_SESSION['idrekanan'], ASC,$valid,5);
	$no=1;
    foreach($users as $user){	
	$tableuser1 = new MyTable('tblmarketing');
    $users1 = $tableuser1->findAllLimitBy(KodeMarketing,IDReferal, $user->IDMarketing, ASC,5);
	$nos=1;
	echo "<th style='border: 1px solid black !important;'>";
	foreach($users1 as $user1){
	
		echo"
		
		<div 
		style='
		width:200px;
		height:150px;
		-webkit-border-radius: 26px 26px 26px 26px;
		-moz-border-radius:    26px 26px 26px 26px;
		border-radius:         26px 26px 26px 26px;
		background-color:#eadb3a;
		-webkit-box-shadow: #B3B3B3 2px 2px 2px;
		-moz-box-shadow:    #B3B3B3 2px 2px 2px;
		box-shadow:         #B3B3B3 2px 2px 2px;
		
		margin: 10px 10px 10px 10px;
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $user1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $user1->IDMarketing
		<br> &nbsp; No Telp : $user1->NoPonsel

		</div><br>";
		$nos++;
	}
	for ($i = $nos;$i<6;$i++)
	{
		echo"<div 
		style='
		width:200px;
		height:150px;
		-webkit-border-radius: 26px 26px 26px 26px;
		-moz-border-radius:    26px 26px 26px 26px;
		border-radius:         26px 26px 26px 26px;
		background-color:#dbdbdb;
		-webkit-box-shadow: #B3B3B3 2px 2px 2px;
		-moz-box-shadow:    #B3B3B3 2px 2px 2px;
		box-shadow:         #B3B3B3 2px 2px 2px;
		margin: 10px 10px 10px 10px;
		text-align: left;
		'>
		<br> &nbsp; Nama :
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID :
		<br> &nbsp; No Telp :
		
		</div><br>";
	}
	echo "</th>";
		$no++;
	}
	$sisa = 7-$no;
	for ($i = $sisa;$i>1;$i--)
	{
		echo "<th style='border: 1px solid black !important;'>";
		for ($x=0;$x<5;$x++){
		echo"<div 
		style='
		width:200px;
		height:150px;
		-webkit-border-radius: 26px 26px 26px 26px;
		-moz-border-radius:    26px 26px 26px 26px;
		border-radius:         26px 26px 26px 26px;
		background-color:#dbdbdb;
		-webkit-box-shadow: #B3B3B3 2px 2px 2px;
		-moz-box-shadow:    #B3B3B3 2px 2px 2px;
		box-shadow:         #B3B3B3 2px 2px 2px;
		margin: 10px 10px 10px 10px;
		text-align: left;
		'>
		<br> &nbsp; Nama :
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID :
		<br> &nbsp; No Telp :
		
		</div><br>";
		}
		echo "</th>";
	}
	
	
?>

		
</tr>							
</table>
<div style='text-align: right;'>
<ul class="pagination">
<?php
$tableuserz = new MyTable('tblmarketing');
$valid = 1;
if($val->validasi($_GET['page'],'xss') !='')
{
$valid = $val->validasi($_GET['page'],'xss');
}
$userz = $tableuserz->numRowBy(IDPerwakilan, $_SESSION['idrekanan']);
$totalrow = (ceil($valid/5) * 5) ;
$row = $totalrow-4;
if($row != 1)
	{
		$xxx = $row-1;
		if ($xxx > ceil($userz / 5))
	{
	echo "<li class='disabled'><a href='#'>$xxx</a></li>";	
	}
	else{
	if($i == $valid)
	{
	echo "<li class='active'><a href='#'>$xxx</a></li>";
	}
	else{
	echo "<li><a href='administrasi.php?mod=baganperwakilan&page=$xxx'>$xxx</a></li>";
	}
	}
	}
for($i=$row;$i<=$totalrow+1;$i++)
{
	
	if ($i > ceil($userz / 5))
	{
	echo "<li class='disabled'><a href='#'>$i</a></li>";	
	}
	else{
	if($i == $valid)
	{
	echo "<li class='active'><a href='#'>$i</a></li>";
	}
	else{
	echo "<li><a href='administrasi.php?mod=baganperwakilan&page=$i'>$i</a></li>";
	}
	}
}
?>
</ul>
</div>
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