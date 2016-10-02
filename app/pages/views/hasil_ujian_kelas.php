<?php
$pageheader = "Hasil Ujian Kelas";
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
          id="id_form_print" name="id_form_print"
          action="app/pages/models/hasil_ujian_kelas/print.php" method="post"
          enctype="multipart/form-data" target="upload_target"
      >
      <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
        
        <div class="panel panel-default">
          <div class="panel-body">
             <div id="set_hasilujian"></div>
             <div align="center">
                <button type="button" id="btn_cetak" class="btn btn-default"><i class="fa fa-print"></i> Print</button>  
              </div>
          </div>
        </div>
        
      </div>
      <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
        <div id="idlisthasilujian">
          <div id="animasi_loading" style="display: none;">
              <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
          </div>
          <div id="div_data_hasilujian"></div>
        </div>
      </div>
    </form>
    <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
  </div>
</div>
<?php require "app/pages/controllers/js.ct_hasil_ujian_kelas.php"; ?>