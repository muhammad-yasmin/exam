<?php
$pageheader = "Kotak Pesan";
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
  
    <div id="list_materi">
      <p>Kotak Pesan adalah kritik dan saran yang ditulis pengunjung untuk memperbaiki website agar lebih sempurna.</p>
      <div id="animasi_loading" style="display: none;">
          <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
      </div>
      <div id="div_materi"></div>
    </div>
    
    <div id="show_file" style="display:none;">
      <div id="div_show_file" class="unselectable">

      </div>
       <div class="row" align="center">
          <button type="button" id="btn_cancel2" class="btn btn-primary">Kembali</button>
      </div>
      </div>

    </div>
  </div>
<?php require "app/pages/controllers/js.ct_kotak_pesan.php"; ?>