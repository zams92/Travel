<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
	header('location:404.php');
}else{
include_once '../../mylibrary/mydatabase.php';
include_once '../../mylibrary/myfunction.php';

$tableroleaccess = new MyTable('tblusers');
$currentRoleAccess = $tableroleaccess->findByAnd(HakAses, $_SESSION['hakakses'], username, $_SESSION['user']);
$currentRoleAccess = $currentRoleAccess->current();

if($currentRoleAccess->HakAses == "Admin" OR $currentRoleAccess->HakAses == "Operator"){

    $aColumns = array( 'KodeDaftar', 'Nama', 'Alamat', 'NoPonsel', 'Email', 'TanggalLahir', 'JenisKelamin', 'Status', 'DaftarSebagai', 'IDRekanan' );

    $sIndexColumn = "KodeDaftar";

    $sTable = "tblpendaftaran";

    $gaSql['user']       = DATABASE_USER;
    $gaSql['password']   = DATABASE_PASS;
    $gaSql['db']         = DATABASE_NAME;
    $gaSql['server']     = DATABASE_HOST;

    $gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
        die( 'Could not open connection to server' );

    mysql_select_db( $gaSql['db'], $gaSql['link'] ) or
        die( 'Could not select database '. $gaSql['db'] );

    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
            mysql_real_escape_string( $_GET['iDisplayLength'] );
    }

    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
            }
        }

        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }

    $sWhere = "";
    if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }

    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }

    $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";
    $rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());

    $sQuery = "
        SELECT FOUND_ROWS()
    ";
    $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
    $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];

    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
    ";
    $rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
    $aResultTotal = mysql_fetch_array($rResultTotal);
    $iTotal = $aResultTotal[0];

    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

	$no = 1;
    while ( $aRow = mysql_fetch_array( $rResult ) )
    {
        $row = array();
        for ( $i=1 ; $i<count($aColumns) ; $i++ )
        {
            $filename = "../myuser/user-$aRow[KodeDaftar].jpg";
            if (file_exists($filename)){
                $picture = "<div class='text-center'><img src='../myuser/user-$aRow[KodeDaftar].jpg' alt='avatar' class='widget-image img-circle' style='width:70px; border:1px solid #ccc;'/>";
            }else{
                $picture = "<div class='text-center'><img src='../myuser/user-editor.jpg' alt='avatar' class='widget-image img-circle' style='width:70px; border:1px solid #ccc;'/>";
            }
            if($aRow['blokir'] == 'Y'){
				$blokir = "<div class='text-center'><span class='label label-success'>$aRow[blokir]</span></div>";
			}else{
				$blokir = "<div class='text-center'><span class='label label-warning'>$aRow[blokir]</span></div>";
			}
            if($_SESSION['leveluser'] == '1'){
                if($currentRoleAccess->modify_access == "Y"){
                    $tblheadline = "<a class='btn btn-xs btn-default setheadline' id='$aRow[KodeDaftar]'><i class='fa fa-star'></i></a>";
                }
            }
            if($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2'){
                if($currentRoleAccess->modify_access == "Y"){
                    $tblheadline = "<a class='btn btn-xs btn-warning setblokir' id='$aRow[id_user]'><i class='fa fa-star'></i></a>";
                }
            }
            if($aRow['blokir'] == 'Y'){
				$headline = "<i class='fa fa-star text-success'></i> Y";
			}else{
				$headline = "<i class='fa fa-star text-warning'></i> N";
			}
			$valid = $aRow['level'];
			$validjabat = $aRow['jabatan'];
			$tablelevel = new MyTable('user_level');
			$currentLevel = $tablelevel->findBy(id_level, $valid);
			$currentLevel = $currentLevel->current();
			$row[] = $picture;
			$row[] = $aRow['email'];
			$row[] = "<div class='text-center'>$currentLevel->level</div>";
			$row[] = "<div class='text-center'><div class='btn-group btn-group-xs'>
						<span class='btn btn-xs btn-default' id='seth$aRow[id_user]' data-headline='$aRow[blokir]'>$headline</span>
                        $tblheadline
                    </div></div>";
			$row[] = "<div class='text-center'><div class='btn-group btn-group-xs'>
            <a class='btn btn-xs btn-success alertver' id='$aRow[id_user]'><i class='fa fa-check'></i></a>
            <a class='btn btn-xs btn-danger alertdel' id='$aRow[id_user]'><i class='fa fa-times'></i></a>
            </div></div>";
        }
        $output['aaData'][] = $row;
	$no++;
    }

    echo json_encode( $output );
}
}
?>