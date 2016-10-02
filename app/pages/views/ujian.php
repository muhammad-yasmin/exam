<?php
$pageheader = "Ujian";
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
          <div class="panel-title">
            Ujian Sekarang 
            <span class="pull-right">
              <?php 
              $arr_day = ['Sun'=>'Minggu', 'Mon'=>'Senin', 'Tue'=>'Selasa', 'Wed'=>'Rabu', 'Thu'=>'Kamis', 'Fri'=>'Jumat', 'Sat'=>'Sabtu'];
              
              $hari = $arr_day[date("D")];
              echo $hari.", ".date("d-m-Y"); 
              ?>
            </span>
          </div>
        </div>
        <div class="panel-body">
           <div id="animasi_loading" style="display: none;">
              <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
          </div>
          <div id="div_ujian"></div>
        </div>
      </div>
      
    </div>
    <div id="divid_halaman_pass" style="display:none;">
      <form role="form"
                      id="form_password_mulai_ujian" name="form_password_mulai_ujian"
                      action="app/pages/models/ujian/cek_password.php" method="post"
                      enctype="multipart/form-data" target="upload_target"
                  >
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="div_aturan_ujian">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div >
                        <h3 class="text-center">Aturan Ujian</h3>
                        <ul>
                          <li>Jika menggunakan <b>laptop</b>, harap cek kapasitas baterai anda.</li>
                          <li><b>Nonaktifkan</b> aplikasi yang dapat mengganggu aktifitas ujian.</li>
                          <li style="color:#E74C4C;"><b>Peringatan!</b> Selama ujian berlangsung, diharapkan <b>tidak</b> melakukan aktifitas lain. Jika tidak, anda akan dikenakan poin pelanggaran.</li>
                          <li style="color:#E74C4C;">Diharapkan tidak meng-<i>klik</i> di luar <b>Area Ujian</b>. <br>
                            <img src="dist/img/areaujian.png" class="img-responsive" alt="area_ujian" ></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="setuju" name="check_syarat" id="check_syarat">
                          Saya mengerti dan saya akan fokus pada ujian.
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="col_password">
                
                          <div class="panel panel-default">
                            <div class="panel-body">
                                <div id="div_form_pass"></div>
                                <div id="pesan_alert_form" style="display:none;">
                                    <div class="alert alert-danger">
                                        <p id="isi_pesan_alert_form">isi...</p>
                                    </div>
                                </div>
                                <div align="center">
                                  <button type="button" id="btn_mulai" class="btn btn-primary">Mulai</button>
                                  <button type="button" id="btn_kembali" class="btn btn-primary">Kembali</button>
                                </div>
                            </div>
                          </div>
                          <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
                 
                 </div>
               </div>
       </form>
    </div>
  </div>
</div>
<?php require "app/pages/controllers/js.ct_ujian.php"; ?>