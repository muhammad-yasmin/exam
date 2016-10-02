<?php
$pageheader = "Kompetensi Dasar";
$nama_folder = "kd";
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
    <div id="idlistdata" >
      <p>Kompetensi Dasar adalah kemampuan untuk mencapai Kompetensi Inti yang harus diperoleh oleh peserta didik melalui pembelajaran. Kompetensi Dasar adalah konten atau kompetensi yang terdiri atas sikap, pengetahuan, dan ketrampilan yang bersumber pada kompetensi inti yang harus dikuasai peserta didik. Kompetensi tersebut dikembangkan dengan memperhatikan karakteristik peserta didik, kemampuan awal, serta ciri dari suatu mata pelajaran.</p>
      <button type="button" id="btn_add_data" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i> Tambah</button>
      <button type="button" id="btn_import_data" class="btn btn-info btn-xs btn-flat"><i class="fa fa-download"></i> Import</button>
      <!-- <button type="button" id="btn_import_data" class="btn btn-info btn-xs btn-flat"><i class="fa fa-download"></i> Import</button> -->
      <p>
          <div id="animasi_loading" style="display: none;">
              <button type="button" class="btn btn-warning btn-lg" disabled><i class="fa fa-refresh fa-spin"></i> Loading</button>
          </div>
      </p>
      <div id="div_data"></div>
    </div>
    <div id="form_tambahubah" style="display:none;">
          <div class="row container">
                <form role="form"
                    id="id_form_tambahubah" name="id_form_tambahubah"
                    action="app/pages/models/<?php echo $nama_folder; ?>/tambahubah.php" method="post"
                    enctype="multipart/form-data" target="upload_target"
                >
                  <input type="hidden" id="jenis_proses" name="jenis_proses" value="">
                  <input type="hidden" id="idprimarykey" name="idprimarykey" value="">
                  <div id="list_input_biasa"></div>
                </form>
          </div>
                
            <div align="center">
              <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
              <button type="button" id="btn_cancel" class="btn btn-primary">Kembali</button>
            </div>
            <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>
    </div>
    <div id="form_import" style="display:none;">
        <form role="form"
            id="id_form_import" name="id_form_import"
            action="app/pages/models/<?php echo $nama_folder; ?>/proses_import.php" method="post"
            enctype="multipart/form-data" target="upload_target"
        > 
          <div id="list_import"></div>
        </form>
        <div align="center">
          <button type="button" id="btn_simpan2" class="btn btn-primary">Simpan</button>
          <button type="button" id="btn_cancel2" class="btn btn-primary">Kembali</button>
        </div>
    </div>
  </div>
</div>

<script>
    function btn_edit(id){

        $("#jenis_proses").val("ubahdata");
        $("#input_id_mapel").val($("#id_mapel_out"+id).val());

        var idnew = id % 2;
        if(idnew == 1){
            var id2 = parseInt(id) + 1
            $("#idprimarykey").val($("#primaryout"+id).val());
            $("#idprimarykey2").val($("#primaryout"+id2).val());
            $("#input_id_kd").val($("#id_kd_out"+id).val());
            $("#input_id_kd2").val($("#id_kd_out"+id2).val());
            $("#input_text_kd3").val($.trim($("#text_kd_out"+id).html()));
            $("#input_text_kd4").val($.trim($("#text_kd_out"+id2).html()));
        }else{
            var id2 = parseInt(id) - 1;
            $("#idprimarykey").val($("#primaryout"+id2).val());
            $("#idprimarykey2").val($("#primaryout"+id).val());
            $("#input_id_kd").val($("#id_kd_out"+id2).val());
            $("#input_id_kd2").val($("#id_kd_out"+id).val());
            $("#input_text_kd3").val($.trim($("#text_kd_out"+id2).html()));
            $("#input_text_kd4").val($.trim($("#text_kd_out"+id).html()));
        }
        goto_form_tambahubah();
    }

    //DELETE FUNCTION ----------------------------------------------

    function btn_hapuskd(id){
        modal_hapus("Anda yakin menghapus data ini ?");
        $("#idkey").val(id);
        $("#btn_ya").click(function(){
            hapus_functionkd($("#idkey").val(),true);
        });
        $("#btn_tidak").click(function(){
            hapus_functionkd($("#idkey").val(),false);
        });

    }

    function hapus_functionkd(id,kondisi){
        var idnew = id % 2;
        if(idnew == 1){
            var id2 = parseInt(id) + 1;
            var id_draft3 = $("#primaryout"+id).val();
            var id_draft4 = $("#primaryout"+id2).val();
            var id_kd3 = $("#id_kd_out"+id).val();
            var id_kd4 = $("#id_kd_out"+id2).val();
        }else{
            var id2 = parseInt(id) - 1;
            var id_draft3 = $("#primaryout"+id2).val();
            var id_draft4 = $("#primaryout"+id).val();
            var id_kd3 = $("#id_kd_out"+id2).val();
            var id_kd4 = $("#id_kd_out"+id).val();
        }
        if(kondisi == true){
            $.ajax({
                url : "app/pages/models/<?php echo $nama_folder; ?>/hapus.php",
                type: "POST",
                data: {
                    id_draft3 : id_draft3,
                    id_draft4 : id_draft4,
                    id_kd3 : id_kd3,
                    id_kd4 : id_kd4,
                },
                success: function(hasil){
                    load_list_data();
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_list_data();
        }
    }
</script>
<?php require "app/pages/controllers/js.controllers.php"; ?>