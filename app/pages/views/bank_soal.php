<?php
$pageheader = "Bank Soal Ujian";
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
  
    <div id="list_bank_soal">
      <p>Bank soal ujian digunakan untuk mengumpulkan beberapa kartu soal yang telah dibuat.</p>
      <p>
      <button type="button" id="btn_add_data" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i> Tambah</button>
      </p>
      <div id="animasi_loading" style="display: none;">
          <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
      </div>
      <div id="div_bank_soal"></div>
    </div>
    <div id="form_bank_soal" style="display:none;">
      <form role="form"
                    id="id_form_tambahubah" name="id_form_tambahubah"
                    action="app/pages/models/bank_soal/tambahubah.php" method="post"
                    enctype="multipart/form-data" target="upload_target"
                >
                  <div id="div_form_bank_soal"></div>
                </form>
                <br><br>
            <div align="center">
              <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
              <button type="button" id="btn_cancel" class="btn btn-primary">Kembali</button>
            </div>
            <br>
            <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
    </div>
  </div>
</div>
<?php require "app/pages/controllers/js.ct_bank_soal.php"; ?>