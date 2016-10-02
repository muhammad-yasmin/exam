<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $icon_project; ?>">

    <title>
      <?php echo $title_project; ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/css/theme.css" rel="stylesheet">
    <!-- <link href="dist/css/bootstrap-reset.css" rel="stylesheet"> -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->

    <!--external css-->
    <link href="dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/css/animate.css">
    <link rel="stylesheet" href="dist/css/flexslider.css"/>
    <link href="dist/assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/assets/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="dist/assets/owlcarousel/owl.theme.css">
<!--    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>-->
<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->


    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="dist/css/component.css">
    <link href="dist/css/style.css" rel="stylesheet">
    <link href="dist/css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" type="text/css" href="dist/css/parallax-slider/parallax-slider.css" />
    <link rel="stylesheet" href="plugins/jasny-bootstrap/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/datetimepicker/css/bootstrap-datetimepicker.min.css">
    <script type="text/javascript" src="dist/js/parallax-slider/modernizr.custom.28468.js">
    </script>
    <script src="dist/js/jquery-2.0.0.min.js">
    </script>
    <script src="plugins/ckeditor/ckeditor.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js">
    </script>
    <script src="js/respond.min.js">
    </script>
    <![endif]-->
  </head>

  <body>
    <!--header start-->
    <header class="head-section">
      <div class="navbar navbar-default navbar-static-top container">
          <div class="navbar-header">
              <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="<?php echo $logo_project; ?>" width="60" alt="logo"></a><div style="font-size:10px">UJIAN ONLINE BETA 0.6</div>
          </div>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">

                  <li><a href="./beranda">Beranda</a></li>
                  <?php
                  if($status_login == true){

                  	//SELECT FOTO
		            $id_usernya = $_SESSION['id_usernya'];
		            if($title == "Admin" || $title == "Guru"){
		                $que_foto = $conn->fetch("SELECT foto FROM guru_tabel WHERE id_guru=$id_usernya");
		            }else if($title == "Siswa"){
		                $que_foto = $conn->fetch("SELECT foto FROM siswa_tabel WHERE id_siswa=$id_usernya");
		            }
		            foreach ($que_foto as $key => $r_foto) {
		            	$foto_nya = $r_foto['foto'];
		            }
		            
		            //ENd Foto

                  	if($_SESSION['level_nya'] == 1){
                  		?>
                      <li class="dropdown">
                          <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
                          "dropdown" data-toggle="dropdown" href="#">User <i class="fa fa-angle-down"></i>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="./data_guru">Guru</a></li>
                                <li><a href="./data_siswa">Siswa</a></li>
                          </ul>
                      </li>
                  		<li class="dropdown">
		                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
		                      "dropdown" data-toggle="dropdown" href="#">Konten <i class="fa fa-angle-down"></i>
		                      </a>
		                      <ul class="dropdown-menu">
                                <li><a href="./jurusan">Data Jurusan</a></li>
		                            <li><a href="./kelas">Data Kelas</a></li>
                                <li><a href="./mapel">Mata Pelajaran</a></li>
                                <li><a href="./ki">Kompetensi Inti</a></li>
                                <li><a href="./kd">Kompetensi Dasar</a></li>
                                <li><a href="./materi">Materi Pokok</a></li>
                                <li class="dropdown-submenu">
                                  <a href="#" tabindex="-1">Data Lain</a>
                                  <ul class="dropdown-menu">
                                      <li><a href="./jenis_ujian">Jenis Ujian</a></li>
                                      <li><a href="./buku_sumber">Buku Sumber</a></li>
                                  </ul>
                                </li>
		                      </ul>
		                  </li>
		                  
						          <li class="dropdown">
		                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
		                      "dropdown" data-toggle="dropdown" href="#">Ujian <i class="fa fa-angle-down"></i>
		                      </a>
		                      <ul class="dropdown-menu">
		                        <li><a href="./kartu_soal">Kartu Soal</a></li>
                                <li><a href="./bank_soal">Bank Soal Ujian</a></li>
                                <li><a href="./status_soal">Status Soal Ujian</a></li>
		                      </ul>
		                  </li>
		                  <li class="dropdown">
		                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
		                      "dropdown" data-toggle="dropdown" href="#">Hasil Ujian <i class="fa fa-angle-down"></i>
		                      </a>
		                      <ul class="dropdown-menu">
		                      	<li><a href="./hasil_ujian_siswa">Siswa</a></li>
                                <li><a href="./hasil_ujian_kelas">Kelas</a></li>
		                      </ul>
		                  </li>
		                  <li class="dropdown">
		                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
		                      "dropdown" data-toggle="dropdown" href="#">Lain <i class="fa fa-angle-down"></i>
		                      </a>
		                      <ul class="dropdown-menu">
		                      	<li ><a href="./kotak_pesan">Kotak Pesan</a></li>
                            <li ><a href="./tema">Tema</a></li>
                            <li><a href="./user_log">User Log</a></li>
		                      </ul>
		                  </li>
                  		<?php
                  	}else if($_SESSION['level_nya'] == 2){
                  		?>
                  		<li class="dropdown">
		                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
		                      "dropdown" data-toggle="dropdown" href="#">Konten <i class="fa fa-angle-down"></i>
		                      </a>
		                      <ul class="dropdown-menu">
                                <li><a href="./ki">Kompetensi Inti</a></li>
                                <li><a href="./kd">Kompetensi Dasar</a></li>
                                <li><a href="./materi">Materi Pokok</a></li>
		                      </ul>
		                  </li>
		                  <li class="dropdown">
		                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
		                      "dropdown" data-toggle="dropdown" href="#">Soal <i class="fa fa-angle-down"></i>
		                      </a>
		                      <ul class="dropdown-menu">
		                        <li><a href="./kartu_soal">Kartu Soal</a></li>
                                <li><a href="./bank_soal">Bank Soal Ujian</a></li>
                                <li><a href="./status_soal">Status Soal Ujian</a></li>
		                      </ul>
		                  </li>
                      <li><a href="./hasil_ujian_kelas">Hasil Ujian</a></li>
                  		<?php
                  	}else if($_SESSION['level_nya'] == 3){
                  		?>
                  		<li><a href="./ujian">Ujian</a></li>
                        <li><a href="./hasil">Hasil</a></li>
                  		<?php
                  	}
                  	?>
                  	
                  	<li class="dropdown">
	                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
	                      "dropdown" data-toggle="dropdown" href="#"><img src="<?php echo $foto_nya; ?>" height="30" width="30" class="img-circle"> <?php echo $name; ?> <i class="fa fa-angle-down"></i>
	                      </a>
	                      <ul class="dropdown-menu">
	                          <li><a href="./profil">Profil</a></li>
	                          <!-- <li><a href="./bantuan">Bantuan</a></li> -->
	                          <li class="divider"></li>
	                        <li><a href="./logout">Logout</a></li>
	                      </ul>
	                  </li>
                  	<?php
                  }else{
                  	?>
                  	<!-- <li><a href="./bantuan">Bantuan</a></li> -->
		          	     <li><a href="./login">Login</a></li>
                  	<?php
                  }
                  ?>
		          
              </ul>
          </div>
      </div>
    </header>
    <!--header end-->

    <?php
    

   if($status_login == true){
   	if($menu == 'beranda'){
  		require "app/pages/views/beranda.php";
  	}else if($menu == 'bantuan'){
  		require "app/pages/views/bantuan.php";
  	}else if($menu == 'tentang'){
      require "app/pages/views/tentang.php";
    }else{
      if($_SESSION['level_nya'] == 1){
        if($menu == 'kelas'){
          require "app/pages/views/kelas.php";
        }else if($menu == 'jurusan'){
          require "app/pages/views/jurusan.php";
        }else if($menu == 'mapel'){
          require "app/pages/views/mapel.php";
        }else if($menu == 'ki'){
          require "app/pages/views/ki.php";
        }else if($menu == 'kd'){
          require "app/pages/views/kd.php";
        }else if($menu == 'materi'){
          require "app/pages/views/materi.php";
        }else if($menu == 'jenis_ujian'){
          require "app/pages/views/jenis_ujian.php";
        }else if($menu == 'buku_sumber'){
          require "app/pages/views/buku_sumber.php";
        }else if($menu == 'data_guru'){
          require "app/pages/views/data_guru.php";
        }else if($menu == 'data_siswa'){
          require "app/pages/views/data_siswa.php";
        }else if($menu == 'kartu_soal'){
          require "app/pages/views/kartu_soal.php";
        }else if($menu == 'bank_soal'){
          require "app/pages/views/bank_soal.php";
        }else if($menu == 'status_soal'){
          require "app/pages/views/status_soal.php";
        }else if($menu == 'hasil_ujian_siswa'){
          require "app/pages/views/hasil_ujian_siswa.php";
        }else if($menu == 'hasil_ujian_kelas'){
          require "app/pages/views/hasil_ujian_kelas.php";
        }else if($menu == 'kotak_pesan'){
          require "app/pages/views/kotak_pesan.php";
        }else if($menu == 'tema'){
          require "app/pages/views/tema.php";
        }else if($menu == 'user_log'){
          require "app/pages/views/user_log.php";
        }else if($menu == 'profil'){
          require "app/pages/views/profil.php";
        }else{
          require "app/pages/views/404.php";
        }
      }else if($_SESSION['level_nya'] == 2){
        if($menu == 'ki'){
          require "app/pages/views/ki.php";
        }else if($menu == 'kd'){
          require "app/pages/views/kd.php";
        }else if($menu == 'materi'){
          require "app/pages/views/materi.php";
        }else if($menu == 'kartu_soal'){
          require "app/pages/views/kartu_soal.php";
        }else if($menu == 'bank_soal'){
          require "app/pages/views/bank_soal.php";
        }else if($menu == 'status_soal'){
          require "app/pages/views/status_soal.php";
        }else if($menu == 'hasil_ujian_kelas'){
          require "app/pages/views/hasil_ujian_kelas.php";
        }else if($menu == 'profil'){
          require "app/pages/views/profil.php";
        }else{
          require "app/pages/views/404.php";
        }
      }else if($_SESSION['level_nya'] == 3){
        if($menu == 'ujian'){
            //cek jika masih proses ujian
            $cek_ujian = $conn->fetch("SELECT ujian FROM log_activities WHERE nomor_user='$nomor_user' AND ujian<>'selesai'");
            if(count($cek_ujian) > 0){
                foreach ($cek_ujian as $key => $cek) {
                  $id = $cek['ujian'];
                }
                ?><script>location.replace("<?php echo $base_url."/jendela_ujian/$id"; ?>");</script><?php
            }else{
              require "app/pages/views/ujian.php";
            }
            
        }else if($menu == 'hasil'){
          require "app/pages/views/pembahasan.php";
        }else if($menu == 'profil'){
          require "app/pages/views/profil.php";
        }else{
          require "app/pages/views/404.php";
        }
      } 
    }
  }else{
  		if($menu == 'beranda'){
  			require "app/pages/views/beranda.php";
  		}else if($menu == 'login'){
  			require "app/pages/views/login.php";
  		}else if($menu == 'bantuan'){
  			require "app/pages/views/bantuan.php";
  		}else if($menu == 'tentang'){
        require "app/pages/views/tentang.php";
      }elseif($menu == 'user_log_mobile'){
        //nothing
    }else{
  			require "app/pages/views/404.php";
  		}
  }


  ?>
   <?php require "app/pages/models/modal.php"; ?>
    

    <!-- js placed at the end of the document so the pages load faster
<script src="js/jquery.js">
</script>
-->
    
    <script src="dist/js/bootstrap.min.js">
    </script>
    <script src="plugins/datetimepicker/js/moment.min.js"></script>
    <script src="plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="dist/js/hover-dropdown.js">
    </script>
    <script src="plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="plugins/jQueryUI/jquery-ui-1.10.3.min.js"></script>
    <script defer src="dist/js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="dist/assets/bxslider/jquery.bxslider.js">
    </script>
    <script src="dist/assets/owlcarousel/owl.carousel.js">
    </script>
    <script src="dist/js/link-hover.js">
    </script>
    <script src="dist/js/wow.min.js">
    </script>
    <script type="text/javascript" src="dist/js/parallax-slider/jquery.cslider.js">
    </script>
    <script type="text/javascript">
      $(function() {

        $('#da-slider').cslider({
          autoplay    : true,
          bgincrement : 100
        });

      });
    </script>

    <!--common script for all pages-->
    <script src="dist/js/common-scripts.js">
    </script>
    <script>
      $('a.info').tooltip();
      $(document).ready(function() {

        $("#owl-demo").owlCarousel({

          items : 4

        });

      });
      wow = new WOW(
        {
          boxClass:     'wow',      // default
          animateClass: 'animated', // default
          offset:       0          // default
        }
      )
        wow.init();


      $(window).load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
          start: function(slider) {
            $('body').removeClass('loading');
          }
        }
                                   );
      }
                    );




      $(window).scroll(function() {
        $('#skillz').each(function(){
          var imagePos = $(this).offset().top;
          var viewportheight = window.innerHeight;

          var topOfWindow = $(window).scrollTop();
          if (imagePos < topOfWindow+viewportheight) {
            $('.skill_bar').fadeIn('slow');
            $('.skill_one').animate({
              width:'60%'}
                                    , 2000);
            $('.skill_two').animate({
              width:'90%'}
                                    , 2000);
            $('.skill_three').animate({
              width:'70%'}
                                      , 1000);
            $('.skill_four').animate({
              width:'55%'}
                                     , 1000);
            $('.skill_bar_progress p').fadeIn('slow',function(){

            }
                                             );
          }
        }
                         );
      }
                      );




    </script>
  </body>
</html>