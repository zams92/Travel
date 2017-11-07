<?php
include_once "timezone.php";

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Ymd");
$tgl_skrg = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

function timezoneList(){
    $timezoneIdentifiers = DateTimeZone::listIdentifiers();
    $utcTime = new DateTime('now', new DateTimeZone('UTC'));
    $tempTimezones = array();
    foreach($timezoneIdentifiers as $timezoneIdentifier){
        $currentTimezone = new DateTimeZone($timezoneIdentifier);
        $tempTimezones[] = array(
            'offset' => (int)$currentTimezone->getOffset($utcTime),
            'identifier' => $timezoneIdentifier
        );
    }
    function sort_list($a, $b){
        return ($a['offset'] == $b['offset']) 
            ? strcmp($a['identifier'], $b['identifier'])
            : $a['offset'] - $b['offset'];
    }
    usort($tempTimezones, "sort_list");
    $timezoneList = array();
    foreach($tempTimezones as $tz){
        $sign = ($tz['offset'] > 0) ? '+' : '-';
        $offset = gmdate('H:i', abs($tz['offset']));
        $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
            $tz['identifier'];
    }
    return $timezoneList;
}

class Myvalidasi{
	function __construct(){}
	function validasi($str, $tipe){
        switch($tipe){
			default:
			case'sql':
				$d = array('-','/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','&','*','=','?','+');
				$str = str_replace($d, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);				
				$str = preg_replace('/[^A-Za-z0-9]/','',$str);				
				return intval($str);
			break;
			case'xss':
				$d = array ('\\','#',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','*','=','?','+');
				$str = str_replace($d, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);
				return $str;
			break;
		}
	}
	function extension($path) {
		$file = pathinfo($path);
		if(file_exists($file['dirname'].'/'.$file['basename'])){
			return $file['basename'];
		}
	}
}

//fungsi untuk menghitung umur. format tgl lahir dd-mm-yyyy
function umur($tgl_lahir,$delimiter='-') {    
    list($hari,$bulan,$tahun) = explode($delimiter, $tgl_lahir);    
    $selisih_hari = date('d') - $hari;
    $selisih_bulan = date('m') - $bulan;
    $selisih_tahun = date('Y') - $tahun;
    
    if ($selisih_hari < 0 || $selisih_bulan < 0) {
        $selisih_tahun--;
    }    
    return $selisih_tahun;
}

function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}

function tgl_eng($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulanEng(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $bulan.' '.$tanggal.', '.$tahun;		 
}

function seo_title($s){
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
    $s = str_replace($d, '', $s);
    $s = strtolower(str_replace($c, '-', $s));
    return $s;
}

function UploadImage($fupload_name){
    //direktori gambar
	$vdir_upload = "../../mycontent/mygallery/";
	$vfile_upload = $vdir_upload . $fupload_name;

    //simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

    //identitas file asli
	$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

    //set ukuran gambar hasil perubahan
	$dst_width = 390;
	$dst_height = ($dst_width/$src_width)*$src_height;
    
    //proses perubahan ukuran
	$im = imagecreatetruecolor($dst_width,$dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
    
    //simpan gambar
	imagejpeg($im,$vdir_upload . "medium-" . $fupload_name);
 
    //hapus gambar di memori komputer
	imagedestroy($im_src);
	imagedestroy($im);
}

function UploadSlide($fupload_name,$quality){
    //direktori gambar
    $vdir_upload = "../../../mycontent/myslide/";
    $vfile_upload = $vdir_upload . $fupload_name;
    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
    
    if(imagejpeg($image, $vdir_upload.$fupload_name.$ext, $quality)){
        unlink($vfile_upload);
        return true;
    }else{
        unlink($vfile_upload);
        return false;
    }
}

function watermark_image($fupload_name){
	$image_show = "../../../mylibrary/watermark.png";
	$path = "../../../mycontent/mygallery/";
	$oldimage_name=$path.$_FILES['fupload']['name'];
    
	move_uploaded_file($_FILES['fupload']['tmp_name'], $path.$_FILES['fupload']['name']);
   
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = $owidth;
	$height = ($width/$owidth)*$oheight;
    $im = imagecreatetruecolor($width, $height);
    
    $img_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);

    $watermark = imagecreatefrompng($image_show);
    list($w_width, $w_height) = getimagesize($image_show);        
    $pos_x = ($width - $w_width)/2; 
    $pos_y = ($height - $w_height)/2;
    
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $fupload_name, 50); 
    
    imagedestroy($im);
    unlink($oldimage_name);
    return $fupload_name;
}

function UploadUser($fupload_name){
	$vdir_upload = "../../myuser/";
	$vfile_upload = $vdir_upload . $fupload_name;

	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	$dst_width = 312;
	$dst_height = 312;
	$im = imagecreatetruecolor($dst_width,$dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
	imagejpeg($im,$vdir_upload . "user-" . $fupload_name);

	imagedestroy($im_src);
	imagedestroy($im);
	unlink("../../myuser/$fupload_name");
}

function UploadBanner($fupload_name, $size){
	$vdir_upload = "../mybanner/";
	$vfile_upload = $vdir_upload . $fupload_name;

	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	if ($size=='180'){
		$dst_width = 180;
		$dst_height = 180;
		$im = imagecreatetruecolor($dst_width,$dst_height);
		imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		imagejpeg($im,$vdir_upload . "ban-" . $fupload_name, 100);
	}else{
		$dst_width = 480;
		$dst_height = 80;
		$im = imagecreatetruecolor($dst_width,$dst_height);
		imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		imagejpeg($im,$vdir_upload . "ban-" . $fupload_name, 100);
	}

	imagedestroy($im_src);
	imagedestroy($im);
	unlink("../mybanner/$fupload_name");
}

function deleteDir($dirname){
    if (!file_exists($dirname)){
        return false;
    }
    
    if (is_file($dirname) || is_link($dirname)){
        return unlink($dirname);
    }
    
    $stack = array($dirname);
    while($entry = array_pop($stack)){
        
        if (is_link($entry)){
            unlink($entry);
            continue;
        }
        
        if (@rmdir($entry)){
            continue;
        }
        
        $stack[] = $entry;
        $dh = opendir($entry);
        while(false !== $child = readdir($dh)){
            
            if ($child === '.' || $child === '..') {
                continue;
            }
            
            $child = $entry . DIRECTORY_SEPARATOR . $child;
            if (is_dir($child) && !is_link($child)) {
                $stack[] = $child;
            } else {
                unlink($child);
            }
        }
        closedir($dh);
    }
    return true;
}

function addhttp($url){
    if (!preg_match("@^[hf]tt?ps?://@", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function getBulan($bln){
	switch ($bln){
		case 1: 
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

function getBulanEng($bln){
	switch ($bln){
		case 1: 
			return "Jan";
			break;
		case 2:
			return "Feb";
			break;
		case 3:
			return "Mar";
			break;
		case 4:
			return "Apr";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Jun";
			break;
		case 7:
			return "Jul";
			break;
		case 8:
			return "Agust";
			break;
		case 9:
			return "Sept";
			break;
		case 10:
			return "Oct";
			break;
		case 11:
			return "Nov";
			break;
		case 12:
			return "Dec";
			break;
	}
}

function autolink($str){
	$str = eregi_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http
	$str = eregi_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www.
	$str = eregi_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","\\1<a href=\"mailto:\\2\">\\2</a>", $str); // mail
	$str = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http
	$str = eregi_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www.
	$str = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a href=\"mailto:\\1\">\\1</a>", $str); // mail
	return $str;
}

/*Fungsi membuat kode secara random*/
function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0){
    /* mencari nomor baru dengan memecah nomor terakhir dan menambahkan 1
    string nomor baru dibawah ini harus dengan format XXX000000 */
    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
//    menambahkan nol didepan nomor baru sesuai panjang jumlah karakter
    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
//    menyusun kunci dan nomor baru
    $kode = $kunci . $nomor_baru_plus_nol;
    return $kode;
}

/*fungsi penulisan nama dan gelar yang benar.*/
function ucname($str){
    $string = ucwords(strtolower($str));
    foreach (array('-','\'','.') as $delimiter) {
        if (strpos($string, $delimiter) !== FALSE) {
            $string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
        }
    }
    return $string;
}

function cuthighlight($option, $data, $long){
	$content = $data;
	if ($option == "post"){
		$content = html_entity_decode($content);
		$content = strip_tags($content);
		$content = substr($content,0,$long);
		$content = substr($content,0,strrpos($content," "));
	}else{
		$content = substr($content,0,$long);
	}
	return $content;
}

function encrypt($str) {
    $kunci = '979a218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)+ord($kuncikarakter));
        $hasil .= $karakter;
        
    }
    return urlencode(base64_encode($hasil));
}
 
function decrypt($str) {
    $str = base64_decode(urldecode($str));
    $hasil = '';
    $kunci = '979a218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)-ord($kuncikarakter));
        $hasil .= $karakter;
        
    }
    return $hasil;
}

class Paging{
	function cariPosisi($batas){
		if(empty($_GET['page'])){
			$posisi=0;
			$_GET['page']=1;
		}else{
			$posisi = ($_GET['page']-1) * $batas;
		}
		return $posisi;
	}

	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	function navHalaman($halaman_aktif, $jmlhalaman, $website_url, $mod, $title, $num){
		$link_halaman = "";

		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= "<li><a href='$website_url/$mod/$title/$prev'>Prev</a></li>";
		}else{
			$link_halaman .= "<li class='disabled'><a>Prev</a></li>";
		}

		if($num == "1"){
			$angka = ($halaman_aktif > 3 ? "<li class='disabled'><a>...</a></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= "<li><a href='$website_url/$mod/$title/$i'>$i</a></li>";
			}
			$angka .= "<li class='active'><a>$halaman_aktif</a></li>";
			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= "<li><a href='$website_url/$mod/$title/$i'>$i</a></li>";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? "<li class='disabled'><a>...</a></li><li><a href='$website_url/$mod/$title/$jmlhalaman'>$jmlhalaman</a></li>" : " ");
			$link_halaman .= "$angka";
		}

		if($halaman_aktif < $jmlhalaman){
			$next = $halaman_aktif+1;
			$link_halaman .= "<li><a href='$website_url/$mod/$title/$next'>Next</a></li>";
		}else{
			$link_halaman .= "<li class='disabled'><a>Next</a></li>";
		}
		return $link_halaman;
	}
}
?>