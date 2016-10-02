<?php
date_default_timezone_set('Asia/Jakarta');
require_once 'config/classDB.php';

class App
{
	protected $controller;

	public function __construct()
	{
		$conn = new Database();

		$base_url   = 'http://'.$_SERVER['SERVER_NAME'].'/examutama';
		$url = $this->parseUrl();
		$menu = (isset($url[0]))? $url[0] : 'beranda';

		if(isset($_COOKIE['info_user'])){
			$info = json_decode(stripslashes($_COOKIE['info_user']),true);
			$_SESSION['id_usernya'] = $info['id_usernya'];
            $_SESSION['no_user'] = $info['no_user'];
            $_SESSION['nama_nya'] = $info['nama_nya'];
            $_SESSION['password_nya'] = $info['password_nya'];
            $_SESSION['level_nya'] = $info['level_nya'];
		}

		if(isset($_SESSION['no_user'])){
			if($_SESSION['level_nya'] == 1){
				$status_log = "on";
			}else{
				$nomornya = $_SESSION['no_user'];
				$query_cek_log = $conn->fetch("SELECT * FROM log_activities WHERE nomor_user='$nomornya'");
				$num_cek_log = count($query_cek_log);
				if($num_cek_log > 0){
					$status_log = "on";
				}else{
					$status_log = "off";
				}
			}
		}else{
			$status_log = "off";
			$nomornya = "";
		}

		if($menu == 'logout'){
			$_SESSION['cekloginsukses_ujian'] = false;
			setcookie('cekloginsukses_ujian', "", time() - (86400 * 30), "/");
			if($_SESSION['level_nya'] !== 1){
				$where = array('nomor_user'=>$nomornya);
				$conn->delete("log_activities", $where);
			}
			setcookie('info_user', "", time() - (86400 * 30), "");
            header("location: ./");
		}

		$theme = $conn->fetch("SELECT * FROM tema");
		//print_r($theme);
		foreach ($theme as $key => $val) {
			$icon_project	= $val['icon'];
			$logo_project	= $val['logo'];
			$nama_instansi 	= $val['nama_instansi'];
		}

		//cek log

		
		//-------

		$title_project 	= "Ujian Online";
		if($status_log == "on"){
			if($menu == 'jendela_ujian'){
				//cek jika masih proses ujian
	            $cek_ujian = $conn->fetch("SELECT * FROM log_activities WHERE nomor_user='$nomornya' AND ujian='selesai'");
	            if(count($cek_ujian) > 0){
	                ?><script>location.replace("<?php echo $base_url."/hasil"; ?>");</script><?php
	            }else{
	              $id_bank_ujian = (isset($url[1]))? $url[1] : 'not_found';
					include_once("ujian/jendela_ujian.php");
	            }
				
			}else if($menu == 'jendela_pembahasan'){
				$id_bank_ujian = (isset($url[1]))? $url[1] : 'not_found';
				include_once("pembahasan/jendela_pembahasan.php");
			}else if($menu == 'user_log_mobile'){
				include_once("user_log_mobile/check.browser.php");
			}
			else{
				if(isset($_COOKIE['cekloginsukses_ujian']) && $_COOKIE['cekloginsukses_ujian'] == 1){
			        $status_login = true;
			        if($_SESSION['level_nya'] == 1) {
			            $title = "Admin";
			            
			        }elseif($_SESSION['level_nya'] == 2){
			            $title = "Guru";
			        }else{
			            $title = "Siswa";
			            $nomor_user = $_SESSION['no_user'];
			        }
			        $name = $_SESSION['nama_nya'];
			    }else{
			        $status_login = false;
			    }
			    include_once("pages/index.php");
			}
		}else{
			$status_login = false;
			if($menu == 'user_log_mobile'){
				include_once("user_log_mobile/check.browser.php");
			}else{
				include_once("pages/index.php");
			}
			
		}
		
		
	}

	public function parseUrl()
	{
		if(isset($_GET['url']))
		{
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}
?>