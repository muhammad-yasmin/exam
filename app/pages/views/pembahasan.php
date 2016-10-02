<?php
$pageheader = "Hasil Ujian";
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

    <div id="list_ujian">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Hasil Ujian</div>
        </div>
        <div class="panel-body">
           <div id="animasi_loading" style="display: none;">
              <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
          </div>
          <div id="div_ujian"></div>
        </div>
      </div>
      
    </div>
    
  </div>
</div>
<?php require 'app/pages/controllers/js.ct_hasil_dan_pembahasan.php'; ?>