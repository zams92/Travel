<?php
  include_once 'mylibrary/mydatabase.php';
  $tableset = new MyTable('setting');
  $currentSet = $tableset->findBy(id_setting, '1');
  $currentSet = $currentSet->current();
  $website_url = $currentSet->website_url;
  session_start();
  session_destroy();
  header('location:index.php');
?>
