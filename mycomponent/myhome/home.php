<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])) {
	header('location:404.php');
} else {
	if ($_SESSION[hakakses] == 'Operator') {
?>
	<div class="content-header">
		<div class="header-section">
			<h1><i class="gi gi-charts"></i> Welcome <b><?php echo "$_SESSION[namalengkap]";?></b><br>
                <small>You Look Awesome!</small> 
            </h1>
		</div>
	</div>
    <div id="modal-restore" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-upload"></i> Pilih DB</h2>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation" action="mycomponent/myhome/proses.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="hidden" name="mod" value="home">
                                <input type="hidden" name="act" value="restore">
                                <input type="file" id="example-file-input" name="fupload" required>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-upload"></i> Restore DB</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
<?php } 
	elseif ($_SESSION[hakakses] == 'Admin') {
		$table1  = new MyTable('post');
		$total1  = $table1->numRow();
		$table4  = new MyTable('media');
		$total4  = $table4->numRow();
		$table6  = new MyTable('component');
		$total6  = $table6->numRow();
		$table7  = new MyTable('tblusers');
		$total7  = $table7->numRow();
		$table8  = new MyTable('comment');
		$total8  = $table8->numRowBy(status, 'N');
		$table9  = new MyTable('contact');
		$total9  = $table9->numRowBy(status, 'N');
		$table11  = new MyTable('produk');
		$total11  = $table11->numRow();
		$total10 = mysql_query("SELECT * FROM post,users WHERE tblusers.IDUser = post.editor AND users.level = '3' AND post.active = 'N'");
		$total10 = mysql_num_rows($total10);
		include "mycomponent/myhome/traffic.php";
		$visitorc = $currentStat3 + $currentStat4 + $currentStat5 + $currentStat6;
		$hitsc    = $sql_hits3 + $sql_hits4 + $sql_hits5 + $sql_hits6;
?>
	<div class="content-header content-header-media">
		<div class="header-section">
			<div class="row">
				<div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
					<h1>Welcome <b><?php echo "$_SESSION[namalengkap]";?></b><br>
					<small>You Look Awesome!</small></h1>
				</div>
				<div class="col-md-8 col-lg-6"></div>
			</div>
		</div>
		<img src="images/dashboard_header.jpg" alt="Header Image" class="animation-pulseSlow" />
	</div>
	<div class="content-header">
		<div class="header-section">
			<h1><i class="gi gi-charts"></i> Welcome <b><?php echo "$_SESSION[namalengkap]";?></b><br>
                <small>You Look Awesome!</small> 
            </h1>
		</div>
	</div>

	<p style="width:100%; height:200px;">&nbsp;</p>
    <div id="modal-restore" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-upload"></i> Pilih DB</h2>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation" action="mycomponent/myhome/proses.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="hidden" name="mod" value="home">
                                <input type="hidden" name="act" value="restore">
                                <input type="file" id="example-file-input" name="fupload" required>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-upload"></i> Restore DB</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
<?php }  
    elseif($_SESSION[hakakses] == 'Perwakilan') { ?>
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
		<table class='table ' data-striped="true">
		<thead>
		<tr>
		<th colspan='4'>Data Simbol Warna</th>
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
	<div class="row">
            <div class="col-md-12">
                    <div class="block full">
                        <div class="block-title">
                            <h2><?=$languser1;?></h2>
                            <div class="block-options pull-right">
                            </div>
                        </div>
                        <div class="table-responsive">
                        

<table cellpadding='15' cellspacing='0' border='0' class='table ' data-striped="true">
<thead><tr class="bb">
<th ></th>
<th ></th>
<th >
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
">
<br>
<br> &nbsp; <?=$_SESSION["namalengkap"]?>

</div>
</th>
<th ></th>
<th ></th>
</tr>
</thead>

<tr>
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
</tr>

<tr>
<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = 1 ;
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
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
<th><img height="30" width="20" src="arrow_down.png"/></th>
</tr>
<tr>
<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = 1 ;
	$valid = $valid - 1;
	$valid = $valid * 5;
    $users = $tableuser->findAllLimitByRow(KodeMarketing,IDPerwakilan, $_SESSION['idrekanan'], ASC,$valid,5);
	$no=1;
    foreach($users as $user){	
	$tableuser1 = new MyTable('tblmarketing');
    $users1 = $tableuser1->findAllLimitByRow(KodeMarketing,IDReferal, $user->IDMarketing, ASC,0,1);
	$users1 = $users1->current();
	if ($users1 > 0){
		echo"
		<th >
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
	else{
		echo"
		<th >
		<div 
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
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
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
</tr>
<tr>
<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = 1 ;
	$valid -= 1;
	$valid *= 5;
    $users = $tableuser->findAllLimitByRow(KodeMarketing,IDPerwakilan, $_SESSION['idrekanan'], ASC,$valid,5);
	$no=1;
    foreach($users as $user){	
	$tableuser1 = new MyTable('tblmarketing');
    $users1 = $tableuser1->findAllLimitByRow(KodeMarketing,IDReferal, $user->IDMarketing, ASC,1,1);
	$users1 = $users1->current();
	if ($users1 > 0){
		echo"
		<th >
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
	else{
		echo"
		<th >
		<div 
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
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
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
</tr>
<tr>
<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = 1 ;
	$valid -= 1;
	$valid *= 5;
    $users = $tableuser->findAllLimitByRow(KodeMarketing,IDPerwakilan, $_SESSION['idrekanan'], ASC,$valid,5);
	$no=1;
    foreach($users as $user){	
	$tableuser1 = new MyTable('tblmarketing');
    $users1 = $tableuser1->findAllLimitByRow(KodeMarketing,IDReferal, $user->IDMarketing, ASC,2,1);
	$users1 = $users1->current();
	if ($users1 > 0){
		echo"
		<th >
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
	else{
		echo"
		<th >
		<div 
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
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
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
</tr>
<tr>
<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = 1 ;
	$valid -= 1;
	$valid *= 5;
    $users = $tableuser->findAllLimitByRow(KodeMarketing,IDPerwakilan, $_SESSION['idrekanan'], ASC,$valid,5);
	$no=1;
    foreach($users as $user){	
	$tableuser1 = new MyTable('tblmarketing');
    $users1 = $tableuser1->findAllLimitByRow(KodeMarketing,IDReferal, $user->IDMarketing, ASC,3,1);
	$users1 = $users1->current();
	if ($users1 > 0){
		echo"
		<th >
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
	else{
		echo"
		<th >
		<div 
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
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
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
<th><img height="30" width="20" src="rantai.png"/></th>
</tr>
<tr>
<?php
    $tableuser = new MyTable('tblmarketing');
	$valid = 1 ;
	$valid -= 1;
	$valid *= 5;
    $users = $tableuser->findAllLimitByRow(KodeMarketing,IDPerwakilan, $_SESSION['idrekanan'], ASC,$valid,5);
	$no=1;
    foreach($users as $user){	
	$tableuser1 = new MyTable('tblmarketing');
    $users1 = $tableuser1->findAllLimitByRow(KodeMarketing,IDReferal, $user->IDMarketing, ASC,4,1);
	$users1 = $users1->current();
	if ($users1 > 0){
		echo"
		<th >
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
	else{
		echo"
		<th >
		<div 
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
		text-align: left;
		'>
		
		<br> &nbsp; Nama : $users1->Nama
		<br> &nbsp;	 ------------------------------------------
		<br> &nbsp; ID : $users1->IDMarketing
		<br> &nbsp; No Telp : $users1->NoPonsel

		</div>
		</th>";
	}
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
<th></th>
<th></th>
<th></th>
<th></th>
<th><ul class="pagination">
<?php
$tableuserz = new MyTable('tblmarketing');
$valid = 1;
if($val->validasi($_GET['page'],'xss') !='')
{
$valid = 1 ;
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
</ul></th>
</tr>							
</table>
                        </div>
                    </div>
            </div>
        </div>
<?php
	}
}
?>