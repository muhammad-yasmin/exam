<?php
//----------------------------------------------
require "../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$base_url   = $_POST['base_url'];

$icon_project = $_POST['ic_project'];
$nama_instansi = $_POST['nm_instansi'];
$id_siswa = $_POST['input_id_siswa'];
$id_bank_soal = $_POST['input_id_bank'];
$jml_soal = $_POST['input_jumlah_soal'];
$peringatan = $_COOKIE['count_foul'];

$query_siswa = "SELECT siswa_tabel.* FROM siswa_tabel WHERE id_siswa = '$id_siswa'";
  $proses_siswa = $conn->fetch($query_siswa);
  foreach ($proses_siswa as $key => $result_siswa) {
    $NIS    = $result_siswa['nomor'];
    $NamaSiswa   = $result_siswa['nama_siswa'];
  }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../<?php echo $icon_project; ?>">

    <title>
      Hasil Ujian
    </title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/buat_ujian/css/bootstrap.min.css" rel="stylesheet">

    <!--external css-->
    <link href="../../dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../dist/buat_ujian/css/css_ujian.css">

  </head>
  <body>


    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#">ID SOAL : <?php echo $id_bank_soal; ?></a>
        </div>
      </div>
    </nav>
    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle btn btn-primary" onclick="tutup_ujian();">Keluar</button>
          <a class="navbar-brand" href="#"><?php echo $nama_instansi; ?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-right">
            <button type="button" id="tombol_keluar" class="btn btn-primary" onclick="tutup_ujian();">Keluar</button>
          </form>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
    <div id="content_page">
    	<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2" align="center">

								<h4>Terima kasih, Anda telah mengerjakan ujian ini. <i class="fa fa-thumbs-o-up fa-2x"></i></h4>
                    			<i style="color:#F64747;">*Jika nilai Anda kurang, silahkan menghubungi guru masing-masing.</i>
							</div>
						</div>
        <div class="container" id="main_content" style="margin-top:10px;">
        	<div class="dragend-page">
        		<div class="panel panel-default">
	        		<div class="panel-heading">
	    				<div class="panel-title">Penilaian Total</div>
	    			</div>
	        		<div class="panel-body">
	        			<?php

						$yang_benar = 0;
						$yang_salah = 0;
						$yang_tidak_dijawab = 0;
						$nilai = 0;
						$array_id_kartu = [];

						//SELECT
						$load_kartu = $conn->fetch("SELECT b.id_kartu_soal FROM isi_soal_tabel b WHERE id_bank_soal_ujian='$id_bank_soal'");
						foreach ($load_kartu as $key => $res) {

							$k = $res['id_kartu_soal'];
							array_push($array_id_kartu, $k);

							$q_jwb_db	= $conn->fetch("SELECT s.jawaban FROM draft_kartu_tabel d INNER JOIN soal_tabel s 
														ON d.id_soal=s.id_soal WHERE d.id_kartu_soal = '$k'");

							foreach ($q_jwb_db as $key => $res_jwb) {
								$jawaban_db	= strtolower($res_jwb['jawaban']);
							}
							
							$jawaban_user 	= $_COOKIE['soal'.$id_bank_soal.'_'.$k];

							//echo $jawaban_db." ".$jawaban_user."<br>";
							
							if(!isset($jawaban_user)){
								$yang_tidak_dijawab++;
							}else{
								if($jawaban_user == $jawaban_db){
							    	$yang_benar++;
							    }else{
							    	$yang_salah++;
							    }
							}
						}

						//Rumusnya
						$nilai = ($yang_benar/$jml_soal) * 100;
						?>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								
								<div class="table-responsive">
									<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th rowspan="2" width="20%">NIS</th>
												<th rowspan="2" width="30%">Nama</th>
												<th colspan="3">Jumlah Soal</th>
												<th rowspan="2" width="20%">Nilai</th>
											</tr>
											<tr>
												<th width="10%">Benar</th>
												<th width="10%">Salah</th>
												<th width="10%">Kosong</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td align="center"><?php echo $NIS; ?></td>
												<td><?php echo $NamaSiswa; ?></td>
												<td align="center"><?php echo $yang_benar; ?></td>
												<td align="center"><?php echo $yang_salah; ?></td>
												<td align="center"><?php echo $yang_tidak_dijawab; ?></td>
												<td align="center"><b><?php echo $nilai; ?></b></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
	        		</div>
	        		<div class="panel-footer">
	                    <div class="pull-right">
	                      <button type="button" class="btn btn-sm btn-flat" onclick="tab_panel('left')">Penilaian per KD</button>
	                    </div>
	                    <div class="clearfix"></div>
	                  </div>
	        	</div>
        	</div>
        	<div class="dragend-page">
        		<div class="panel panel-default">
	        		<div class="panel-heading">
	    				<div class="panel-title">Penilaian per Kompetensi Dasar</div>
	    			</div>
	        		<div class="panel-body">
	        			<?php
						//Penilaian per KD
						$hitung_kd = $conn->fetch("SELECT DISTINCT id_kompetensi_dasar FROM isi_soal_tabel WHERE id_bank_soal_ujian = '$id_bank_soal' ORDER BY id_kompetensi_dasar ASC");
						?>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									
									<div class="table-responsive">
										<table class="table table-hover table-bordered">
											<thead>
												<tr>
													<th rowspan="2" width="10%">KD</th>
													<th colspan="3">Jumlah Soal</th>
													<th rowspan="2" width="10%">Total Soal</th>
													<th rowspan="2" width="10%">Nilai</th>
												</tr>
												<tr>
													<th width="10%">Benar</th>
													<th width="10%">Salah</th>
													<th width="10%">Kosong</th>
												</tr>
											</thead>
											<tbody>
												<?php
						foreach ($hitung_kd as $key => $kd) {
							
							//hitung nilai per kd
							$yang_benar_kd = 0;
							$yang_salah_kd = 0;
							$yang_tidak_dijawab_kd = 0;
							$nilai_kd = 0;
							$array_id_kartu_kd = [];

							//SELECT
							$id_kd = $kd['id_kompetensi_dasar'];
							$proses_hitung = $conn->fetch("SELECT id_kartu_soal FROM isi_soal_tabel WHERE id_bank_soal_ujian = '$id_bank_soal' AND id_kompetensi_dasar = '$id_kd'");
							$jml_soal_kd = count($proses_hitung);
							foreach ($proses_hitung as $key => $res) {

								$k = $res['id_kartu_soal'];
								array_push($array_id_kartu_kd, $k);

								$q_jwb_db	= $conn->fetch("SELECT s.jawaban FROM draft_kartu_tabel d INNER JOIN soal_tabel s 
															ON d.id_soal=s.id_soal WHERE d.id_kartu_soal = '$k'");

								foreach ($q_jwb_db as $key => $res_jwb) {
									$jawaban_db	= strtolower($res_jwb['jawaban']);
								}
								
								$jawaban_user 	= $_COOKIE['soal'.$id_bank_soal.'_'.$k];

								//echo $jawaban_db." ".$jawaban_user."<br>";
								
								if(!isset($jawaban_user)){
									$yang_tidak_dijawab_kd++;
								}else{
									if($jawaban_user == $jawaban_db){
								    	$yang_benar_kd++;
								    }else{
								    	$yang_salah_kd++;
								    }
								}
							}

							//Rumusnya
							$nilai_kd = ($yang_benar_kd/$jml_soal_kd) * 100;
							$no_kd = $conn->fetch("SELECT no_kd FROM kompetensi_dasar_tabel WHERE id_kompetensi_dasar='$id_kd'");
							
							?>
								<tr>
													<td align="center"><?php echo "3.".$no_kd[0]['no_kd']; ?></td>
													<td align="center"><?php echo $yang_benar_kd; ?></td>
													<td align="center"><?php echo $yang_salah_kd; ?></td>
													<td align="center"><?php echo $yang_tidak_dijawab_kd; ?></td>
													<td align="center"><?php echo $jml_soal_kd; ?></td>
													<td align="center"><b><?php echo $nilai_kd; ?></b></td>
												</tr>
							<?php
						}

						?>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
	        		</div>
	        		<div class="panel-footer">
	                    <div class="pull-right">
	                      <button type="button" class="btn btn-sm btn-flat" onclick="tab_panel('right')">Penilaian Total</button>
	                    </div>
	                    <div class="clearfix"></div>
	                  </div>
	        	</div>
        	</div>
        	

		</div>
	</div>

	
	<script src="../../dist/buat_ujian/js/jquery.min.js"></script>
    <script src="../../dist/buat_ujian/js/bootstrap.min.js"></script>
    <script src="../../plugins/dragend/dragend.min.js"></script>
    <script src="../../plugins/jQueryUI/jquery-ui-1.10.3.min.js"></script>
    <?php require "../../app/ujian/ct_cookie.php"; ?>
    <script>
    	$(document).ready(function() {
			$("#main_content").dragend();
		});
		function tab_panel(arah) {
			$("#main_content").dragend(arah);
		}
		function delete_cookies_jawaban(bank,kartu,id_soal){
			eraseCookie('CookieKartu');
	        eraseCookie('soal'+bank+'_'+kartu);
	        if(readCookie("audio_cookie_"+id_soal)){
	        	eraseCookie("audio_cookie_"+id_soal);
	        }
	        if(readCookie("count_foul")){
	        	eraseCookie("count_foul");
	        }
	    }
	    function tutup_ujian(){
		    window.location = "<?php echo $base_url."/ujian"; ?>";
		}
    </script>
    <?php
    $cek_ujian = $conn->fetch("SELECT * FROM log_activities WHERE nomor_user='$NIS' AND ujian='selesai'");
	            if(count($cek_ujian) > 0){
	                ?><script>location.replace("<?php echo $base_url."/hasil"; ?>");</script><?php
	            }else{
	            	$query_kkm = $conn->fetch("SELECT * FROM pengaturan_nilai_tabel WHERE id_bank_soal_ujian='$id_bank_soal'");

	foreach ($query_kkm as $key => $kkm) {
		$NilaiMin = $kkm['nilai_minimal'];
	}

	if($nilai >= $NilaiMin){
		$keterangan = "LULUS";
	}else{
		$keterangan = "REMIDI";
	}

	//cek exists data hasil ujian
	$cek_hasil = $conn->fetch("SELECT * FROM bank_hasil_ujian_tabel WHERE id_siswa='$id_siswa' AND id_bank_soal_ujian='$id_bank_soal'");
	$nums_cek_hasil = count($cek_hasil);
	//---------------------------
	if($nums_cek_hasil > 0){
		//jika ada, cukup diupdate datanya
		$set = array('jml_soal_benar'=>$yang_benar,
					'jml_soal_salah'=>$yang_salah,
					'jml_soal_kosong'=>$yang_tidak_dijawab,
					'skor_nilai'=>$nilai,
					'keterangan'=>$keterangan,
					'peringatan'=>$peringatan);
		$where = array('id_siswa'=>$id_siswa,
					'id_bank_soal_ujian'=>$id_bank_soal);
		$proses_hasil = $conn->update('bank_hasil_ujian_tabel', $set, $where);
	}else{
		//jika tidak ada, insert data
		$values = array('id_siswa'=>$id_siswa,
						'id_bank_soal_ujian'=>$id_bank_soal,
						'tgl_ujian'=>date('Y-m-d'),
						'jml_soal_benar'=>$yang_benar,
						'jml_soal_salah'=>$yang_salah,
						'jml_soal_kosong'=>$yang_tidak_dijawab,
						'skor_nilai'=>$nilai,
						'keterangan'=>$keterangan,
						'peringatan'=>$peringatan);
		$proses_hasil = $conn->insert('bank_hasil_ujian_tabel', $values);
	}


	if($proses_hasil){
		
		foreach ($array_id_kartu as $kartu) {
			$jawaban = $_COOKIE['soal'.$id_bank_soal.'_'.$kartu];
			//cek exists pilihan jawaban
			$cek_pilihan = $conn->fetch("SELECT * FROM pilihan_jawab_tabel WHERE id_siswa='$id_siswa' AND id_bank_soal_ujian='$id_bank_soal' AND id_kartu_soal='$kartu'");
			$nums_cek_pilihan = count($cek_pilihan);
			//---------------------------
			if($nums_cek_pilihan > 0){
				$set = array('jawaban'=>$jawaban);
				$where = array('id_siswa'=>$id_siswa, 'id_bank_soal_ujian'=>$id_bank_soal, 'id_kartu_soal'=>$kartu);
				$query_jawaban = $conn->update('pilihan_jawab_tabel', $set, $where);
			}else{
				$values2 = array('id_siswa'=>$id_siswa, 'id_bank_soal_ujian'=>$id_bank_soal, 'id_kartu_soal'=>$kartu,'jawaban'=>$jawaban);
				$query_jawaban = $conn->insert('pilihan_jawab_tabel', $values2);
			}

			$set = array("ujian"=>"selesai");
			$where = array("nomor_user"=>$_SESSION['no_user']);
			$update_log = $conn->update("log_activities", $set, $where);
			
			//Tambah poin pada opsi
			$query_id_soal = $conn->fetch("SELECT id_soal FROM draft_kartu_tabel WHERE id_kartu_soal='$kartu'");
			foreach ($query_id_soal as $key => $vl) {
				//echo "opsi_".$jawaban."_tabel id_soal: ".$vl['id_soal']." +1 <br>";
				$conn->custom("UPDATE opsi_".$jawaban."_tabel SET skor = skor + 1 WHERE id_soal='".$vl['id_soal']."'");
				$IdSoal = $vl['id_soal'];
			}

			?>
			<script>
				delete_cookies_jawaban(<?php echo $id_bank_soal; ?>,<?php echo $kartu; ?>,<?php echo $IdSoal; ?>);
			</script>
			<?php
		}
	}else{
		?>
		<script>
			alert("gagal");
		</script>
		<?php
	}
	            }
	
	
	?>
</body>
</html>
