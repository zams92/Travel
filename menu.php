<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:404.php');
}else{
	if ($_SESSION[hakakses]=='Operator'){
	$action = $_GET['mod'];
	$activehome = ($action == 'home') ? 'active' : '';
	$activependaptaran = ($action == 'pendaftaran') ? 'active' : '';
	$activeperwakilan = ($action == 'perwakilan') ? 'active' : '';
	$activemarketing = ($action == 'marketing') ? 'active' : '';
	$jamaah = ($action == 'jamaah') ? 'active' : '';
	$pencairan = ($action == 'pencairan') ? 'active' : '';
	

	if ($action == 'pendaftaran'){
		$actionact = $_GET['act'];
		$thisuser = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thisuseraddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'perwakilan'){
		$actionact = $_GET['act'];
		$thisperwakilan = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thisperwakilanaddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'pendaftaran'){
		$actionact = $_GET['act'];
		$thispendaftaran = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thispendaftaranaddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'marketing'){
		$actionact = $_GET['act'];
		$thismarketing = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thismarketingaddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'jamaah'){
		$actionact = $_GET['act'];
		$jamaah = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$jamaah = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'pencairan'){
		$actionact = $_GET['act'];
		$pencairan = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewpencairan = ($actionact == 'addnew') ? 'active' : '';
	}

	echo "<ul class='sidebar-nav'>
		<li class='sidebar-header'>
            <span class='sidebar-header-options clearfix'>
                <a href='javascript:void(0)' data-toggle='tooltip' title='Refresh'><i class='gi gi-refresh'></i></a>
            </span>
			<span class='sidebar-header-title'>Modul Operator</span>
		</li>
		
		<li class='$activependaptaran'>
			<a href='administrasi.php?mod=pendaftaran' class='$activependaptaran'><i class='gi gi-group sidebar-nav-icon'></i>Data Pendaftaran</a>
		</li>
		
		<li class='sidebar-header'>
			<span class='sidebar-header-title'>--------------</span>
		</li>
		
		<li class='$activeperwakilan'>
			<a href='administrasi.php?mod=perwakilan' class='$activeperwakilan'><i class='gi gi-group sidebar-nav-icon'></i>Data Perwakilan</a>
		</li>
		<li class='$activemarketing'>
			<a href='administrasi.php?mod=marketing' class='$activemarketing'><i class='gi gi-group sidebar-nav-icon'></i>Data Marketing</a>
		</li>
		<li class='$jamaah'>
			<a href='administrasi.php?mod=jamaah' class='$jamaah'><i class='gi gi-group sidebar-nav-icon'></i>Data Jamaah</a>
		</li>
		<li class='$pencairan'>
			<a href='#' class='sidebar-nav-menu'><i class='gi gi-group sidebar-nav-icon'></i>Pencairan Komisi</a>
		</li>
		
	</ul>";
	}
    elseif ($_SESSION[hakakses]=='Admin') {
	$action = $_GET['mod'];
	$activehome = ($action == 'home') ? 'active' : '';
	$activeuser = ($action == 'pengguna') ? 'active' : '';
	$activependaptaran = ($action == 'pendaftaran') ? 'active' : '';
	$activeperwakilan = ($action == 'perwakilan') ? 'active' : '';
	$activemarketing = ($action == 'marketing') ? 'active' : '';
	$activelevel = ($action == 'level') ? 'active' : '';
	$jamaah = ($action == 'jamaah') ? 'active' : '';
	$pencairan = ($action == 'pencairan') ? 'active' : '';
	

	if ($action == 'pengguna'){
		$actionact = $_GET['act'];
		$thisuser = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thisuseraddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'pendaftaran'){
		$actionact = $_GET['act'];
		$thisuser = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thisuseraddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'perwakilan'){
		$actionact = $_GET['act'];
		$thisperwakilan = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thisperwakilanaddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'marketing'){
		$actionact = $_GET['act'];
		$thismarketing = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thismarketingaddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'jamaah'){
		$actionact = $_GET['act'];
		$jamaah = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$jamaah = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'pencairan'){
		$actionact = $_GET['act'];
		$pencairan = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewpencairan = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'level'){
		$actionact = $_GET['act'];
		$thislevel = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewlevel = ($actionact == 'addnew') ? 'active' : '';
	}

	echo "<ul class='sidebar-nav'>
		<li class='sidebar-header'>
            <span class='sidebar-header-options clearfix'>
                <a href='javascript:void(0)' data-toggle='tooltip' title='Refresh'><i class='gi gi-refresh'></i></a>
            </span>
			<span class='sidebar-header-title'>Modul Administrator</span>
		</li>
		<li class='$activeuser'>
			<a href='administrasi.php?mod=pengguna' class='$activeuser'><i class='gi gi-group sidebar-nav-icon'></i>Data Pengguna</a>
		</li>
		<li class='$activependaptaran'>
			<a href='administrasi.php?mod=pendaftaran' class='$activependaptaran'><i class='gi gi-group sidebar-nav-icon'></i>Data Pendaftaran</a>
		</li>
		<li class='sidebar-header'><span class='sidebar-header-options clearfix'>
                <a href='javascript:void(0)' data-toggle='tooltip' title='Refresh'><i class='gi gi-refresh'></i></a>
            </span>
			<span class='sidebar-header-title'></span>
		</li>
		<li class='$activeperwakilan'>
			<a href='administrasi.php?mod=perwakilan' class='$activeperwakilan'><i class='gi gi-group sidebar-nav-icon'></i>Data Perwakilan</a>
		</li>
		<li class='$activemarketing'>
			<a href='administrasi.php?mod=marketing' class='$activemarketing'><i class='gi gi-group sidebar-nav-icon'></i>Data Marketing</a>
		</li>
		<li class='$jamaah'>
			<a href='administrasi.php?mod=jamaah' class='$jamaah'><i class='gi gi-group sidebar-nav-icon'></i>Data Jamaah</a>
		</li>
		<li class='$pencairan'>
			<a href='#' class='sidebar-nav-menu'><i class='gi gi-group sidebar-nav-icon'></i>Pencairan Komisi</a>
		</li>
		<li class='$activelevel'>
			<a href='administrasi.php?mod=level' class='$activelevel'><i class='gi gi-group sidebar-nav-icon'></i>Data Level</a>
		</li>
		
	</ul>";
	}

elseif ($_SESSION[hakakses]=='Perwakilan') {
	$action = $_GET['mod'];
	$activehome = ($action == 'home') ? 'active' : '';
	$activemarketing = ($action == 'marketing') ? 'active' : '';
	$jamaah = ($action == 'jamaah') ? 'active' : '';
	$baganperwakilan = ($action == 'baganperwakilan') ? 'active' : '';
	$komisi = ($action == 'komisi') ? 'active' : '';

	if ($action == 'marketing'){
		$actionact = $_GET['act'];
		$thismarketing = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thismarketingaddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'jamaah'){
		$actionact = $_GET['act'];
		$jamaah = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$jamaah = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'baganperwakilan'){
		$actionact = $_GET['act'];
		$baganperwakilan = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewbaganperwakilan = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'komisi'){
		$actionact = $_GET['act'];
		$komisi = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewkomisi = ($actionact == 'addnew') ? 'active' : '';
	}

	echo "<ul class='sidebar-nav'>
		<li class='sidebar-header'>
            <span class='sidebar-header-options clearfix'>
                <a href='javascript:void(0)' data-toggle='tooltip' title='Refresh'><i class='gi gi-refresh'></i></a>
            </span>
			<span class='sidebar-header-title'>Modul Perwakilan</span>
		</li>
		
		<li class='$baganperwakilan'>
			<a href='administrasi.php?mod=baganperwakilan&page=1' class='$baganperwakilan'><i class='gi gi-group sidebar-nav-icon'></i>Bagan Perwakilan 5 Level</a>
		</li>
		<li class='$activemarketing'>
			<a href='administrasi.php?mod=marketing' class='$activemarketing'><i class='gi gi-group sidebar-nav-icon'></i>Data Marketing</a>
		</li>
		<li class='$jamaah'>
			<a href='administrasi.php?mod=jamaah' class='$jamaah'><i class='gi gi-group sidebar-nav-icon'></i>Data Jamaah</a>
		</li>
		<li class='$komisi'>
			<a href='#' class='sidebar-nav-menu'><i class='gi gi-group sidebar-nav-icon'></i>Lihat Komisi</a>
		</li>
		
	</ul>";
	}
elseif ($_SESSION[hakakses]=='Marketing') {
	$action = $_GET['mod'];
	$activehome = ($action == 'baganperwakilanlevel1') ? 'active' : '';
	$activemarketing = ($action == 'marketing') ? 'active' : '';
	$jamaah = ($action == 'jamaah') ? 'active' : '';
	$level = ($action == 'baganperwakilanlevel1') ? 'active' : '';
	$komisi = ($action == 'komisi') ? 'active' : '';

	if ($action == 'marketing'){
		$actionact = $_GET['act'];
		$thismarketing = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$thismarketingaddnew = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'jamaah'){
		$actionact = $_GET['act'];
		$jamaah = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$jamaah = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'pencairan'){
		$actionact = $_GET['act'];
		$pencairan = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewpencairan = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'level'){
		$actionact = $_GET['act'];
		$level = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewlevel = ($actionact == 'addnew') ? 'active' : '';
	}elseif ($action == 'komisi'){
		$actionact = $_GET['act'];
		$komisi = ($actionact == '' OR $actionact == 'edit') ? 'active' : '';
		$addnewkomisi = ($actionact == 'addnew') ? 'active' : '';
	}

	echo "<ul class='sidebar-nav'>
		<li class='sidebar-header'>
            <span class='sidebar-header-options clearfix'>
                <a href='javascript:void(0)' data-toggle='tooltip' title='Refresh'><i class='gi gi-refresh'></i></a>
            </span>
			<span class='sidebar-header-title'>Modul Marketing</span>
		</li>
		
		<li class='$level'>
			<a href='administrasi.php?mod=baganmarketing' class='$level'><i class='gi gi-group sidebar-nav-icon'></i>Bagan Marketing 1 Level</a>
		</li>
		<li class='$activemarketing'>
			<a href='administrasi.php?mod=marketing' class='$activemarketing'><i class='gi gi-group sidebar-nav-icon'></i>Data Marketing</a>
		</li>
		<li class='$jamaah'>
			<a href='administrasi.php?mod=jamaah' class='$jamaah'><i class='gi gi-group sidebar-nav-icon'></i>Data Jamaah</a>
		</li>
		<li class='$komisi'>
			<a href='#' class='sidebar-nav-menu'><i class='gi gi-group sidebar-nav-icon'></i>Lihat Komisi</a>
		</li>
		
	</ul>";
	}
}
?>