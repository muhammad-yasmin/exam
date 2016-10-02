<?php
$pageheader = "Materi Pokok";
$nama_folder = "materi";
?> 

<!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1><?php echo $pageheader; ?></h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                        <li><a href="./beranda">Beranda</a></li>
                        <li class="active"><?php echo $pageheader; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
<div class="section">
  <div class="container">
    <div id="materi">
      <p>Materi Pokok adalah kumpulan bab-bab atau informasi yang berhubungan dengan kompetensi dasar.</p>
      <div id="animasi_loading" style="display: none;">
          <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
      </div>
      <div id="div_data_materi">
              <!-- DATA KOMPETENSI DASAR -->
      </div>
    </div>

    <div id="materi_list" style="display:none;">
      <p id="p_kd">coba</p>
      <p>
      <button type="button" onclick="goto_list_materi();" class="btn btn-xs btn-flat"><i class="fa fa-arrow-left"></i> Kembali</button>
      <button type="button" id="btn_add_data" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i> Tambah</button>
      </p>
      <div id="animasi_loading" style="display: none;">
          <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
      </div>
      <input type="hidden" id="id_kd_sementara">
      <div id="div_data_list_materi"></div>
    </div>

    <div id="form_tambahubah" style="display:none;">
                <form role="form"
                    id="id_form_tambahubah" name="id_form_tambahubah"
                    action="app/pages/models/materi/tambahubah.php" method="post"
                    enctype="multipart/form-data" target="upload_target"
                >
                  <input type="hidden" id="jenis_proses" name="jenis_proses" value="">
                  <input type="hidden" id="idprimarykey" name="idprimarykey" value="">
                  <div id="list_input_biasa"></div>
                  <div id="list_input_edit"></div>
                </form>
            <div class="row">
              <div align="center">
                <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
                <button type="button" id="btn_cancel" class="btn btn-primary">Kembali</button>
              </div>
            </div>
            <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
    </div>
  </div>
</div>
<?php require "app/pages/controllers/js.materict.php"; ?>
   