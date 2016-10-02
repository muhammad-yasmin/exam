<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];
$penyusun = $_POST['nama_guru'];

?>
<style>
    td{
        padding:1px;
    }
    .tablenya{
        border: 2px solid #3c8dbc;
        border-collapse: collapse;
        width:100%;
        height:75%;
    }
    .tablenya td{
        border: 2px solid #3c8dbc;
        border-collapse: collapse;
        vertical-align: top;
        padding: 10px;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
       <table width="100%">
            <tr>
                <td width="30%" id="label_mapel">Mata Pelajaran</td>
                <td width="10%" align="center">:</td>
                <td width="60%">
                    <?php require "load_mapel.php"; ?>
                </td>
            </tr>
            <tr>
                <td id="label_ki">Kompetensi Inti</td>
                <td align="center">:</td>
                <td>
                    <span id="id_ki"></span>
                    <input type="hidden" id="input_id_kinti" name="input_id_kinti" required>
                    <?php require "load_ki.php"; ?>
                </td>
            </tr>
            <tr>
                <td>Semester</td>
                <td align="center">:</td>
                <td>
                    <select name="input_id_smt" id="input_id_smt" class="form-control" required>
                        <option value="GANJIL">GANJIL</option>
                        <option value="GENAP">GENAP</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2 col-lg-5">
        <table width="100%">
            <tr>
                <td width="30%" id="label_penyusun">Penyusun</td>
                <td width="10%" align="center">:</td>
                <td width="60%">
                    <?php 
                        if($level == 1){
                            $que_guru = $conn->fetch("SELECT g.id_guru, g.nama_guru FROM guru_tabel g WHERE g.id_guru > 0");
                            ?>
                            <select name="input_id_guru" id="input_id_guru" class="form-control" required>
                                <option value="" readonly="true">--Pilih--</option>
                                <?php
                                foreach ($que_guru as $key => $d_guru) {
                                    echo "<option value=".$d_guru['id_guru'].">".$d_guru['nama_guru']."</option>";
                                }
                                ?>
                            </select>
                            <?php
                        }else if($level == 2){
                            ?>
                            <input type="text" class="form-control" disabled="true" value="<?php echo $penyusun; ?>">
                            <input type="hidden" name="input_id_guru" value="<?php echo $id_guru; ?>" required>
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td id="label_bentuk_tes">Bentuk Tes</td>
                <td align="center">:</td>
                <td>
                    <select name="input_id_bentuk_tes" id="input_id_bentuk_tes" class="form-control" required>
                        <option value="">--Pilih--</option>
                        <option value="2">Pil. Ganda 2</option>
                        <option value="3">Pil. Ganda 3</option>
                        <option value="4">Pil. Ganda 4</option>
                        <option value="5">Pil. Ganda 5</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="label_tapel">Tahun Pelajaran</td>
                <td align="center">:</td>
                <td>
                    <?php require "load_tapel.php"; ?>
                </td>
            </tr>
        </table>
    </div>
</div>
<br><br>
<table class="tablenya">
    <tr>
        <td rowspan="2" width="25%" id="label_kd">
            <b>Kompetensi Dasar</b>
            <div id="load_kd_div"></div>
            <br><br>
            <input type="hidden" id="input_id_kdasar" name="input_id_kdasar" required>
            <input type="hidden" id="input_no_kd" required>
            <div id="isi_kd"></div>
        </td>
        <td width="10%" style="height:20px;">
            <b>ID Soal</b><p>
            <div id="div_new_id_soal"></div>
        </td>
        <td id="label_jawaban">
            <b>Kunci Jawaban</b><br>
            <center><div id="jawabannya"><i style="color:#999;">Pilih Bentuk Tes</i></div></center>
        </td>
        <td id="label_buku">
            <b>Buku Sumber</b>
            <?php require "load_buku.php"; ?>
            <br>
            <div id="list_buku"></div>
            <div id="divid_input_buku" style="display:none;">
                <textarea name="nama_new_buku" id="nama_new_buku" style="width: 100%; height: 50px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"required>-</textarea>    
            </div>
            <input type="hidden" name="input_buku" id="input_buku" required>
        </td>
    </tr>
    <tr>
        <td colspan="3" rowspan="3" id="label_soal">
            <b>Rumusan Butir Soal</b>
            <span class="pull-right">
                <a onclick="toggle_audio();" style="cursor: pointer;" class="btn btn-xs btn-info"><i class="fa fa-music"></i> Tambah Audio</a>
                <a onclick="show_bantuan();" style="cursor: pointer;" class="btn btn-xs btn-warning"><i class="fa fa-question"></i> Bantuan</a>
            </span><br><br>
            <div id="div_input_audio" class="form-group" style="display:none;">
                <label for="input_audio">Audio (optional)</label>
                <input type="file" id="input_audio" name="input_audio">
            </div>
            <?php require "load_soal.php"; ?>
        </td>
    </tr>
    <tr>
        <td height="150px" id="label_materi">
            <b>Materi</b>
            <a style="cursor:pointer;" data-toggle="modal" data-target="#modal_materi" onclick="load_data_materi();">(...)</a>
            <br><br>
            <input type="hidden" id="input_id_mteri" name="input_id_mteri" required>
            <div id="isi_materi"></div>
                
                <!-- Modal -->
                <div class="modal fade" id="modal_materi" tabindex="-1" role="dialog" aria-labelledby="modalLabel_materi" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="modalLabel_materi">Materi</h4>
                            </div>
                            <div class="modal-body" id="body_materi">
                                
                            </div>
                            <div class="modal-footer">
                                <button id="btn_simpan_materi" type="button" class="btn btn-flat btn-primary" data-dismiss="modal">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            
        </td>
    </tr>
    <tr>
        <td height="150px" id="label_indikator">
            <b>Indikator Soal</b>
            <br><br>
            <div id="isi_indikator"></div>
        </td>
    </tr>
</table>
<br><br>