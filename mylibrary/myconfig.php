<?php

$site['release']    	= '03 Juni 2015';

$site['title']      	= "MySystem";
$site['url']     	 	= "http://localhost/cyprotgd/";
$site['adm']  		 	= "{$site['url']}myadmin/";
$site['con']     	 	= "{$site['url']}mycontent/";
$site['lib']  		 	= "{$site['url']}mylibrary/";

$dir['root']        	= "C:/xampp/htdocs/cyprotgd/"; 
$dir['adm']         	= "{$dir['root']}myadmin/";
$dir['con']         	= "{$dir['root']}mycontent/";
$dir['lib']         	= "{$dir['root']}mylibrary/";

define('PO_DIRECTORY_PATH_ADM', $dir['adm']);
define('PO_DIRECTORY_PATH_CON', $dir['con']);
define('PO_DIRECTORY_PATH_LIB', $dir['lib']);

$db['host']          	= "localhost";
$db['sock']          	= "";
$db['port']          	= "";
$db['user']          	= "root";
$db['passwd']			= "";
$db['db']				= "dbtravel";

define('DATABASE_HOST', $db['host']);
define('DATABASE_SOCK', $db['sock']);
define('DATABASE_PORT', $db['port']);
define('DATABASE_USER', $db['user']);
define('DATABASE_PASS', $db['passwd']);
define('DATABASE_NAME', $db['db']);

if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
	error_reporting(E_ALL & ~E_NOTICE);
  
if (file_exists( $dir['root'] . 'myinstall' )){
$ret = <<<EOJ
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>SystemCMS Installation</title>
			<link href="{$site['url']}myinstall/css/bootstrap.min.css" rel="stylesheet" />
			<link href="{$site['url']}myinstall/css/docs.css" rel="stylesheet" />
			<link href='{$site['url']}myinstall/favicon.png' rel='icon' />
			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			  <script src="{$site['url']}myinstall/js/html5shiv.js"></script>
			  <script src="{$site['url']}myinstall/js/respond.min.js"></script>
			<![endif]-->
		</head>
		<body class="bs-docs-home">
			<a class="sr-only" href="#content">Skip navigation</a>
			<div id="main">
			<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
				<div class="container">
					<div class="navbar-header">
						<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="./" class="navbar-brand">SystemCMS</a>
					</div>
					<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
						<ul class="nav navbar-nav">
							<li><a>Congratulations</a></li>
						</ul>
					</nav>
				</div>
			</header>
			<main class="bs-masthead" id="content" role="main">
				<div class="container">
					<p>&nbsp</p>
					<h4>Anda telah berhasil menginstall SystemCMS silahkan hapus folder 'myinstall'</h4>
				</div>
			</main>
			<footer class="container" role="contentinfo">
				<ul class="bs-masthead-links">
					<li>&copy; 2015. TMCteam</li>
				</ul>
			</footer>
			<script src="{$site['url']}myinstall/js/jquery.js"></script>
			<script src="{$site['url']}myinstall/js/bootstrap.min.js"></script>
		</body>
	</html>
EOJ;
echo $ret;
exit();
}

?>