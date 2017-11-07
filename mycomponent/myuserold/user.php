<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
$aksi="mycomponent/myuser/proses.php";
?>
	<div class="content-header">
		<div class="header-section"><h1><?=$languser1;?></h1></div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li><a href="admin.php?mod=home"><?=$langmenu1;?></a></li>
		<li><?=$languser2;?></li>
	</ul>
<?php
switch($_GET[act]){
	default:
	if ($_SESSION[leveluser]=='1'){	?>
    <div class="row">
       <div class="col-md-8">
            <div class="block full">
                <div class="block-title">
                    <h2><?=$languser1;?></h2>
                    <div class="block-options pull-right">
                        <a href="admin.php?mod=user&act=addnew" data-toggle="modal" class="enable-tooltip btn btn-alt btn-sm btn-warning" data-placement="bottom" title="New User"><i class='gi gi-group'></i> Add New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="dTableAjax table table-vcenter table-condensed table-bordered" id="dynamic">
                        <thead><tr>
                            <th class="text-center"><i class="gi gi-user"></i></th>
                            <th class="text-center">Email</th>
                            <th class="text-center"><?=$languser5;?></th>
                            <th class="text-center"><?=$languser6;?></th>
                            <th class="text-center"><?=$languser7;?></th>
                        </tr></thead>
                        <tbody></tbody>
                    </table>
		        </div>
	        </div>
                            
            <div class="block full">
                <div class="block-title">
                    <h2>User Role</h2>
                    <div class="block-options pull-right">
                        <a href="#newrole" data-placement="bottom" class="enable-tooltip btn btn-alt btn-sm btn-primary" title="Add New" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="table-responsive">
                <?php
                    $tableuserrole = new MyTable('user_role');
                    $userroles = $tableuserrole->findAll('', '');
			echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered' id='table-datatable'>
                        <thead><tr>
                            <th>Level</th>
                            <th>Module</th>
                            <th>Read</th>
                            <th>Write</th>
                            <th>Modify</th>
                            <th>Delete</th>
                            <th>$languser7</th>
                        </tr></thead><tbody>"; 
                        $no=1;
                        foreach($userroles as $userrole){
                            $tablelevel = new MyTable('user_level');
                            $currentLevel = $tablelevel->findBy(id_level, $userrole->id_level);
                            $currentLevel = $currentLevel->current();
                            if($userrole->read_access == 'Y'){
                                $read = "<span class='label label-success'>$userrole->read_access</span>";
                            }else{ 
                                $read = "<span class='label label-warning'>$userrole->read_access</span>";
                            }
                            if($userrole->write_access == 'Y'){
                                $write = "<span class='label label-success'>$userrole->write_access</span>";
                            }else{ 
                                $write = "<span class='label label-warning'>$userrole->write_access</span>";
                            }
                            if($userrole->modify_access == 'Y'){
                                $modif = "<span class='label label-success'>$userrole->modify_access</span>";
                            }else{ 
                                $modif = "<span class='label label-warning'>$userrole->modify_access</span>";
                            }
                            if($userrole->delete_access == 'Y'){
                                $delete = "<span class='label label-success'>$userrole->delete_access</span>";
                            }else{ 
                                $delete = "<span class='label label-warning'>$userrole->delete_access</span>";
                            }
                            echo "<tr>
                                <td>$currentLevel->level</td>
                                <td>$userrole->module</td>
                                <td class='text-center'>$read</td>
                                <td class='text-center'>$write</td>
                                <td class='text-center'>$modif</td>
                                <td class='text-center'>$delete</td>
                                <td class='text-center'>
                                    <div class='btn-group btn-group-xs'>
                                        <a href='#editrole$userrole->id_role' id='$userrole->id_role' data-placement='left' class='enable-tooltip btn btn-xs btn-default' data-toggle='modal' title='$langaction1'><i class='fa fa-pencil'></i></a>
                                        <a data-placement='right' class='enable-tooltip btn btn-xs btn-danger alertdelrole' id='$userrole->id_role' data-toggle='tooltip' title='Delete'><i class='fa fa-times'></i></a>
                                    </div>
                                </td>
                            </tr>";
                            ?>
                            <div id="editrole<?=$userrole->id_role;?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="form-validation" method="post" action="<?=$aksi;?>" autocomplete="off">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title">Edit User Role</h3>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="mod" value="user">
                                                <input type="hidden" name="act" value="edituserrole">
                                                <input type="hidden" name="id" value="<?=$userrole->id_role;?>">
                                                <div class="form-group">
                                                    <label>Level</label>
                                                    <select class="form-control" name="level" style="width:280px;" data-placeholder="Choose Level">
                                                        <?php
                                                            $tableselevel = new MyTable('user_level');
                                                            $sellevels = $tableselevel->findBy(id_level, $userrole->id_level);
                                                            $sellevels = $sellevels->current();
                                                            echo "<option value='$sellevels->id_level'>$sellevels->level</option>";
                                                            $tablelevels = new MyTable('user_level');
                                                            $levels = $tablelevels->findNotAll(id_level, $userrole->id_level);
                                                            foreach($levels as $level){
                                                                echo "<option value='$level->id_level'>$level->level</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Module <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" id="title" name="title" value="<?=$userrole->module;?>" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="form-group">
                                                            <label>Read <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="read_access" style="width:280px;">
                                                                <?php
                                                                    $read_access_a = ($userrole->read_access != 'Y') ? $read_access = 'selected=selected' : $read_access = '';
                                                                ?>
                                                                <option value="Y" <?=$read_access;?>>Y</option>
                                                                <option value="N" <?=$read_access;?>>N</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Write <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="write_access" style="width:280px;">
                                                                <?php
                                                                    $write_access_a = ($userrole->write_access != 'Y') ? $write_access = 'selected=selected' : $write_access = '';
                                                                ?>
                                                                <option value="Y" <?=$write_access;?>>Y</option>
                                                                <option value="N" <?=$write_access;?>>N</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="form-group">
                                                            <label>Modify <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="modify_access" style="width:280px;">
                                                                <?php
                                                                    $modify_access_a = ($userrole->modify_access != 'Y') ? $modify_access = 'selected=selected' : $modify_access = '';
                                                                ?>
                                                                <option value="Y" <?=$modify_access;?>>Y</option>
                                                                <option value="N" <?=$modify_access;?>>N</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Delete <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="delete_access" style="width:280px;">
                                                                <?php
                                                                    $delete_access_a = ($userrole->delete_access != 'Y') ? $delete_access = 'selected=selected' : $delete_access = '';
                                                                ?>
                                                                <option value="Y" <?=$delete_access;?>>Y</option>
                                                                <option value="N" <?=$delete_access;?>>N</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $no++;
                        }
                    echo "</tbody></table>";
                ?>
                </div>
            </div>
           
       </div>
       <div class="col-md-4">
            <div class="widget">
                <?php
                    $tableuser = new MyTable('users');
                    $currentUser = $tableuser->findBy(id_user, '1');
                    $currentUser = $currentUser->current();
                    $tablelevel = new MyTable('user_level');
                    $currentLevel = $tablelevel->findBy(id_level, $currentUser->level);
                    $currentLevel = $currentLevel->current();
                ?>
                    <div class="widget-advanced widget-advanced-alt">
                        <div class="widget-header text-left">
                        <img src="images/placeholders/headers/widget4_header.jpg" alt="background" class="widget-background animation-pulseSlow">
                            <h3 class="widget-content widget-content-image widget-content-light clearfix">
                                <a href="admin.php?mod=user&act=edit&id=<?=$currentUser->id_session;?>" class="pull-right animation-hatch">
                                    <?php
										$filename = "../mycontent/myuser/user-$_SESSION[iduser].jpg";
										if (file_exists("$filename")){
											echo "<img src='../mycontent/myuser/user-$_SESSION[iduser].jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' style='border:2px solid #fff;'/>";
										}else{
											echo "<img src='../mycontent/myuser/user-editor.jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' style='border:2px solid #fff;' />";
										}
									?>
                                </a>
                                <span class="themed-color-autumn"><?=$currentUser->nama_lengkap;?></span><br>
                                <small><?=$currentUser->username;?></small>
                            </h3>
                        </div>
                        <div class="widget-main">
                            <div class="row text-center animation-fadeIn">
                                <div class="col-xs-6">
                                    <?php
								        $tableposts = new MyTable("post");
								        $numposts = $tableposts->numRowBy(editor, $currentUser->id_user);
								    ?>
                                    <h3><a href="javascript:void(0)" class="themed-color-autumn"><strong><?=$numposts;?></strong></a><br><small>Post</small></h3>
                                </div>
                                <div class="col-xs-6">
                                    <h3><a href="javascript:void(0)" class="themed-color-autumn"><strong><?=$currentUser->id_user;?></strong></a><br><small>User Id</small></h3>
                                </div>
                            </div>
                        </div>
                    </div>
           </div>  
           
            <div class="block full">
                <div class="block-title">
                    <h2>User Divisi</h2>
                    <div class="block-options pull-right">
                        <a href="#tblnew" data-placement="bottom" class="enable-tooltip btn btn-sm btn-alt btn-primary" title="Add New" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="table-responsive">
                <?php
                    $tableuserjabatan = new MyTable('user_jabatan');
                    $userjabatans = $tableuserjabatan->findAll('', '');
			     echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered'>
                        <thead><tr>
                            <th class='text-center'>Divisi</th>
                            <th class='text-center'>$languser7</th>
                        </tr></thead><tbody>"; 
                        $no=1;
                        foreach($userjabatans as $userjabatan){
                            echo "<tr>
                                <td>$userjabatan->jabatan</td>
                                <td class='text-center'>
                                    <div class='btn-group btn-group-xs'>
                                        <a href='#tbledit$userjabatan->id_jabatan' id='$userjabatan->id_jabatan' data-placement='left' class='enable-tooltip btn btn-xs btn-default' data-toggle='modal' title='$langaction1'><i class='fa fa-pencil'></i></a>
                                        <a data-placement='right' class='enable-tooltip btn btn-xs btn-danger alertdeljabatan' id='$userjabatan->id_jabatan' data-toggle='tooltip' title='Delete'><i class='fa fa-times'></i></a>";
                                    echo "</div>
                                </td>
                            </r>";
                            ?>
                            <div id="tbledit<?=$userjabatan->id_jabatan;?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="form-validation" method="post" action="<?=$aksi;?>" autocomplete="off">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title">Edit User jabatan</h3>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="mod" value="user">
                                                <input type="hidden" name="act" value="edituserjabatan">
                                                <input type="hidden" name="id" value="<?=$userjabatan->id_jabatan;?>">
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input class="form-control" type="text" id="title" name="title" value="<?=$userjabatan->jabatan;?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $no++;
                        }
                    echo "</tbody></table>";
                ?>
                </div>
            </div> 
           
            <div class="block full">
                <div class="block-title">
                    <h2>User Level</h2>
                    <div class="block-options pull-right">
                        <a href="#newlevel" data-placement="bottom" class="enable-tooltip btn btn-alt btn-sm btn-primary" title="Add New" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="table-responsive">
                <?php
                    $tableuserlevel = new MyTable('user_level');
                    $userlevels = $tableuserlevel->findAll('', '');
			     echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered'>
                        <thead><tr>
                            <th class='text-center'>Level</th>
                            <th class='text-center'>$languser7</th>
                        </tr></thead><tbody>"; 
                        $no=1;
                        foreach($userlevels as $userlevel){
                            echo "<tr>
                                <td class='text-center'>$userlevel->level</td>
                                <td class='text-center'>
                                    <div class='btn-group btn-group-xs'>
                                        <a href='#editlevel$userlevel->id_level' id='$userlevel->id_level' data-placement='left' class='enable-tooltip btn btn-xs btn-default' data-toggle='modal' title='$langaction1'><i class='fa fa-pencil'></i></a>";
                                        if ($userlevel->id_level == "1" OR $userlevel->id_level == "2" OR $userlevel->id_level == "3"){
                                        }else{
                                        echo "<a data-placement='right' class='enable-tooltip btn btn-xs btn-danger alertdellevel' id='$userlevel->id_level' data-toggle='tooltip' title='Delete'><i class='fa fa-times'></i></a>";
                                        }
                                    echo "</div>
                                </td>
                            </tr>";
                            ?>
                            <div id="editlevel<?=$userlevel->id_level;?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="form-validation" method="post" action="<?=$aksi;?>" autocomplete="off">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title">Edit User Level</h3>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="mod" value="user">
                                                <input type="hidden" name="act" value="edituserlevel">
                                                <input type="hidden" name="id" value="<?=$userlevel->id_level;?>">
                                                <div class="form-group">
                                                    <label>Level</label>
                                                    <input class="form-control" type="text" id="title" name="title" value="<?=$userlevel->level;?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $no++;
                        }
                    echo "</tbody></table>";
                ?>
                </div>
            </div>
       </div>
    </div>
    <?php } 
    elseif ($_SESSION[leveluser]=='2'){
    ?>
        <div class="row">
            <div class="col-md-12">
                    <div class="block full">
                        <div class="block-title">
                            <h2><?=$languser1;?></h2>
                            <div class="block-options pull-right">
                                <!--<a href="admin.php?mod=user&act=addnew" data-toggle="modal" class="enable-tooltip btn btn-alt btn-sm btn-warning" data-placement="bottom" title="New User"><i class='gi gi-group'></i> Add New</a>-->
                            </div>
                        </div>
                        <div class="table-responsive">
                        <?php
                            $tableuser = new MyTable('users');
                            $users = $tableuser->findNotAll(level, '1');
                    echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-vcenter table-condensed table-bordered' id='table-datatable'>
                                <thead><tr>
                                    <th class='text-center'><i class='gi gi-user'></i></th>
                                    <th class='text-center'>Nama User</th>
                                    <th class='text-center'>Nama Lengkap</th>
                                    <th class='text-center'>Email</th>
                                    <th class='text-center'>Telepon</th>
                                    <th class='text-center'>Alamat</th>
                                    <th class='text-center'>Tanggal Daftar</th>
                                    <th class='text-center'>Action</th>
                                </tr></thead>"; 
                                $no=1;
                                foreach($users as $user){
                                    $tablelevel = new MyTable('user_level');
                                    $currentLevel = $tablelevel->findBy(id_level, $user->level);
                                    $currentLevel = $currentLevel->current();
                                    $filename = "myuser/user-$user->id_user.jpg";
                                    if (file_exists($filename)){
                                        $picture = "<div class='text-center'><img src='myuser/user-$user->id_user.jpg' alt='avatar' class='widget-image img-circle' style='width:70px; border:1px solid #ccc;'/>";
                                    }else{
                                        $picture = "<div class='text-center'><img src='myuser/user-editor.jpg' alt='avatar' class='widget-image img-circle' style='width:70px; border:1px solid #ccc;'/>";
                                    }
                                    if($user->blokir == 'Y'){
                                        $blokir = "<div class='text-center'><span class='label label-success'>$user->blokir</span></div>";
                                    }else{
                                        $blokir = "<div class='text-center'><span class='label label-warning'>$user->blokir</span></div>";
                                    }
                                    echo "<tr>
                                        <td class='text-center'>$picture</td>
                                        <td class='text-center'>$user->username</td>
                                        <td class='text-center'>$user->nama_lengkap</td>
                                        <td class='text-center'>$user->email</td>
                                        <td class='text-center'>$user->no_telp</td>
                                        <td class='text-center'>$user->alamat</td>
                                        <td class='text-center'>$user->tgl_daftar</td>
                                        <td class='text-center'>
                                            <div class='text-center'><div class='btn-group btn-group-xs'>
                                                <a href='admin.php?mod=user&act=edit&id=$user->id_user' id='$userrole->id_role' data-placement='left' class='enable-tooltip btn btn-xs btn-default' data-toggle='modal' title='Verifikasi'><i class='fa fa-pencil'></i></a>
                                                <a data-placement='right' class='enable-tooltip btn btn-xs btn-danger alertdel' id='$user->id_user' title='Delete'><i class='fa fa-times'></i></a>
                                            </div></div>
                                        </td>
                                    </tr>";
                                    $no++;
                                }
                            echo "</tbody></table>";
                        ?>
                        </div>
                    </div>
            </div>
        </div>
    <?php
        } 
    else {
        $tableuser = new MyTable('users');
        $currentUser = $tableuser->findBy(username, $_SESSION['namauser']);
        $currentUser = $currentUser->current();
        $tablelevel = new MyTable('user_level');
        $currentLevel = $tablelevel->findBy(id_level, $currentUser->level);
        $currentLevel = $currentLevel->current();
        $tablejabatan = new MyTable('user_jabatan');
        $currentJabat = $tablejabatan->findBy(id_jabatan, $currentUser->jabatan);
        $currentJabat = $currentJabat->current();
    ?>
        <div class="row">
					<div class="col-md-4">
						<div class="widget">
							<div class="widget-advanced">
								<div class="widget-header text-center">
                                    <img src="images/placeholders/headers/widget1_header.jpg" alt="background" class="widget-background animation-pulseSlow">
									<h3 class="widget-content widget-content-image widget-content-light">
                                        <span class="themed-color"><?=$currentUser->nama_lengkap;?></span><br>
                                        <small><?=$currentUser->username;?></small>
									</h3>
								</div>
								<div class="widget-main" style="border-left:1px solid #EAEDF1;border-right:1px solid #EAEDF1;border-bottom:1px solid #EAEDF1;">
									<a href="#" class="widget-image-container animation-hatch">
									<?php
										$filename = "../mycontent/myuser/user-$_SESSION[iduser].jpg";
										if (file_exists("$filename")){
											echo "<img src='../mycontent/myuser/user-$_SESSION[iduser].jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' />";
										}else{
											echo "<img src='../mycontent/myuser/user-editor.jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' />";
										}
									?>
									</a>
									<div class="row text-center animation-fadeIn">
										<div class="col-xs-6">
											<h3>
												<small>Level</small>
												<strong><?=$currentLevel->level;?></strong>
											</h3>
										</div>
										<div class="col-xs-6">
											<h3>
												<small>User Id</small>
												<strong><?=$currentUser->id_user;?></strong>
											</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="block">
							<div class="block-title">
								<div class="block-options pull-right">
									<a href="?mod=user&act=edit&id=<?=$currentUser->id_session;?>" class="btn btn-alt btn-sm btn-primary" data-toggle="tooltip" title="<?=$langaction1;?>"><i class="fa fa-pencil"></i></a>
								</div>
								<h2>About <strong>You</strong></h2>
							</div>
							<table class="table table-borderless table-striped">
								<tbody>
									<tr>
										<td style="width: 20%;"><strong>Biografi</strong></td>
										<td><?=$currentUser->bio;?></td>
									</tr>
									<tr>
										<td><strong>Email</strong></td>
										<td><?=$currentUser->email;?></td>
									</tr>
									<tr>
										<td><strong>Telphone</strong></td>
										<td><?=$currentUser->no_telp;?></td>
									</tr>
									<tr>
										<td><strong>Divisi</strong></td>
										<td><?=$currentJabat->jabatan;?></td>
									</tr>
									<tr>
										<td><strong>Member From</strong></td>
										<td><?=$currentUser->tgl_daftar;?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
        </div>
    <?php } ?>
	<div id="alertdel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="user">
						<input type="hidden" name="act" value="deleteuser">
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
	<div id="tblnew" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-validation" method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title">Add User Devisi</h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="user">
						<input type="hidden" name="act" value="adduserjabatan">
						<div class="form-group">
							<label>Devisi</label>
							<input class="form-control" type="text" id="title" name="title" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="alertdeljabatan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="user">
						<input type="hidden" name="act" value="deleteuserjabatan">
						<input type="hidden" id="delidjabatan" name="id">
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
	<div id="newlevel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-validation" method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title">Add User Level</h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="user">
						<input type="hidden" name="act" value="adduserlevel">
						<div class="form-group">
							<label>Level</label>
							<input class="form-control" type="text" id="title" name="title" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="alertdellevel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="user">
						<input type="hidden" name="act" value="deleteuserlevel">
						<input type="hidden" id="delidlevel" name="id">
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
	<div id="newrole" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-validation" method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title">Add User Role</h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="user">
						<input type="hidden" name="act" value="adduserrole">
						<div class="form-group">
							<label>Level <span class="text-danger">*</span></label>
							<select class="form-control" name="level" style="width:280px;" data-placeholder="Choose Level">
							<?php
								$tablelevel = new MyTable("user_level");
								$levels = $tablelevel->findAll(id_level, ASC);
								foreach($levels as $level){
									echo "<option value='$level->id_level'>$level->level</option>";
								}
							?>
							</select>
						</div>
						<div class="form-group">
							<label>Module <span class="text-danger">*</span></label>
							<input class="form-control" type="text" id="title" name="title" required>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Read <span class="text-danger">*</span></label>
									<select class="form-control" name="read_access" style="width:280px;">
										<option value="Y">Y</option>
										<option value="N">N</option>
									</select>
								</div>
								<div class="form-group">
									<label>Write <span class="text-danger">*</span></label>
									<select class="form-control" name="write_access" style="width:280px;">
										<option value="Y">Y</option>
										<option value="N">N</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Modify <span class="text-danger">*</span></label>
									<select class="form-control" name="modify_access" style="width:280px;">
										<option value="Y">Y</option>
										<option value="N">N</option>
									</select>
								</div>
								<div class="form-group">
									<label>Delete <span class="text-danger">*</span></label>
									<select class="form-control" name="delete_access" style="width:280px;">
										<option value="Y">Y</option>
										<option value="N">N</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="alertdelrole" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?=$aksi;?>" autocomplete="off">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$langdelete1;?></h3>
					</div>
					<div class="modal-body">
						<input type="hidden" name="mod" value="user">
						<input type="hidden" name="act" value="deleteuserrole">
						<input type="hidden" id="delidrole" name="id">
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

	case "addnew":
    if ($_SESSION[leveluser]=='1' OR $_SESSION[leveluser]=='2'){
?>
	<div class="block">
        <div class="block-title">
            <h2><strong>Add</strong> user</h2>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
            <div class="block-section">
                <h3 class="sub-header text-center"><strong>Add User with 1 easy steps!</strong></h3>
                                    <p class="clearfix"><i class="fa fa-plus fa-5x text-primary pull-left"></i>Isi data sesuai dengan field yang tersedia.<span class="text-success"><strong> all easy!</strong></span> </p>
                                    <p>
                                        <span class="btn btn-lg btn-success btn-block">Get Started.. <i class="fa fa-arrow-right"></i></span>
                                    </p>
                                </div>
                            </div>
            <div class="col-sm-7">
		      <form id="form-validation" class="form-horizontal" method="post" action="<?=$aksi;?>" autocomplete="off">
                <fieldset>
                    <input type="hidden" name="mod" value="user">
                    <input type="hidden" name="act" value="input">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Username <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Repeat Password <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                           <input class="form-control" type="password" id="repeatPass" name="repeatpass" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Level <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <select class="form-control" name="level" data-placeholder="Choose Level">
                        <?php
                            $tablelevel = new MyTable("user_level");
                            $levels = $tablelevel->findNotAll(id_level, '1', ASC);
                            foreach($levels as $level){
                                echo "<option value='$level->id_level'>$level->level</option>";
                            }
                        ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Fullname <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Email <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Phone Number <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="no_telp" name="no_telp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Alamat <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" id="alamat" name="alamat" required>
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
    
    case "view":
	$valid = $val->validasi($_GET['id'],'xss');
	$table = new MyTable('users');
	$currentUser = $table->findBy(id_user, $valid);
	$currentUser = $currentUser->current();
    $tablelevel = new MyTable('user_level');
    $currentLevel = $tablelevel->findBy(id_level, $currentUser->level);
    $currentLevel = $currentLevel->current();
    $tablejabatan = new MyTable('user_jabatan');
    $currentJabat = $tablejabatan->findBy(id_jabatan, $currentUser->jabatan);
    $currentJabat = $currentJabat->current();
	$dutf=html_entity_decode($currentUser->bio);
	if ($currentUser == '0'){
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
    }else{ 
    if ($_SESSION[leveluser]=='1'){
    ?>
                <div class="row">
					<div class="col-md-4">
						<div class="widget">
							<div class="widget-advanced">
								<div class="widget-header text-center">
                                    <img src="images/placeholders/headers/widget1_header.jpg" alt="background" class="widget-background animation-pulseSlow">
									<h3 class="widget-content widget-content-image widget-content-light">
                                        <span class="themed-color"><?=$currentUser->nama_lengkap;?></span><br>
                                        <small><?=$currentLevel->level;?></small>
									</h3>
								</div>
								<div class="widget-main" style="border-left:1px solid #EAEDF1;border-right:1px solid #EAEDF1;border-bottom:1px solid #EAEDF1;">
									<a href="#" class="widget-image-container animation-hatch">
									<?php
										$filename = "../mycontent/myuser/user-$currentUser->id_user.jpg";
										if (file_exists("$filename")){
											echo "<img src='../mycontent/myuser/user-$currentUser->id_user.jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' />";
										}else{
											echo "<img src='../mycontent/myuser/user-editor.jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' />";
										}
									?>
									</a>
									<div class="row text-center animation-fadeIn">
										<div class="col-xs-6">
											<h3>
												<?php
													$tableposts = new MyTable("post");
													$numposts = $tableposts->numRowBy(editor, $currentUser->id_user);
												?>
												<strong><?=$numposts;?></strong>
												<small>Post</small>
											</h3>
										</div>
										<div class="col-xs-6">
											<h3>
												<strong><?=$currentUser->id_user;?></strong>
												<small>User Id</small>
											</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="block">
							<div class="block-title">
								<div class="block-options pull-right">
									<a href="?mod=user" data-toggle="tooltip" placement="bottom" class="enable-tooltip btn btn-alt btn-sm btn-primary" title="Back to user"><i class="fa fa-reply"></i> Back to User</a>
                                    <a href="?mod=user&act=edit&id=<?=$currentUser->id_session;?>" placement="bottom" class="enable-tooltip btn btn-alt btn-sm btn-primary" data-toggle="tooltip" title="<?=$langaction1;?>"><i class="fa fa-pencil"></i></a>
                                </div>
							</div>
							<table class="table table-borderless table-striped">
								<tbody>
									<tr>
										<td style="width: 20%;"><strong>Biografi</strong></td>
										<td><?=$currentUser->bio;?></td>
									</tr>
									<tr>
										<td><strong>Email</strong></td>
										<td><?=$currentUser->email;?></td>
									</tr>
									<tr>
										<td><strong>Telphone</strong></td>
										<td><?=$currentUser->no_telp;?></td>
									</tr>
									<tr>
										<td><strong>Tgl Registrasi</strong></td>
										<td><?=$currentUser->tgl_daftar;?></td>
									</tr>
									<tr>
										<td><strong>Divisi</strong></td>
										<td><?=$currentJabat->jabatan;?></td>
									</tr>
									<tr>
										<td><strong>Username</strong></td>
										<td><?=$currentUser->username;?></td>
									</tr>
									<tr>
										<td><strong>Password</strong></td>
										<td><?=$currentUser->password;?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

    <?php } 
    elseif ($_SESSION[leveluser]=='2'){
    ?>
                <div class="row">
					<div class="col-md-4">
						<div class="widget">
							<div class="widget-advanced">
								<div class="widget-header text-center">
                                    <img src="images/placeholders/headers/widget1_header.jpg" alt="background" class="widget-background animation-pulseSlow">
									<h3 class="widget-content widget-content-image widget-content-light">
                                        <span class="themed-color"><?=$currentUser->nama_lengkap;?></span><br>
                                        <small><?=$currentUser->username;?></small>
									</h3>
								</div>
								<div class="widget-main" style="border-left:1px solid #EAEDF1;border-right:1px solid #EAEDF1;border-bottom:1px solid #EAEDF1;">
									<a href="#" class="widget-image-container animation-hatch">
									<?php
										$filename = "myuser/user-$currentUser->id_user.jpg";
										if (file_exists("$filename")){
											echo "<img src='myuser/user-$currentUser->id_user.jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' />";
										}else{
											echo "<img src='myuser/user-editor.jpg' class='widget-image img-circle' alt='avatar' width='30' height='30' />";
										}
									?>
									</a>
									<div class="row text-center animation-fadeIn">
										<div class="col-xs-12">
											<h3>
												<strong><?=$currentLevel->level;?></strong>
												<small>Level</small>
											</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="block">
							<div class="block-title">
								<div class="block-options pull-right">
                                    <a href="?mod=user" data-toggle="tooltip" placement="bottom" class="enable-tooltip btn btn-alt btn-sm btn-primary" title="Back to user"><i class="fa fa-reply"></i> Back to User</a>
									<a href="?mod=user&act=edit&id=<?=$currentUser->id_session;?>" placement="bottom" class="enable-tooltip btn btn-alt btn-sm btn-primary" data-toggle="tooltip" title="<?=$langaction1;?>"><i class="fa fa-pencil"></i></a>
                                </div>
							</div>
							<table class="table table-borderless table-striped">
								<tbody>
									<tr>
										<td style="width: 20%;"><strong>Biografi</strong></td>
										<td><?=$currentUser->bio;?></td>
									</tr>
									<tr>
										<td><strong>Email</strong></td>
										<td><?=$currentUser->email;?></td>
									</tr>
									<tr>
										<td><strong>Telphone</strong></td>
										<td><?=$currentUser->no_telp;?></td>
									</tr>
									<tr>
										<td><strong>Divisi</strong></td>
										<td><?=$currentJabat->jabatan;?></td>
									</tr>
									<tr>
										<td><strong>Tgl Registrasi</strong></td>
										<td><?=$currentUser->tgl_daftar;?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
<?php }
    }
    break;

	case "edit":
	$valid = $val->validasi($_GET['id'],'xss');
	$table = new MyTable('users');
	$currentUser = $table->findBy(id_session, $valid);
	$currentUser = $currentUser->current();
	$dutf=html_entity_decode($currentUser->bio);
	if ($currentUser == '0'){
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
	}else{
		if ($_SESSION[leveluser]=='1'){
?>
	<div class="block full">
		<div class="block-title"><h2>Edit User</h2></div>
		<form id="form-validation" method="post" action="<?=$aksi;?>" enctype="multipart/form-data" autocomplete="off">
			<fieldset>
				<input type="hidden" name="id" value="<?=$currentUser->id_session;?>">
				<input type="hidden" name="iduser" value="<?=$currentUser->id_user;?>">
				<input type="hidden" name="blokir" value="<?=$currentUser->blokir;?>">
                <input type="hidden" name="locktype" id="locktype" value="<?=$currentUser->locktype;?>">
				<input type="hidden" name="mod" value="user">
				<input type="hidden" name="act" value="update">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="<?=$currentUser->username;?>" disabled>
                            <span class="help-block">Username can not be changed, except from direct database (phpmyadmin)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <?php
                                if ($currentUser->locktype == "0") {
                            ?>
                            <div class="box-password">
                                <div class="input-group">
                                    <input class="form-control" type="password" id="newpassword" name="newpassword">
                                    <span class="input-group-btn">
                                        <button id="change-lock-type" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <span class="help-block">If the password is not changed, just empty</span>
                            </div>
                            <div class="box-password-lock" style="display:none;">
                                <div class="input-group">
                                    <span class="btn-group">
                                        <button id="change-pattern" class="btn btn-warning" type="button"><i class="fa fa-barcode"></i> Change Pattern</button>
                                        <button id="change-lock-type-2" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <div id="patternHolder"></div>
                                <span class="help-block">If the password is not changed, just ignore any options</span>
                            </div>
                            <?php } else { ?>
                            <div class="box-password" style="display:none;">
                                <div class="input-group">
                                    <input class="form-control" type="password" id="newpassword" name="newpassword">
                                    <span class="input-group-btn">
                                        <button id="change-lock-type" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <span class="help-block">If the password is not changed, just empty</span>
                            </div>
                            <div class="box-password-lock">
                                <div class="input-group">
                                    <span class="btn-group">
                                        <button id="change-pattern" class="btn btn-warning" type="button"><i class="fa fa-barcode"></i> Change Pattern</button>
                                        <button id="change-lock-type-2" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <div id="patternHolder"></div>
                                <span class="help-block">If the password is not changed, just ignore any options</span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fullname <span class="text-danger">*</span></label>
                            <div class="input-group">
                               <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?=$currentUser->nama_lengkap;?>" required>
                               <span class="input-group-addon"><i class="gi gi-user"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="email" name="email" class="form-control" value="<?=$currentUser->email;?>" placeholder="test@example.com" required>
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="no_telp" name="no_telp" value="<?=$currentUser->no_telp;?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="alamat" name="alamat" value="<?=$currentUser->alamat;?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea class="form-control textarea-editor" rows="8" cols="" id="bio" name="bio"><?=$dutf;?></textarea>
				</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>User Picture</label><br>
                            <?php
                                $filename = "../mycontent/myuser/user-$_SESSION[iduser].jpg";
                                if (file_exists("$filename")){
                                    echo "<a href='../mycontent/myuser/user-$_SESSION[iduser].jpg' data-toggle='lightbox-image'>
                                               <img src='../mycontent/myuser/user-$_SESSION[iduser].jpg' alt='avatar' style='width:100px;'>
                                            </a>";
                                    }else{
                                        echo "<a href='../mycontent/myuser/user-editor.jpg' data-toggle='lightbox-image'>
                                                <img src='../mycontent/myuser/user-editor.jpg' alt='avatar' style='width:100px;'/></a>";
                                    }
                            ?>
                            <input id="input01" name="fupload" type="file">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <?php if ($currentUser->blokir=="N"){ ?>
                                        <label class="col-md-12">Block</label>
                                        <div class="col-md-12">
                                            <label class="radio-inline"><input type="radio" id="blokir1" name="blokir" value="Y">Y</label>
                                            <label class="radio-inline"><input type="radio" id="blokir2" name="blokir" value="N" checked="checked">N</label>
                                        </div>
                                    <?php }else{ ?>
                                        <label class="col-md-12">Block</label>
                                        <div class="col-md-12">
                                            <label class="radio-inline"><input type="radio" id="blokir1" name="blokir" value="Y" checked="checked">Y</label>
                                            <label class="radio-inline"><input type="radio" id="blokir2" name="blokir" value="N">N</label>
                                        </div>
                                    <?php } ?>
                                    <p style="height:35px;">&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control" name="level" data-placeholder="Choose Level">
                                    <?php
                                        $tableselevel = new MyTable('user_level');
                                        $sellevels = $tableselevel->findBy(id_level, $currentUser->level);
                                        $sellevels = $sellevels->current();
                                        echo "<option value='$sellevels->id_level'>$sellevels->level</option>";
                                        $tablelevels = new MyTable('user_level');
                                        $levels = $tablelevels->findNotAll(id_level, $currentUser->level);
                                        foreach($levels as $level){
                                            echo "<option value='$level->id_level'>$level->level</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Divisi</label>
                                <select class="form-control" name="jabatan" data-placeholder="Choose Level">
                                    <?php
                                        $tableselevel = new MyTable('user_jabatan');
                                        $sellevels = $tableselevel->findBy(id_jabatan, $currentUser->jabatan);
                                        $sellevels = $sellevels->current();
                                        echo "<option value='$sellevels->id_jabatan'>$sellevels->jabatan</option>";
                                        $tablelevels = new MyTable('user_jabatan');
                                        $levels = $tablelevels->findNotAll(id_jabatan, $currentUser->jabatan);
                                        foreach($levels as $level){
                                            echo "<option value='$level->id_jabatan'>$level->jabatan</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="form-group form-actions">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					<button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
				</div>
			</fieldset>
		</form>
	</div>
<?php
		} elseif ($_SESSION[leveluser]=='2'){
?>
	<div class="block full">
		<div class="block-title"><h2>Edit User</h2></div>
		<form id="form-validation" method="post" action="<?=$aksi;?>" enctype="multipart/form-data" autocomplete="off">
			<fieldset>
				<input type="hidden" name="id" value="<?=$currentUser->id_session;?>">
				<input type="hidden" name="iduser" value="<?=$currentUser->id_user;?>">
				<input type="hidden" name="blokir" value="<?=$currentUser->blokir;?>">
                <input type="hidden" name="locktype" id="locktype" value="<?=$currentUser->locktype;?>">
				<input type="hidden" name="mod" value="user">
				<input type="hidden" name="act" value="update">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="<?=$currentUser->username;?>" disabled>
                            <span class="help-block">Username can not be changed, except from direct database (phpmyadmin)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <?php
                                if ($currentUser->locktype == "0") {
                            ?>
                            <div class="box-password">
                                <div class="input-group">
                                    <input class="form-control" type="password" id="newpassword" name="newpassword">
                                    <span class="input-group-btn">
                                        <button id="change-lock-type" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <span class="help-block">If the password is not changed, just empty</span>
                            </div>
                            <div class="box-password-lock" style="display:none;">
                                <div class="input-group">
                                    <span class="btn-group">
                                        <button id="change-pattern" class="btn btn-warning" type="button"><i class="fa fa-barcode"></i> Change Pattern</button>
                                        <button id="change-lock-type-2" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <div id="patternHolder"></div>
                                <span class="help-block">If the password is not changed, just ignore any options</span>
                            </div>
                            <?php } else { ?>
                            <div class="box-password" style="display:none;">
                                <div class="input-group">
                                    <input class="form-control" type="password" id="newpassword" name="newpassword">
                                    <span class="input-group-btn">
                                        <button id="change-lock-type" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <span class="help-block">If the password is not changed, just empty</span>
                            </div>
                            <div class="box-password-lock">
                                <div class="input-group">
                                    <span class="btn-group">
                                        <button id="change-pattern" class="btn btn-warning" type="button"><i class="fa fa-barcode"></i> Change Pattern</button>
                                        <button id="change-lock-type-2" class="btn btn-success" type="button"><i class="fa fa-gear"></i> Change Lock Type</button>
                                    </span>
                                </div>
                                <div id="patternHolder"></div>
                                <span class="help-block">If the password is not changed, just ignore any options</span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fullname <span class="text-danger">*</span></label>
                            <div class="input-group">
                               <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?=$currentUser->nama_lengkap;?>" required>
                               <span class="input-group-addon"><i class="gi gi-user"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="email" name="email" class="form-control" value="<?=$currentUser->email;?>" placeholder="test@example.com" required>
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="no_telp" name="no_telp" value="<?=$currentUser->no_telp;?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="alamat" name="alamat" value="<?=$currentUser->alamat;?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea class="form-control textarea-editor" rows="8" cols="" id="bio" name="bio"><?=$dutf;?></textarea>
				</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>User Picture</label><br>
                            <a href="myuser/user-<?=$currentUser->id_user;?>.jpg" data-toggle="lightbox-image">
                                <?php
                                    $filename = "myuser/user-$currentUser->id_user.jpg";
                                    if (file_exists("$filename")){
                                        echo "<img src='myuser/user-$currentUser->id_user.jpg' alt='avatar' style='width:100px;'/>";
                                    }else{
                                        echo "<img src='myuser/user-editor.jpg' alt='avatar' style='width:100px;'/>";
                                    }
                                ?>
                            </a>
                            <input id="fileInput" name="fupload" type="file">
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <?php if ($currentUser->blokir=="N"){ ?>
                                        <label class="col-md-12">Block</label>
                                        <div class="col-md-12">
                                            <label class="radio-inline"><input type="radio" id="blokir1" name="blokir" value="Y">Y</label>
                                            <label class="radio-inline"><input type="radio" id="blokir2" name="blokir" value="N" checked="checked">N</label>
                                        </div>
                                    <?php }else{ ?>
                                        <label class="col-md-12">Block</label>
                                        <div class="col-md-12">
                                            <label class="radio-inline"><input type="radio" id="blokir1" name="blokir" value="Y" checked="checked">Y</label>
                                            <label class="radio-inline"><input type="radio" id="blokir2" name="blokir" value="N">N</label>
                                        </div>
                                    <?php } ?>
                                    <p style="height:35px;">&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control" name="level" data-placeholder="Choose Level">
                                    <?php
                                        $tableselevel = new MyTable('user_level');
                                        $sellevels = $tableselevel->findBy(id_level, $currentUser->level);
                                        $sellevels = $sellevels->current();
                                        echo "<option value='$sellevels->id_level'>$sellevels->level</option>";
                                             
                                        $tablelevels = new MyTable('user_level');
                                        $levels = $tablelevels->findNotAll(id_level, '1');
                                        foreach($levels as $level){
                                            echo "<option value='$level->id_level'>$level->level</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Divisi</label>
                                <select class="form-control" name="jabatan" data-placeholder="Choose Level">
                                    <?php
                                        $tableselevel = new MyTable('user_jabatan');
                                        $sellevels = $tableselevel->findBy(id_jabatan, $currentUser->jabatan);
                                        $sellevels = $sellevels->current();
                                        echo "<option value='$sellevels->id_jabatan'>$sellevels->jabatan</option>";
                                        $tablelevels = new MyTable('user_jabatan');
                                        $levels = $tablelevels->findNotAll(id_jabatan, $currentUser->jabatan);
                                        foreach($levels as $level){
                                            echo "<option value='$level->id_jabatan'>$level->jabatan</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="form-group form-actions">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					<button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
				</div>
			</fieldset>
		</form>
	</div>
<?php
		}else{
?>
	<div class="block full">
		<div class="block-title"><h2>Edit User</h2></div>
		<form id="form-validation" class="form-bordered" method="post" action="<?=$aksi;?>" enctype="multipart/form-data" autocomplete="off">
			<fieldset>
				<input type="hidden" name="id" value="<?=$currentUser->id_session;?>">
				<input type="hidden" name="iduser" value="<?=$currentUser->id_user;?>">
				<input type="hidden" name="blokir" value="<?=$currentUser->blokir;?>">
				<input type="hidden" name="jabatan" value="<?=$currentUser->jabatan;?>">
                <input type="hidden" name="locktype" id="locktype" value="<?=$currentUser->locktype;?>">
				<input type="hidden" name="mod" value="user">
				<input type="hidden" name="act" value="updatemember">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="<?=$currentUser->username;?>" disabled>
                            <span class="help-block">Username can not be changed, except from direct database (phpmyadmin)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" id="newpassword" name="newpassword">
                            <span class="help-block">If the password is not changed, just empty</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fullname <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" value="<?=$currentUser->nama_lengkap;?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="email" name="email" value="<?=$currentUser->email;?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="alamat" name="alamat" value="<?=$currentUser->alamat;?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="no_telp" name="no_telp" value="<?=$currentUser->no_telp;?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea class="form-control textarea-editor" rows="8" cols="" id="bio" name="bio"><?=$dutf;?></textarea>
				</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User Picture</label><br>
                            <a href="../mycontent/myuser/user-<?=$currentUser->id_user;?>.jpg" data-toggle="lightbox-image">
                                <?php
                                    $filename = "../mycontent/myuser/user-$currentUser->id_user.jpg";
                                    if (file_exists("$filename")){
                                        echo "<img src='../mycontent/myuser/user-$currentUser->id_user.jpg' alt='avatar' style='width:100px;'/>";
                                    }else{
                                        echo "<img src='../mycontent/myuser/user-editor.jpg' alt='avatar' style='width:100px;'/>";
                                    }
                                ?>
                            </a>
                            <input id="fileInput" name="fupload" type="file">
                        </div>
                    </div>
                </div>
				<div class="form-group form-actions">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
					<button type="reset" class="btn btn-sm btn-danger pull-right" onclick="self.history.back()"><i class="fa fa-times"></i> Cancel</button>
				</div>
			</fieldset>
		</form>
	</div>
<?php 
		}
	}
    break;  
}
}
?>