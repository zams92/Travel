<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
?>
<h2>Add Menu Group</h2>
<form method="post" action="mycomponent/mymenumanager/proses2.php?mod=menu_group&act=add">
	<p>
		<label for="menu-group-title">Group Title</label>
		<input type="text" name="title" id="menu-group-title">
	</p>
</form>
<?php } ?>