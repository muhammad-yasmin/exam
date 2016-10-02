<?php
$pageheader = "Kartu Soal";
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
  
    <div id="idlistkartusoal">
      <p>Kartu soal digunakan untuk menambah, mengedit, dan menghapus soal.</p>
      <p>
      <button type="button" id="btn_add_data" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i> Tambah</button>
      <button type="button" id="btn_import_data" class="btn btn-info btn-xs btn-flat"><i class="fa fa-download"></i> Import</button>
      </p>
      <div id="animasi_loading" style="display: none;">
          <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
      </div>
      <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" role="tablist">
          <li role="presentation" class="active">
            <a href="#sudah_verf" aria-controls="sudah_verf" role="tab" data-toggle="tab">Sudah terverifikasi</a>
          </li>
          <li role="presentation">
            <a href="#belum_verf" aria-controls="belum_verf" role="tab" data-toggle="tab">Belum terverifikasi</a>
          </li>
        </ul>
        <br>
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="sudah_verf"><div id="div_kartu_soal"></div></div>
          <div role="tabpanel" class="tab-pane" id="belum_verf"><div id="div_belum_verifikasi"></div></div>
        </div>
      </div>

      
    </div>
    <div id="form_kartu_soal" style="display:none;">
      <form role="form"
                id="id_form_tambahubah" name="id_form_tambahubah"
                action="app/pages/models/kartu_soal/tambahubah.php" method="post"
                enctype="multipart/form-data" target="upload_target"
            >
              <input type="hidden" id="i_nama_guru" value="<?php echo $_SESSION['nama_nya']; ?>">
              <input type="hidden" id="jenisproses" name="jenisproses">
              <input type="hidden" id="idprimarykey" name="idprimarykey">
              <div id="div_form_kartu_soal"></div>
            </form>
            <div align="center">
              <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
              <button type="button" id="btn_cancel" class="btn btn-primary">Kembali</button>
            </div>
            <br><br>
            <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
    </div>

    <div id="form_import" style="display:none;">
        <div id="load_download"></div>
        <form role="form"
            id="id_form_import" name="id_form_import"
            action="app/pages/models/kartu_soal/proses_import.php" method="post"
            enctype="multipart/form-data" target="upload_target"
        > 
          <div id="list_import"></div>
        </form>
        <div align="center">
          <button type="button" id="btn_simpan2" class="btn btn-primary">Simpan</button>
          <button type="button" id="btn_cancel2" class="btn btn-primary">Kembali</button>
        </div>
    </div>
  </div>
</div>
<?php require "app/pages/controllers/js.ct_kartu_soal.php"; ?>