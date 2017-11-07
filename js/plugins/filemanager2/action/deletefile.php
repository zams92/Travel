<?php
/*
  RoxyFileman - web based file manager. Ready to use with CKEditor, TinyMCE. 
  Can be easily integrated with any other WYSIWYG editor or CMS.

  Copyright (C) 2013, RoxyFileman.com - Lyubomir Arsov. All rights reserved.
  For licensing, see LICENSE.txt or http://RoxyFileman.com/license

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

  Contact: Lyubomir Arsov, liubo (at) web-lobby.com
*/
include '../system.inc.php';
include 'functions.inc.php';

verifyAction('DELETEFILE');
checkAccess('DELETEFILE');

$path = trim($_POST['f']);
verifyPath($path);

if(is_file(fixPath($path))){
  if(unlink(fixPath($path))){
	$filename = explode("/", $path);
	$lstfilename = end($filename);
	$str_po = $_SERVER['PHP_SELF'];
	$str_link_po = preg_replace("/\/myadmin\/js\/plugins\/filemanager2\/action\/(deletefile\.php$)/","",$str_po);
	$str_link_last_po = str_replace("/", "", $str_link_po);
	unlink(fixPath($str_link_last_po.'/mycontent/mythumbs/'.$lstfilename));
	unlink(fixPath($str_link_last_po.'/mycontent/myupload/medium/medium_'.$lstfilename));
	$filedelete = $str_link_last_po.'/mycontent/mythumbs/'.$lstfilename;
    echo getSuccessRes();
  } else {
    echo getErrorRes(t('E_DeletеFile').' '.basename($path));
  }
}
else
  echo getErrorRes(t('E_DeleteFileInvalidPath'));
?>