<?php
$pageheader = "Hasil Ujian Siswa";
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

      <div id="list_siswa"> 
      <form role="form"
            id="id_form_print" name="id_form_print"
            action="app/pages/models/hasil_ujian_siswa/print.php" method="post"
            enctype="multipart/form-data" target="upload_target"
        >
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
          <div class="panel panel-default">
            <div class="panel-body">
               <div id="set_siswa"></div>
               <input type="hidden" id="input_id_siswa" name="input_id_siswa" value="">
            </div>
          </div>
          
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
          <div id="idlisthasilujian">
            <div id="animasi_loading" style="display: none;">
                <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
            </div>
            <div id="div_list"></div>
          </div>
        </div>
      </form>
      <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
      </div>

      <div id="list_nilai" style="display:none;">
        <div id="load_nilai"></div>
        <div align="center">
          <button type="button" id="btn_cetak" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
          <button type="button" id="btn_cancel" class="btn btn-primary" onclick="goto_list_siswa();">Kembali</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require "app/pages/controllers/js.ct_hasil_ujian_siswa.php"; ?>