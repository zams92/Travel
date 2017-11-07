<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
include_once '../../../mylibrary/mydatabase.php';
include_once '../../../mylibrary/myfunction.php';

$tableroleaccess = new MyTable('user_role');
$currentRoleAccess = $tableroleaccess->findByAnd(id_level, $_SESSION['leveluser'], module, library);
$currentRoleAccess = $currentRoleAccess->current();

if($currentRoleAccess->read_access == "Y"){

    $aColumns = array( 'id_media', 'file_name', 'file_type', 'file_size', 'editor', 'date');

    $sIndexColumn = "id_media";

    $sTable = "media";

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

    if ($_SESSION['leveluser'] != "1" AND $_SESSION['leveluser'] != "2"){
        if ($sWhere == ""){
            $sWhereUser = "WHERE editor='".$_SESSION['iduser']."' ";
        }else{
            $sWhereUser = " AND editor='".$_SESSION['iduser']."' ";
        }
    }else{
        $sWhereUser = "";
    }

    $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sWhereUser
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
		$tableroleaccess = new MyTable('user_role');
		$currentRoleAccess = $tableroleaccess->findByAnd(id_level, $_SESSION['leveluser'], module, 'library');
		$currentRoleAccess = $currentRoleAccess->current();
        $user = new MyTable('users');
        $currentUser = $user->findBy(id_user, $aRow['editor']);
        $currentUser = $currentUser->current();
        $namauser = $currentUser->username;
        for ( $i=1 ; $i<count($aColumns) ; $i++ )
        {
			if($currentRoleAccess->delete_access == "Y"){
				$tbldelete = "<a class='btn btn-xs btn-danger alertdel' id='$aRow[id_media]'><i class='fa fa-trash-o'></i></a>";
			}
			$checkdata = "<div class='text-center'><input type='checkbox' id='titleCheckdel' /><input type='hidden' class='deldata' name='item[$no][deldata]' value='$aRow[id_media]' disabled></div>";
            $row[] = $checkdata;
			$row[] = $namauser;
			$row[] = "<a href='../mycontent/myupload/$aRow[file_name]'>$aRow[file_name]</a>";
			$row[] = $aRow['file_type'];
			$row[] = $aRow['file_size']." Byte";
			$row[] = "<div class='text-center'>$aRow[date]</div>";
			$row[] = "<div class='text-center'><div class='btn-group btn-group-xs'>
					$tbldelete
			</div></div>";
        }
        $output['aaData'][] = $row;
	$no++;
    }

    echo json_encode( $output );
}
}
?>