<?php
$pageheader = "Bantuan";
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
    <div id="btn_hide">
      <button type="button" class="btn btn-xs btn-primary" onclick="btn_collapse_menu('hide');" >Sembunyikan</button>
    </div>
    <div id="btn_show" style="display:none;">
      <button type="button" class="btn btn-xs btn-primary" onclick="btn_collapse_menu('show');" >Tampilkan</button>
    </div>
    <div id="list_bantuan">
      <div id="div_bantuan">
          <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" id="menu_side">
            <ul class="nav nav-pills nav-stacked">
              <li role="presentation" id="li_home"><a onclick="load_mjm('selamat_datang');" style="cursor: pointer;">Selamat Datang</a></li>
              <li role="presentation" id="li_mjm_guru"><a onclick="load_mjm('mjm_guru');" style="cursor: pointer;">Manajemen Data Guru</a></li>
              <li role="presentation" id="li_mjm_siswa"><a onclick="load_mjm('mjm_siswa');" style="cursor: pointer;">Manajemen Data Siswa</a></li>
              <li role="presentation" id="li_dt_jurusan"><a onclick="load_mjm('mjm_dt_jurusan');" style="cursor: pointer;">Manajemen Data Jurusan</a></li>
              <li role="presentation" id="li_dt_kelas"><a onclick="load_mjm('mjm_dt_kelas');" style="cursor: pointer;">Manajemen Data Kelas</a></li>
               <li role="presentation" id="li_dt_mapel"><a onclick="load_mjm('mjm_dt_mapel');" style="cursor: pointer;">Manajemen Data Mata Pelajaran</a></li>
              <li role="presentation" id="li_mjm_ki"><a onclick="load_mjm('mjm_ki');" style="cursor: pointer;">Manajemen Data Kompetensi Inti</a></li>
              <li role="presentation" id="li_mjm_kd"><a onclick="load_mjm('mjm_kd');" style="cursor: pointer;">Manajemen Data Kompetensi Dasar</a></li>
              <li role="presentation" id="li_dt_materi_pokok"><a onclick="load_mjm('mjm_dt_materi_pokok');" style="cursor: pointer;">Manajemen Data Materi Pokok</a></li>
              <li role="presentation" id="li_dt_jenis_ujian"><a onclick="load_mjm('mjm_dt_jenis_ujian');" style="cursor: pointer;">Manajemen Data Jenis Ujian</a></li>
              <li role="presentation" id="li_dt_kartu_soal"><a onclick="load_mjm('mjm_dt_kartu_soal');" style="cursor: pointer;">Manajemen Kartu Soal</a></li>
              <li role="presentation" id="li_dt_bank_soal"><a onclick="load_mjm('mjm_dt_bank_soal');" style="cursor: pointer;">Manajemen Bank Soal</a></li>
              <li role="presentation" id="li_dt_status_soal"><a onclick="load_mjm('mjm_dt_status_soal');" style="cursor: pointer;">Manajemen Status Soal</a></li>
              <li role="presentation" id="li_dt_hasil_siswa"><a onclick="load_mjm('mjm_dt_hasil_siswa');" style="cursor: pointer;">Manajemen Hasil Ujian Siswa</a></li>
              <li role="presentation" id="li_dt_hasil_kelas"><a onclick="load_mjm('mjm_dt_hasil_kelas');" style="cursor: pointer;">Manajemen Hasil Ujian Kelas</a></li>
              <li role="presentation" id="li_dt_tema"><a onclick="load_mjm('mjm_dt_tema');" style="cursor: pointer;">Mengganti Tema</a></li>
              <li role="presentation" id="li_dt_ujian"><a onclick="load_mjm('mjm_dt_ujian');" style="cursor: pointer;">Cara Memulai Ujian</a>
              <li role="presentation" id="li_dt_hasil"><a onclick="load_mjm('mjm_dt_hasil');" style="cursor: pointer;">Cara Melihat Pembahasan/Nilai Ujian</a><!-- 
              <li role="presentation" id="li_dt_kartu_soal"><a onclick="load_mjm('mjm_kartu_soal');" style="cursor: pointer;">Manajemen Kartu Soal</a></li>
              <li role="presentation" id="li_dt_bank_soal"><a onclick="load_mjm('mjm_bank_soal');" style="cursor: pointer;">Manajemen Bank Soal</a></li>
              <li role="presentation" id="li_dt_status_soal"><a onclick="load_mjm('mjm_status_soal');" style="cursor: pointer;">Manajemen Status Soal</a></li>
              <li role="presentation" id="li_dt_share_soal"><a onclick="load_mjm('mjm_share_soal');" style="cursor: pointer;">Share Soal</a></li> -->
            </ul>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" id="content_bantuan" style="border-left: 1px solid #E4E4E4;height:100%;">
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  function load_mjm(menu){
    $.ajax({
      url: 'app/pages/models/bantuan/'+menu+'.php',
      data: {},
      success: function(data){
        $("#content_bantuan").html(data);
      },
      error: function(xhr){
        alert("gagal");
      }
    });
  }
  load_mjm('selamat_datang');
  
  function btn_collapse_menu(tipe){
    if(tipe == 'hide'){
      $("#menu_side").hide();
      $("#content_bantuan").removeClass('col-md-9 col-lg-9').addClass('col-md-12 col-lg-12');
      $("#btn_hide").hide();
      $("#btn_show").show();
    }else if(tipe == 'show'){
      $("#menu_side").show();
      $("#content_bantuan").removeClass('col-md-12 col-lg-12').addClass('col-md-9 col-lg-9');
      $("#btn_show").hide();
      $("#btn_hide").show();
    }
  }

  /*$("#btn_collapse").click(function(){
    $("#menu_side").hide();
    $("#content_bantuan").removeClass('col-md-9 col-lg-9').addClass('col-md-12 col-lg-12');
    $("#btn_collapse").html("Show");
  });*/
</script>