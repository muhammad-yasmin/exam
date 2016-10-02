<?php
date_default_timezone_set('Asia/Jakarta');
function cek_login($user,$pass){
  //----------------------------------------------
  require "../../../../config/classDB.php";
  $conn = new Database();
  //----------------------------------------------
  $var1 = $user;
  $var2 = md5("pass".$pass."word");

  $prosesnya1 = $conn->fetch("SELECT * FROM guru_tabel WHERE guru_tabel.nomor='$var1' AND guru_tabel.password='$var2'");
  $jml1 = count($prosesnya1);
  if($jml1 == 1){
      foreach ($prosesnya1 as $key => $info) {
        $nomornya = $info['nomor'];
        $_SESSION['id_usernya'] = $info['id_guru'];
        $_SESSION['no_user'] = $info['nomor'];
        $_SESSION['nama_nya'] = $info['nama_guru'];
        $_SESSION['password_nya'] = $info['password'];
        $_SESSION['level_nya'] = $info['level'];
        $level = $info['level'];
      }

      if($_SESSION['level_nya'] == 1){
        $cek_log = 1;
      }else{
        $cek_log = cek_log_activity($nomornya,$level);
      }
      
  }else{
      echo $qwery = "SELECT * FROM siswa_tabel WHERE nomor='$var1' AND password='$var2'";
      $prosesnya2 = $conn->fetch($qwery);
      $jml2 = count($prosesnya2);
      if($jml2 == 1){
          foreach ($prosesnya2 as $key => $info) {
            $nomornya = $info['nomor'];
            $_SESSION['id_usernya'] = $info['id_siswa'];
            $_SESSION['no_user'] = $info['nomor'];
            $_SESSION['nama_nya'] = $info['nama_siswa'];
            $_SESSION['password_nya'] = $info['password'];
            $_SESSION['level_nya'] = $info['level'];
            $level = $info['level'];
          }
          $cek_log = cek_log_activity($nomornya,$level);
      }else{
          $cek_log = "Username atau Password salah !";
      }
  }

  if($cek_log == 1){
    $_SESSION['cekloginsukses_ujian'] = true;
    $array_info = [
                'id_usernya'=>$_SESSION['id_usernya'],
                'no_user'=>$_SESSION['no_user'],
                'nama_nya'=>$_SESSION['nama_nya'],
                'password_nya'=>$_SESSION['password_nya'],
                'level_nya'=>$_SESSION['level_nya']
                ];
    $arr = json_encode($array_info);
    setcookie('info_user', $arr, time() + (86400 * 30), "/");
    setcookie('cekloginsukses_ujian', true, time() + (86400 * 30), "/");
    ?><script>window.top.window.hasil_login('berhasil');</script><?php
  }else{
    $_SESSION['cekloginsukses_ujian'] = false;
    setcookie('cekloginsukses_ujian', false, time() + (86400 * 30), "/");
    ?><script>window.top.window.hasil_login('<?php echo $cek_log; ?>');</script><?php
  }

}

function cek_log_activity($nomor_user,$level){
  //----------------------------------------------
  $conn2 = new Database();
  //----------------------------------------------
  setlocale(LC_TIME, 'INDONESIA');
  $query = $conn2->fetch("SELECT * FROM log_activities WHERE nomor_user='$nomor_user'");
  $nums = count($query);
  if($nums == 1){
    //jika ada, maka user masih dipakai
    return "User masih dipakai !";
  }else{
    //jika tidak ada, maka insert log_activities
    $values = array('nomor_user'=>$nomor_user, 'level'=>$level, 'waktu_login'=>date('Y-m-d H:i:s'), 'status'=>'on');
    $query = $conn2->insert("log_activities", $values);
    return $query;
  }
}

$user = $_POST['user'];
$pass = $_POST['pass'];
cek_login($user,$pass);




?>