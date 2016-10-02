<div class="container">
    <div class="col-md-6">
        <label for="mapel">Pilih Mata Pelajaran</label>
        <select name="mapel" id="mapel" class="form-control">
            <option value="">-- Pilih Mata Pelajaran --</option>
            <?php
            require_once('../../../../config/classDB.php');
            $conn = new Database;
            $query = $conn->fetch("SELECT mapel_tabel.id_mapel, mapel_tabel.nama_mapel FROM mapel_tabel");
            foreach($query as $result){
                ?>
                <option value="<?php echo $result['id_mapel']; ?>"><?php echo $result['nama_mapel']; ?></option>
                <?php
            }
            ?>
        </select>

        <label for="jumlah_soal">Jumlah Soal</label>
        <input type="text" id="jumlah_soal" name="jumlah_soal" class="form-control" autocomplete="off" placeholder="Jumlah Soal">

        <label for="jumlah_opsi">Pilih Jumlah Opsi</label>
        <select name="jumlah_opsi" id="jumlah_opsi" class="form-control">
            <option value="">-- Pilih Jumlah Opsi --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="a_id_download">Download Format .xls</label><br>
        <button class="btn btn-md btn-default" onclick="genTemplate();"><i class="fa fa-cog"></i> Buat</button>
        <a id="a_id_download" href="dist/file/format_excel/import_soal.xls" target="_blank" class="btn btn-md btn-warning"><i class="fa fa-download"></i> Download disini..</a>
    </div>
</div>