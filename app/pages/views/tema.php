<?php
$pageheader = "Tema";
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
    <div id="idlist">
      
      <div id="animasi_loading" style="display: none;">
          <button type="button" class="btn btn-warning btn-lg" disabled="true"><i class="fa fa-refresh fa-spin"></i> Loading</button>
      </div>
        <div id="div_gambar_logo">
          <?php
          
          $query = "SELECT * FROM tema";
          $proses = $conn->fetch($query);
          foreach ($proses as $key => $data) {
              # code...
          }
          ?>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <form role="form"
                  id="id_form_edit_icon" name="id_form_edit_icon"
                  action="app/pages/models/tema/editicon.php" method="post"
                  enctype="multipart/form-data" target="upload_target"
              >
                  <label>Icon</label><br>
                  <div id="div_icon">
                        <a onclick="gantiicon();" style="cursor:pointer;" title="Edit Icon"><img src="<?php echo $data['icon']; ?>" width="100"></a>
                  </div>
              </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <form role="form"
                  id="id_form_edit_logo" name="id_form_edit_logo"
                  action="app/pages/models/tema/editlogo.php" method="post"
                  enctype="multipart/form-data" target="upload_target"
              >
              <label>Logo</label><br>
                <div id="div_logo">
                      <a onclick="gantilogo();" style="cursor:pointer;" title="Edit Logo"><img src="<?php echo $data['logo']; ?>" width="100"></a>
                </div>
                </form>
            </div>
            <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <form role="form"
                    id="id_form_edit_instansi" name="id_form_edit_instansi"
                    action="app/pages/models/tema/edit_instansi.php" method="post"
                    enctype="multipart/form-data" target="upload_target"
                >
                <div class="form-group">
                  <label for="input_nama_instansi">Nama Instansi</label>
                  <div class="input-group">
                    <input type="text" id="input_nama_instansi" name="input_nama_instansi" class="form-control" value="<?php echo $data['nama_instansi']; ?>">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="button" id="btn_ganti_nama_instansi">Ganti</button>
                    </span>
                  </div>
                </div>
              </form>
                
            </div>
        </div>
    </div>

  </div>
</div>
<?php require 'app/pages/controllers/js.ct_tema.php'; ?>