<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$q_siswa = $conn->fetch("SELECT * FROM siswa_tabel");
$q_guru = $conn->fetch("SELECT * FROM guru_tabel");
$q_mapel = $conn->fetch("SELECT * FROM mapel_tabel");

$r_siswa = count($q_siswa);
$r_guru = count($q_guru);
$r_mapel = count($q_mapel);
?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>
              Jumlah Data
            </h2>
          </div>
          <?php  ?>
          <div class="col-md-4">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-graduation-cap">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
                <h3>
                  Siswa
                </h3>
                <p style="font-size:22px">
                  <?php echo $r_siswa; ?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-users">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
                <h3>
                  Guru
                </h3>
                <p style="font-size:22px">
                  <?php echo $r_guru; ?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-book">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
                <h3>
                  Mata Pelajaran
                </h3>
                <p style="font-size:22px">
                  <?php echo $r_mapel; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- /row -->

      </div>
      <!-- /container -->