<style type="text/css">
  .styleku{
    background: #2980b9 url('dist/img/tumblr_static_bg3.png') repeat 0 0;
      -webkit-animation: 10s linear 0s normal none infinite animate;
      -moz-animation: 10s linear 0s normal none infinite animate;
      -ms-animation: 10s linear 0s normal none infinite animate;
      -o-animation: 10s linear 0s normal none infinite animate;
      animation: 10s linear 0s normal none infinite animate;
  }
  @-webkit-keyframes animate {
      from {background-position:0 0;}
      to {background-position: 500px 0;}
    }
     
    @-moz-keyframes animate {
      from {background-position:0 0;}
      to {background-position: 500px 0;}
    }
     
    @-ms-keyframes animate {
      from {background-position:0 0;}
      to {background-position: 500px 0;}
    }
     
    @-o-keyframes animate {
      from {background-position:0 0;}
      to {background-position: 500px 0;}
    }
     
    @keyframes animate {
      from {background-position:0 0;}
      to {background-position: 500px 0;}
    }
</style>
<!-- Sequence Modern Slider -->
    <div id="da-slider" class="da-slider styleku">

            <div class="da-slide">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
              <h2>
                <i>UJIAN ONLINE</i>
                <br>
              </h2>
              <p>
                <i>Media Pembelajaran Online untuk Siswa</i>
                <br />
                <i><?php echo $nama_instansi; ?></i>
              </p>
            </div>
          </div>
        </div>
      </div>


            <div class="da-slide">
            <div class="container">
        <div class="row">
          <div class="col-md-12">
        <h2>
          <i>Menjadikan siswa</i>
          <br />
          <i><?php echo $nama_instansi; ?></i>
        </h2>
        <p>
          <i>Cerdas</i>
            <br />
          <i>Terampil</i>
            <br />
          <i>Berbudi Pekerti Luhur</i>
        </p>
      </div>
          </div>
        </div>
      </div>


     

      
    </div>


    <div class="container">
      <div class="row mar-b-50">
        <div class="col-md-12">
          <div class="text-center feature-head wow fadeInDown">
            <h1 class="">
              Selamat Datang
            </h1>

          </div>


          <div class="feature-box">
            
            <div class="col-md-4 col-sm-4 text-center wow fadeInUp">
              <div class="h-service">
                <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                  <i class="fa fa-laptop">
                  </i>
                </div>
                <div class="h-service-content wow fadeInUp">
                  <br><br>
                  <span class="text-center">
                    <h4><b>
                    Fleksibilitas Media
                    </b></h4>
                  </span>
                  <p class="text-center">
                    Dengan menggunakan aplikasi ini, siswa dapat mengerjakan ujian dimana saja.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!--feature end-->
        </div>
      </div>
    </div>


    <!--property start-->
    <div class="property gray-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-sm-6 text-center wow fadeInLeft">
            <img src="dist/img/fitur.png" width="300" height="300">
          </div>
          <div class="col-lg-6 col-sm-6 wow fadeInRight">
            <h1>
              Fitur yang dapat dilakukan :
            </h1>
            <hr>
            <p>
              <i class="fa fa-check fa-lg pr-10">
              </i>
              Manajemen Data
            </p>
            <p>
              <i class="fa fa-check fa-lg pr-10">
              </i>
              Manajemen Soal Ujian 
            </p>
            <p>
              <i class="fa fa-check fa-lg pr-10">
              </i>
              Ujian Online
            </p>
          </div>
        </div>
      </div>
    </div>
    <!--property end-->

    <div id="home-services"></div>
    <?php require "app/pages/controllers/js.ct_beranda.php"; ?>
  


    <div class="container">

      <div class="row mar-b-60">
        <div class="col-lg-6">
          <form action="app/pages/models/beranda/tambah_pesan.php" method="POST" role="form" target="upload_target">
            <legend>Komentar</legend>
          
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="EMAIL">Email</label>
              <input type="email" class="form-control" id="EMAIL" name="EMAIL"> 
            </div>
            <div class="form-group">
              <label for="pesan">Pesan</label>
              <textarea class="form-control" placeholder="Pesan" id="pesan" name="pesan" rows="4"></textarea>
            </div>
            <button type="submit" id="submit" class="btn btn-lg btn-primary">Kirim</button>
              <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
              <div id="success" style="color:#3F51B5;">
              </div>
          </form>
        </div>  
        
        </div>
      </div>


      



    

    

    <!--footer start-->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-sm-6 address wow fadeInUp" data-wow-duration="2s" data-wow-delay=".1s">
            <h1>
              Kontak
            </h1>
            <address>
              <p><i class="fa fa-home pr-10"></i>Lokasi : Jalan Piranha atas No.50</p>
              <p><i class="fa fa-globe pr-10"></i>Kota Malang, Jawa Timur </p>
              <p><i class="fa fa-fax pr-10"></i>Fax : 0341-478195 </p>
              <p><i class="fa fa-phone pr-10"></i>Telepon : 0341-478195 </p>
              <p><i class="fa fa-envelope pr-10"></i>Email :   <a href="http://smkn5malang.sch.id">smkn5malang.sch.id</a></p>
            </address>
          </div>
          
          <div class="col-lg-6 col-sm-6">
            <div class="page-footer wow fadeInUp" data-wow-duration="2s" data-wow-delay=".5s">
              <h1>
                Info 
              </h1>
              <ul class="page-footer-list">
                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="./tentang">Tentang Kami</a>
                </li>
                
              </ul>
            </div>
          </div>
          
        </div>
      </div>
    </footer>
    <!-- footer end -->
    <!--small footer start -->
    <footer class="footer-small">
        <div class="container">
            <div class="row">
                <div align="center">
                  <div class="copyright">
                    <p>&copy; Copyright - RPL SMKN 5 Malang.</p>
                  </div>
                </div>
            </div>
        </div>
    </footer>
    <!--small footer end-->




    <!--container end-->
