<?php
$pageheader = "Data Guru";
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
  
    <div id="idlistguru" >
       <p>Data Guru adalah informasi atau profil mengenai nip, nama, dan jenis kelamin.</p>
       <p>
      <button type="button" id="btn_add_data" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i> Tambah</button>
      <button type="button" id="btn_import_data" class="btn btn-info btn-xs btn-flat"><i class="fa fa-download"></i> Import</button>
      </p>
      <div id="animasi_loading" style="display: none;">
          <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
      </div>
      <div id="div_data_guru"></div>
    </div>
    <div id="form_tambahubah" style="display:none;">
          
                <form role="form"
                    id="id_form_tambahubah" name="id_form_tambahubah"
                    action="app/pages/models/guru/tambahubah.php" method="post"
                    enctype="multipart/form-data" target="upload_target"
                >
                  <input type="hidden" id="jenis_proses" name="jenis_proses" value="">
                  <input type="hidden" id="idprimarykey" name="idprimarykey" value="">
                  <input type="hidden" id="hasilceknip" name="hasilceknip" value="benar">
                  <div id="list_input_biasa"></div>
                </form>
            

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div id="pesan_alert_form" style="display:none;">
                        <div class="alert alert-danger">
                            <p id="isi_pesan_alert_form">isi...</p>
                        </div>
                    </div>
                  </div>
                </div>
                
            <div align="center">
              <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
              <button type="button" id="btn_cancel" class="btn btn-primary">Kembali</button>
            </div>
            <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
    </div>
    <div id="form_import" style="display:none;">
        <form role="form"
            id="id_form_import" name="id_form_import"
            action="app/pages/models/guru/proses_import.php" method="post"
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
<?php require "app/pages/controllers/js.ct_guru.php"; ?>