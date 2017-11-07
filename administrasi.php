<?php
session_start();
error_reporting(0);
include "timeout.php";


if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:404.php');
}else{
	include_once 'mylibrary/mydatabase.php';
	$tableset = new MyTable('setting');
	$currentSet = $tableset->findBy(id_setting, '1');
	$currentSet = $currentSet->current();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="Copyright" content="NonkTech" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Administrator" />
    <meta name="keywords" content="administrator" />
    <meta name="author" content="Softmed Consultindo" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <title>
        <?php $titcomponame = ucfirst($_GET['mod']); 
        if ($_SESSION[hakakses]=='Admin'){ 
            echo $titcomponame; ?> - Administrator Dashboard<?php 
        } elseif ($_SESSION[hakakses]=='Operator'){ 
            echo $titcomponame; ?> - Operator Dashboard<?php 
        }elseif ($_SESSION[hakakses]=='Perwakilan'){ 
            echo $titcomponame; ?> - Perwakilan Dashboard<?php 
        }elseif ($_SESSION[hakakses]=='Marketing'){ 
            echo $titcomponame; ?> - Marketing Dashboard<?php 
        }else{ 
            echo $titcomponame; ?> - CyproTGD<?php 
        } ?>
    </title>
    <link rel="shortcut icon" href="favicon.png" />

    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="css/plugins.css" />
	<link type="text/css" rel="stylesheet" href="css/main.css" />
	<link type="text/css" rel="stylesheet" href="css/themes.css" />
    <link type="text/css" rel="stylesheet" href="js/plugins/filemanager/fancybox/jquery.fancybox.css" />
    <link type="text/css" rel="stylesheet" href="css/themes/<?=$localAdTheme;?>.css" />

	<?php
		$modedtheme = $_GET['mod'];
		if ($modedtheme == "theme" OR $modedtheme == "setting"){
	?>
	<link type="text/css" rel="stylesheet" href="js/plugins/codemirror/lib/codemirror.css" />
	<link type="text/css" rel="stylesheet" href="js/plugins/codemirror/theme/github.css" />
	<link type="text/css" rel="stylesheet" href="js/plugins/codemirror/addon/display/fullscreen.css" />
	<link type="text/css" rel="stylesheet" href="js/plugins/codemirror/addon/hint/show-hint.css" />
	<link type="text/css" rel="stylesheet" href="js/plugins/codemirror/addon/dialog/dialog.css" />
	<link type="text/css" rel="stylesheet" href="js/plugins/contextmenu/jquery.contextMenu.css" />
	<?php
		}
	?>
	<script type="text/javascript" src="js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/vendor/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
</head>
<body>
    <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
        <div id="sidebar-alt">
                <!-- Wrapper for scrolling functionality -->
                <div class="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Chat -->
                        <!-- Chat demo functionality initialized in js/app.js -> chatUi() -->
                        <a href="#" class="sidebar-title">
                            <i class="gi gi-comments pull-right"></i> <strong>Chat</strong>UI
                        </a>
                        <ul class="chat-users clearfix">
                            <li>
                                <a href="javascript:void(0)" class="chat-user-online">
                                    <span></span>
                                    <img src="favicon.png" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-away">
                                    <span></span>
                                    <img src="favicon.png" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="chat-user-busy">
                                    <span></span>
                                    <img src="favicon.png" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="favicon.png" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="favicon.png" alt="avatar" class="img-circle">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span></span>
                                    <img src="favicon.png" alt="avatar" class="img-circle">
                                </a>
                            </li>
                        </ul>
                        <div class="chat-talk display-none">
                            <!-- Chat Info -->
                            <div class="chat-talk-info sidebar-section">
                                <img src="favicon.png" alt="avatar" class="img-circle pull-left">
                                <strong>Softmed</strong>
                                <button id="chat-talk-close-btn" class="btn btn-xs btn-default pull-right">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- END Chat Info -->

                            <!-- Chat Messages -->
                            <ul class="chat-talk-messages">
                                <li class="text-center"><small>Yesterday, 18:35</small></li>
                                <li class="chat-talk-msg animation-slideRight">Hey admin?</li>
                                <li class="chat-talk-msg animation-slideRight">How are you?</li>
                                <li class="text-center"><small>Today, 7:10</small></li>
                                <li class="chat-talk-msg chat-talk-msg-highlight themed-border animation-slideLeft">I'm fine, thanks!</li>
                            </ul>
                            <!-- END Chat Messages -->

                            <!-- Chat Input -->
                            <form action="index.html" method="post" id="sidebar-chat-form" class="chat-form">
                                <input type="text" id="sidebar-chat-message" name="sidebar-chat-message" class="form-control form-control-borderless" placeholder="Type a message..">
                            </form>
                            <!-- END Chat Input -->
                        </div>
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
		<div id="sidebar">
			<div class="sidebar-scroll">
				<div class="sidebar-content">
                    <a href="#" class="sidebar-brand"><i class="gi gi-flash"></i>
					<?php 
                        if ($_SESSION[hakakses]=='Admin')
                            { ?><strong>Admin</strong>istrator</a><?php 
                        } elseif ($_SESSION[hakakses]=='Operator')
                            { ?><strong>O</strong>perator</a><?php 
                        }else
                            { ?><strong>Softmed</strong></a><?php 
                        } 
                    ?>
                
                    <div class="sidebar-section sidebar-user clearfix">
                            <div class="sidebar-user-avatar">
                                <?php
                                    $filename = "myuser/user-$_SESSION[iduser].jpg";
                                    if (file_exists("$filename")){
                                        echo "<img src='myuser/user-$_SESSION[iduser].jpg' alt='avatar'/>";
                                    }else{
                                        echo "<img src='myuser/user-editor.jpg' alt='avatar'/>";
                                    }
                                ?>
                            </div>
                            <div class="sidebar-user-name" style="font-size:13px;">
                                     <SCRIPT language=JavaScript>var d = new Date();
                                          var h = d.getHours();
                                          if (h < 11) { document.write('<?=$langmenu35;?>'); }
                                          else { if (h < 15) { document.write('<?=$langmenu36;?>'); }
                                          else { if (h < 19) { document.write('<?=$langmenu37;?>'); }
                                          else { if (h <= 23) { document.write('<?=$langmenu38;?>'); }
                                          }}}
                                    </SCRIPT>
                            </div>
                            <div class="sidebar-user-links">
                            <?php if ($_SESSION[hakakses]=='Admin' OR $_SESSION[hakakses]=='Operator'){ ?>                    
                                <a href="administrasi.php?mod=pengguna&act=profile&id=<?=$_SESSION['iduser'];?>" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
							     <a href="logout.php" data-toggle="tooltip" data-placement="bottom" class="enable-tooltip"  title="Logout"><i class="gi gi-exit"></i></a>
                            <?php }elseif ($_SESSION[hakakses]=='Marketing' OR $_SESSION[hakakses]=='Perwakilan'){ ?> 
                                <a href="administrasi.php?mod=pengguna&act=profile&id=<?=$_SESSION['iduser'];?>" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
							    <a href="logout.php" data-toggle="tooltip" data-placement="bottom" class="enable-tooltip"  title="Logout"><i class="gi gi-exit"></i></a> 
                            <?php }else{} ?>
                            </div>
							<div>
							
								<span><?=$_SESSION['namalengkap'];?></span>
							</div>
                    </div>
                    <ul class="sidebar-section sidebar-themes clearfix">
                            <li class="active">
                                <a href="javascript:void(0)" class="themed-background-dark-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default Blue"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-night themed-border-night" data-theme="css/themes/night.css" data-toggle="tooltip" title="Night"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-amethyst themed-border-amethyst" data-theme="css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-modern themed-border-modern" data-theme="css/themes/modern.css" data-toggle="tooltip" title="Modern"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-autumn themed-border-autumn" data-theme="css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-flatie themed-border-flatie" data-theme="css/themes/flatie.css" data-toggle="tooltip" title="Flatie"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-spring themed-border-spring" data-theme="css/themes/spring.css" data-toggle="tooltip" title="Spring"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-fancy themed-border-fancy" data-theme="css/themes/fancy.css" data-toggle="tooltip" title="Fancy"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-fire themed-border-fire" data-theme="css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>
                            </li>
                        </ul>
					<?php include "menu.php"; ?>
				</div>
			</div>
		</div>
		<div id="main-container">
            <header class="navbar navbar-default">
                <ul class="nav navbar-nav-custom">
                    <li class="hidden-md hidden-lg">
                        <a href="javascript:void(0)" onClick="App.sidebar('toggle-sidebar');"><i class="fa fa-bars fa-fw"></i></a>
                    </li>
                    <li class="hidden-md hidden-lg">
                        <a href="admin.php?mod=home"><i class="gi gi-home fa-fw"></i></a>
                    </li>
                    <li class="hidden-sm hidden-xs">
                        <a href="javascript:void(0)" onClick="App.sidebar('toggle-sidebar');">
                            <i class="fa fa-bars fa-fw"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav-custom pull-right">
                        <?php if ($_SESSION[hakakses]=='admin'){ ?>
                        <li>
                            <a href="javascript:void(0)" onClick="App.sidebar('toggle-sidebar-alt', 'toggle-other');">
                                <i class="fa fa-comments"></i>
                                <span class="label label-primary label-indicator animation-floating">7</span>
                            </a>
                        </li>
                        <?php } ?>
                </ul>
			</header>
			<div id="page-content">
				<?php include "content.php"; ?>
			</div>
            
			<footer class="clearfix">
                    <div class="pull-right">
                        Edited with <i class="fa fa-heart text-danger"></i> by <a href="#" target="_blank"><?=$currentSet->website_url;?></a>
                    </div>
                    <div class="pull-left">
                        <span id="year-copy"></span> &copy; <a href="#" target="_blank"><?=$currentSet->website_name;?></a>
                    </div>
            </footer>
		</div>
	</div>
	<div id="alertalldel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
				</div>
				<div class="modal-body"><?=$langdelete2;?></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-danger" id="confirmdel"><i class="fa fa-trash-o"></i> <?=$langdelete3;?></button>
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> <?=$langdelete4;?></button>
				</div>
			</div>
		</div>
	</div>
	<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

	<script type="text/javascript" src="js/plugins.js"></script>
	<script type="text/javascript" src="js/plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="js/plugins/uploader/plupload.full.min.js"></script>
	<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.min.js"></script>
	<script type="text/javascript" src="js/plugins/filemanager/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/menu/ferromenu.js"></script>

	<?php
		$modedtheme = $_GET['mod'];
		if ($modedtheme == "theme" OR $modedtheme == "setting"){
	?>
	<script type="text/javascript" src="js/plugins/codemirror/lib/codemirror.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/fold/xml-fold.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/edit/matchtags.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/edit/closetag.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/edit/closebrackets.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/selection/active-line.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/display/fullscreen.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/hint/show-hint.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/hint/xml-hint.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/hint/html-hint.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/dialog/dialog.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/search/searchcursor.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/addon/search/search.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/mode/clike/clike.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/mode/css/css.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/mode/javascript/javascript.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/mode/php/php.js"></script>
	<script type="text/javascript" src="js/plugins/codemirror/mode/xml/xml.js"></script>
	<script type="text/javascript" src="js/plugins/contextmenu/jquery.contextMenu.js"></script>
	<script type="text/javascript" src="js/plugins/contextmenu/data.contextMenu.js"></script>
	<?php
		}
	?>

    <script type="text/javascript" src="js/vendor/bootstrap-filestyle.js"></script>
    <script type="text/javascript">
		$('#input01').filestyle()
		$('#fileInput').filestyle()
	</script>
	<script type="text/javascript" src="js/app.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="js/helpers/gmaps.min.js"></script>
    <script>$(function(){ Index.init(); });</script>
	<?php
		$modjs = $_GET['mod'];
		
		if (file_exists("mycomponent/my$modjs/javascript.js")){
	?>
			<script type="text/javascript" src="<?php echo "mycomponent/my$modjs/javascript.js"; ?>"></script>
	<?php } ?>
	<?php
		$tableseteditor = new MyTable('setting');
		$currentSetEditor = $tableseteditor->findBy(id_setting, '1');
		$currentSetEditor = $currentSetEditor->current();
	?>
	<script type="text/javascript">
        tinymce.init({
			selector: "#wysiwyg",
            skin: "light",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor",
                "code fullscreen sh4tinymce youtube codemirror"
            ],
            menubar : false,
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table",
            toolbar2: "| fontsizeselect | styleselect | link unlink anchor | image media youtube | forecolor backcolor sh4tinymce code | fullscreen ",
            image_advtab: true,
            codemirror: {
                indentOnInit: true,
                path: "codemirror-4.8",
                config: {
                  lineNumbers: true       
                }
            },
            entity_encoding : "raw",
            fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
            relative_urls: false,
            remove_script_host: false,
            file_browser_callback: RoxyFileBrowser
        });
        function RoxyFileBrowser(field_name, url, type, win) {
            var roxyFileman = '<?=$currentSetEditor->website_url;?>/myadmin/js/plugins/filemanager2/index.html';
            if (roxyFileman.indexOf("?") < 0) {     
                roxyFileman += "?type=" + type;   
            } else {
                roxyFileman += "&type=" + type;
            }
            roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;
            if(tinyMCE.activeEditor.settings.language){
                roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
            }
            tinyMCE.activeEditor.windowManager.open({
                file: roxyFileman,
                title: 'Media Manager',
                width: 900, 
                height: 600,
                resizable: "yes",
                plugins: "media",
                inline: "yes",
                close_previous: "no" 
            },{
                window: win,
                input: field_name
            });
            return false; 
        }
    </script>
	<!--<script type="text/javascript">
		tinymce.init({
			selector: "#wysiwyg",
			skin: "light",
			plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor responsivefilemanager",
                "code fullscreen youtube autoresize" 
			],
			menubar : false,
			toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table",
            toolbar2: "| fontsizeselect | styleselect | link unlink anchor pagebreak | responsivefilemanager image media youtube | forecolor backcolor | fullscreen ",
			image_advtab: true,
            fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
			relative_urls: false,
			remove_script_host: false,
			external_filemanager_path: "<?=$currentSetEditor->website_url;?>/myadmin/js/plugins/filemanager/",
			filemanager_title: "File Manager",
			external_plugins: {
				"filemanager" : "<?=$currentSetEditor->website_url;?>/myadmin/js/plugins/filemanager/plugin.min.js"
			},
            setup: function (theEditor) {
				theEditor.on("init", function() {
					$(window).scroll(function() {
						var sticky = $(theEditor.contentAreaContainer.parentElement).find("div.mce-toolbar-grp");
                        var btnfull = $(theEditor.contentAreaContainer.parentElement).find("#mce_57");
                        btnfull.addClass('mce_btnfull');
						var scroll = $(window).scrollTop();
						if (scroll > 650) {
							sticky.addClass('mce-toolbar-grp-fixed');
                            btnfull.removeClass('mce_btnfull');
                            btnfull.addClass('mce_btnfull_full');
						} else {
							sticky.removeClass('mce-toolbar-grp-fixed');
                            btnfull.removeClass('mce_btnfull_full');
                            btnfull.addClass('mce_btnfull');
						}
					});
				});
			}
		});
	</script>-->
</body>
</html>
<?php
}
?>