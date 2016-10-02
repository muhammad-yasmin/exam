<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_guru = $_SESSION['id_usernya'];
$id_bank = $_POST['id_bank'];

$query_bank = "
SELECT
b.id_bank_soal_ujian,
tp.tahun_ajaran,
b.semester,
n.nama_ujian,
b.tingkat,
b.lama_waktu,
b.aktif_bahas,
m.nama_mapel,
aktivasi_bank_soal.tanggal_aktif,
aktivasi_bank_soal.jam_aktif,
aktivasi_bank_soal.`fullscreen`,
aktivasi_bank_soal.`block_text`,
aktivasi_bank_soal.`focus`
FROM
bank_soal_ujian_tabel AS b
INNER JOIN tahun_ajaran_tabel AS tp ON b.id_tahun_ajaran = tp.id_tahun_ajaran
INNER JOIN nama_ujian_tabel AS n ON b.id_nama_ujian = n.id_nama_ujian
INNER JOIN mapel_tabel AS m ON b.id_mapel = m.id_mapel
LEFT JOIN aktivasi_bank_soal ON b.id_bank_soal_ujian = aktivasi_bank_soal.id_bank_soal_ujian
WHERE b.id_bank_soal_ujian = $id_bank

";
$proses_bank = $conn->fetch($query_bank);
foreach ($proses_bank as $key => $data_bank) {
}
?>
<input type="hidden" id="input_id_bank_soal" name="input_id_bank_soal" value="<?php echo $id_bank; ?>">
	
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    	
	    <div class="panel panel-default">
	    	<div class="panel-body">
	    		<table width="100%" style="font-size:14px;">
	    			<tr><td>Tahun Ajaran</td><td>: <?php echo $data_bank['tahun_ajaran']; ?></td></tr>
	    			<tr><td>Semester</td><td>: <?php echo $data_bank['semester']; ?></td></tr>
	    			<tr><td>Nama Ujian</td><td>: <?php echo $data_bank['nama_ujian']; ?></td></tr>
	    			<tr><td>Tingkat</td><td>: <?php echo $data_bank['tingkat']; ?></td></tr>
	    		</table>
	    		<br>
	    		<div id="divid_lama_waktu" class="form-group">
	    			<label id="label_id_lama_waktu">Lama Waktu</label>
					<div class="input-group">
					    <input type="number" id="input_id_lama_waktu" name="input_id_lama_waktu" value="<?php echo $data_bank['lama_waktu']; ?>" class="form-control">
					    <span class="input-group-addon">menit</span>
					</div>
	    		</div>
				<div id="divid_tanggalaktif" class="form-group">
					<label for="input_id_tanggalaktif">Tanggal Aktif</label>
					<div class="input-group date" id="datetimepicker1">
						<?php 
							if($data_bank['tanggal_aktif'] !== null && $data_bank['jam_aktif'] !== null){
								$tgl = explode("-", $data_bank['tanggal_aktif']);
								$jam = explode(":", $data_bank['jam_aktif']);

								$hari = $tgl[2];
								$bulan = $tgl[1];
								$tahun = $tgl[0];
								$hour = $jam[0];
								$menit = $jam[1];

								$tgl_jadi = $hari."/".$bulan."/".$tahun." ".$hour.":".$menit;
							}else{
								$tgl_jadi = 0;
							}
						?>
						<input type="text" class="form-control" id="input_id_tanggalaktif" name="input_id_tanggalaktif"
							value="<?php echo $tgl_jadi; ?>">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<div id="divid_aktif_bahas" class="form-group">
	    			<label id="label_id_aktif_bahas" for="input_aktif_bahas">Pembahasan</label>
					<select name="input_aktif_bahas" id="input_aktif_bahas" class="form-control">
						<option value="tidak" <?php if($data_bank['aktif_bahas'] == 'tidak'){ ?> selected <?php } ?>>Nonaktif</option>
						<option value="ya" <?php if($data_bank['aktif_bahas'] == 'ya'){ ?> selected <?php } ?> >Aktif</option>
					</select>
	    		</div>
	    		<div id="opsi_setting">
	    			<label id="label_opsi_setting">Opsi Ujian</label>
	    			<ul class="list-group">
	    				<li class="list-group-item">
	    					<div class="checkbox">
	    						<label>
	    							<input type="checkbox" value="1" name="input_id_fullscreen" <?php if($data_bank['fullscreen'] == 1){ ?> checked='true' <?php } ?>>
	    							Fullscreen
	    						</label>
	    						<label>
	    							<input type="checkbox" value="1" name="input_id_block_text" <?php if($data_bank['block_text'] == 1){ ?> checked='true' <?php } ?>>
	    							Disable Block Text
	    						</label>
	    						<label>
	    							<input type="checkbox" value="1" name="input_id_focus" <?php if($data_bank['focus'] == 1){ ?> checked='true' <?php } ?>>
	    							Focus
	    						</label>
	    					</div>
	    				</li>
	    			</ul>
	    		</div>
	    		<div align="center">
    		
		          <a href="app/pages/print.php?id=<?php echo $id_bank; ?>" target="upload_target" id="btn_cetak" class="btn btn-default"><i class="fa fa-print"></i> Print Bank Soal</a>
		         
		        </div>
	    	</div>
	    </div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
		<legend>Preview Soal <?php echo $data_bank['nama_mapel']; ?></legend><hr>
		<?php require "load_kartu.php"; ?>
	</div>

<script>
	$(document).ready(function() {
		$("#datetimepicker1").datetimepicker({
			format: 'DD/MM/YYYY HH:mm'
		});
	});
</script>