<?php
include_once 'mylibrary/mydatabase.php';
function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
}
$mod = $_POST['mod'];
$act = $_POST['act'];
if ($mod=='login' AND $act=='proclogin') {
    $username = anti_injection($_POST['username']);
    $pass = anti_injection(md5($_POST['password']));
    if (!ctype_alnum($username) OR !ctype_alnum($pass)){
        header('location:index.php?errormsg=1');
    }
    else{
        $table = new MyTable('tblusers');
        $currentUser = $table->findByLogin(username, $username, password, $pass );
        $currentUser = $currentUser->current();
        if ($currentUser > 0){
            session_start();
            include_once "timeout.php";
            $_SESSION['iduser'] = $currentUser->IDUser;
            $_SESSION['user'] = $currentUser->username;
            $_SESSION['namalengkap'] = $currentUser->Nama;
            $_SESSION['pass'] = $currentUser->password;
            $_SESSION['hakakses'] = $currentUser->HakAkses;
            $_SESSION['idrekanan'] = $currentUser->IDRekanan;
            timer();
			header('location:administrasi.php?mod=home');
        }else{
            header('location:index.php?errormsg=2');
        }
    }
}
?>