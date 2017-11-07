<?php
/*
  RoxyFileman - web based file manager. Ready to use with CKEditor, TinyMCE. 
  Can be easily integrated with any other WYSIWYG editor or CMS.

  Copyright (C) 2013, RoxyFileman - Lyubomir Arsov. All rights reserved.
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
error_reporting(0);
ini_set('display_errors', 'off');
// You DON'T have to make any changes to this file. For Roxy Fileman user configuration see conf.json file.
$realpath = str_replace('\\', '/', dirname(__FILE__));
$whatIwanted = substr_replace(str_replace($_SERVER['DOCUMENT_ROOT'], '', $realpath), "", -1);
$strlink_po = preg_replace("/\/myadmin\/js\/plugins\/(filemanager$)/","",$whatIwanted);
define('BASE_PATH', dirname (__FILE__));
define('BASE_UPLOAD_PATH', $strlink_po);
date_default_timezone_set('UTC');
mb_internal_encoding("UTF-8");
mb_regex_encoding(mb_internal_encoding());
?>