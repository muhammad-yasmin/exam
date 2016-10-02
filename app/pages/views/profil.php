<?php
$pageheader = "Profil";
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
    <form role="form"
            id="id_form_edit" name="id_form_edit"
            action="app/pages/models/profil/edit_data.php" method="post"
            enctype="multipart/form-data" target="upload_target"
        >
                
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" align="center">
          <div id="divid_foto_profil"></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
          <div id="divid_data_profil"></div>
          <input type="hidden" id="status_pass" name="status_pass" value="tetap">
          <input type="hidden" id="i_cek_passlama" name="i_cek_passlama">
          <div id="div_ganti_pass" style="display: none;">
            <legend>Ganti Password</legend>
            <div class="panel panel-default bg-white">
                <div class="panel-body">
                        <div id="divid_passlama" class="form-group">
                            <label for="input_passlama">Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="input_passlama" name="input_passlama" onkeyup="cek_passlama();">
                                <div class="input-group-addon" id="pesan_passlama"><i class="fa fa-question"></i></div>
                            </div>
                        </div>
                        <div id="divid_passbaru" class="form-group">
                            <label for="input_passbaru">Password Baru</label>
                            <input type="password" class="form-control" id="input_passbaru" name="input_passbaru">
                        </div>
                        <div id="divid_passbaru_conf" class="form-group">
                            <label for="input_passbaru_conf">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="input_passbaru_conf" name="input_passbaru_conf" onkeyup="konfirmasi_pass();">
                                <div class="input-group-addon" id="pesan_passbaru_conf"><i class="fa fa-question"></i></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
          <div align="center">
              <button type="button" id="btn_simpan" class="btn btn-primary" onclick="form_submit();">Simpan</button>
            </div>
        </div>

    </form>
    
    <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe> 
  </div>
</div>

<?php require "app/pages/controllers/js.ct_profil.php"; ?>