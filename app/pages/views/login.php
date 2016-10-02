<?php
$pageheader = "Login";
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

    <!--container start-->
    <div class="login-bg">
        <div class="container">
            <div class="form-wrapper">
            <iframe src="#" id="iframe_login" name="iframe_login" style="display: none;" frameborder="0"></iframe>
            <form role="form" id="form_login" class="form-signin wow fadeInUp" action="app/pages/models/login/proses_login.php" method="post" target="iframe_login">
            <h2 class="form-signin-heading"><?php echo $pageheader; ?></h2>
            <div class="login-wrap">
              <div class="row">
              <div id="div_user" class="form-group col-sm-12">
                    <label for="user">NIS/NIP</label>
                    <input id="user" name="user" type="text" class="form-control" autocomplete="off" maxlength="18">
                    
                  </div>
                  <div id="div_pass" class="form-group col-sm-12">
                    <label for="pass">Password</label>
                    <input id="pass" name="pass" type="password" class="form-control" autocomplete="off">
                  </div>
                  </div>
                  <div class="row">
                  <div id="pesan_alert" style="display: none;">
                    <div class="alert alert-danger">
                      <span id="isi_pesan_alert">error</span>
                    </div>
                  </div>
                  </div>
                  <div align="center">
                      <button id="btn_login" name="btn_login" type="submit" class="btn btn-lg btn-primary">Masuk</button>
                    </div>
            </div>
          </form>

          
          </div>
        </div>
    </div>
    <!--container end-->

    <script>
      function alert_form(pesan,show){
        $("#isi_pesan_alert").html(pesan);
        if(show == true){
          $("#div_user").addClass('has-error');
          $("#div_pass").addClass('has-error');
          $("#pesan_alert").show();
          $("#isi_pesan_alert").effect("bounce","slow");
        }else{
          $("#div_user").removeClass('has-error');
          $("#div_pass").removeClass('has-error');
          $("#pesan_alert").hide();
        }
      }

      function hasil_login(pesan){
        if(pesan == 'berhasil'){
          window.location = "<?php echo $base_url; ?>";
        }else{
          alert_form(pesan, true);
        }
      }

    </script>