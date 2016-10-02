<script>

    function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }

    function load_list_kartu(){
        $("#animasi_loading").show();
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_kartu_soal.php',
            type: 'POST',
            data: { id_user:$('#session_user_id').val() },
            success:function(data){
                $("#animasi_loading").hide();
                $("#div_kartu_soal").html(data);
            },
            error:function(xhr){
                alert("gagal");
            }
        });

        $.ajax({
            url: 'app/pages/models/kartu_soal/load_belum_verifikasi.php',
            type: 'POST',
            data: { id_user:$('#session_user_id').val() },
            success:function(data){
                $("#animasi_loading").hide();
                $("#div_belum_verifikasi").html(data);
            },
            error:function(xhr){
                alert("gagal");
            }
        });
    }
    load_list_kartu();

    function load_id_soal(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_no_soal.php',
            data: {},
            success:function(data){
                $("#div_new_id_soal").html(data);
            },
            error:function(xhr){
                alert("gagal");
            }
        });
    }

    function load_kartu_soal(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/form_kartu_soal.php',
            type: "POST",
            data: {
                nama_guru: $("#i_nama_guru").val()
            },
            success:function(data){
                $("#div_form_kartu_soal").html(data);
                load_id_soal();
            },
            error:function(xhr){
                alert("gagal");
            }
        });
    }
    load_kartu_soal();

    function load_download(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_download.php',
            data: {},
            success: function(data){
                $("#load_download").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });
    }
    load_download();
    function load_input_import(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_input_import.php',
            data: {},
            success: function(data){
                $("#list_import").html(data);
            },
            error: function(xhr){
                alert("Gagal Ambil Data !");
            }
        });
    }
    load_input_import();

    function toggle_audio(){
        $("#div_input_audio").toggle();
    }

    function show_bantuan(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/bantuan.php',
            data: {},
            success: function(data){
                $("#modalLabelbesar").html("Bantuan");
                $("#isi_modal_besar").html(data);
                $("#btn_tampil_modal_besar").click();
            },
            error: function(xhr){
                alert("Gagal Ambil Data !");
            }
        });
    }

    function goto_form(){
        $("#idlistkartusoal").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#form_kartu_soal").show("slow");
            });
        });
    }
    function goto_list(){
        $("#form_kartu_soal").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#idlistkartusoal").show("slow");
            });
        });
    }
    function goto_form_import(){
        $("#form_kartu_soal").hide("slow",function(){
            $("#idlistkartusoal").hide("slow",function(){
                $("#form_import").show("slow");
            });
        });
    }

    $("#btn_add_data").click(function(){
        
        $("#jenisproses").val("tambahdata");
        $("#idprimarykey").val("tambahdata");
        goto_form();
    });
    $("#btn_cancel").click(function(){
        load_kartu_soal();
        goto_list();
    });
    $("#btn_cancel2").click(function(){
        load_kartu_soal();
        goto_list();
    });
    $("#btn_import_data").click(function(){
        goto_form_import();
    });

    function generate_soal(){
        var bentuk_tes = $("#input_id_bentuk_tes").val();
        var abjad = ['A','B','C','D','E'];
        var select_abjad;
        var isi_text = "<p>(isi soal)</p>"
                +"<p>----------</p><p>";
        for (var i = 0; i < bentuk_tes; i++) {
            //abjad editor
            isi_text += abjad[i] + ". (isi)<br />";
        }

        isi_text += "</p><p>----------</p><p>(isi pembahasan jika ada)</p>";

        CKEDITOR.instances.input_id_isi_soal.setData(isi_text);
    }

    function load_bentuk(){
            var b = $("#input_id_bentuk_tes").val();
            $.ajax({
                url: 'app/pages/models/kartu_soal/load_kunci_jawaban.php',
                type: 'POST',
                data: {
                    bentuk : b
                },
                success: function(hasil){
                    $("#jawabannya").html(hasil);
                    generate_soal();
                },
                error: function(xhr){
                    alert("gagal");
                }
            });
        }
    $(document).on("change", "#input_id_bentuk_tes", function(){
        //alert($("#input_id_bentuk_tes").val());
        load_bentuk();
    });

    function muncul_kd(){
        var m = $("#input_id_mapel").val();
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_kd.php',
            type: 'POST',
            data: { mapel:m },
            success:function(data){
                $("#load_kd_div").html(data);
            },
            error:function(xhr){
                alert("gagal");
            }
        });
    }
    $(document).on("change","#input_id_mapel",function(){
        muncul_kd();
    });

    $(document).on("click","#btn_simpan_ki", function(){
        var textnya=$("#input_id_ki:checked").val();
        $("#id_ki").html(textnya);
        $("#input_id_kinti").val(textnya);
    });

    $(document).on("click","#btn_simpan_kd", function(){
        var id=$("#input_id_kd:checked").val();
        var no=$.trim($("#id_no_kd"+id).html());
        var nama=$.trim($("#nama_kd"+id).html());
        $("#isi_kd").html(nama);
        $("#input_id_kdasar").val(id);
        $("#input_no_kd").val(no);
    });

    $(document).on("click","#btn_simpan_materi", function(){
        var id=$("#input_id_materi:checked").val();
        var nama=$.trim($("#nama_materi"+id).html());
        $("#isi_materi").html(nama);
        $("#input_id_mteri").val(id);
        load_indikator();
    });

    function load_data_materi(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_materi.php',
            type: 'POST',
            data: {
                id_kd : $('#input_id_kdasar').val(),
                mapel : $('#input_id_mapel').val()
            },
            success: function(data){
                $("#body_materi").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });
        
    }

    function load_indikator(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_indikator.php',
            type: 'POST',
            data: {
                id_mapel : $("#input_id_mapel").val(),
                no_kd : $("#input_no_kd").val()
            },
            success: function(data){
                $("#isi_indikator").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });    
    }
    function genTemplate(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/proses_download.php',
            type: 'post',
            data: {
                mapel : $("#mapel").val(),
                soal : $("#jumlah_soal").val(),
                opsi : $("#jumlah_opsi").val()
            },
            success: function(data){
                pesan_modal("Template berhasil dibuat, silahkan klik tombol Download");
            },
            error: function(xhr){
                alert("gagal");
            }
        });
    }

    $(document).on("click","#btn_simpan_buku", function(){
        var id=$("#input_id_buku:checked").val();
        var nama=$.trim($("#nama_buku"+id).html());
        if(id == "lain"){
            var id_new = $("#input_new_id_buku").val();
            $("#list_buku").html("");
            $("#nama_new_buku").val("");
            $("#input_buku").val(id_new);
            $("#divid_input_buku").show();
        }else{
            $("#divid_input_buku").hide();
            $("#list_buku").html(nama);
            $("#input_buku").val(id);
            $("#nama_new_buku").val("-");
        }
        
    });

    function tambah_pembahasan(){
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_pembahasan.php',
            data: {
                jenis : $('#jenisproses').val()
            },
            success: function(data){
                $("#div_pembahasan").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        }); 
    }

    function open_bank_gambar(){
        var mapel = $("#input_id_mapel").val();
        window.open('<?php echo $base_url; ?>/bank_gambar/'+mapel,'window_baru','width=800px,height=500px,left=120,top=10,scrollbars=1');
    }

    function btn_edit(kartu){
        $("#jenisproses").val("editdata");
        $("#idprimarykey").val(kartu);

        $("#input_id_mapel").val($("#id_mapel_out"+kartu).val());
        $("#id_ki").html($("#id_ki_out"+kartu).val());
        $("#input_id_kinti").val($("#id_ki_out"+kartu).val());
        $("#input_id_smt").val($("#id_smt_out"+kartu).val());
        $("#input_id_guru").val($("#id_guru_out"+kartu).val());
        $("#input_id_bentuk_tes").val($("#id_btes_out"+kartu).val());
        $("#input_id_tapel").val($("#id_tapel_out"+kartu).val());
        muncul_kd();
        $("#input_id_kdasar").val($("#id_kd_out"+kartu).val());
        $("#input_no_kd").val($("#no_kd_out"+kartu).val());
        $("#isi_kd").html($("#text_kd_out"+kartu).val());
        $("#new_no").html($("#id_soal_out"+kartu).val());
        $("#input_new_no").val($("#id_soal_out"+kartu).val());

        var b = $("#input_id_bentuk_tes").val();
        var j = $.trim($("#jawabanout"+kartu).html());
            $.ajax({
                url: 'app/pages/models/kartu_soal/load_kunci_jawaban.php',
                type: 'POST',
                data: {
                    bentuk : b
                },
                success: function(hasil){
                    $("#jawabannya").html(hasil);
                    //$("#input_id_jawaban option[value='"+j+"']").attr('selected', 'selected');
                    $("#input_id_jawaban").val(j);
                },
                error: function(xhr){
                    alert("gagal");
                }
            });
        
        $("#list_buku").html($("#text_buku_out"+kartu).val());
        $("#input_buku").val($("#id_buku_out"+kartu).val());
        $("#nama_new_buku").val("-");

        $("#isi_materi").html($("#text_materi_out"+kartu).val());
        $("#input_id_mteri").val($("#id_materi_out"+kartu).val());
        load_indikator();
        //$(".note-editable").html($("#text_soal_out"+kartu).val());
        $.ajax({
            url: 'app/pages/models/kartu_soal/load_opsi_jawaban.php',
            type: 'POST',
            data: {
                id_soal : $("#id_soal_out"+kartu).val(),
                bentuk : b
            },
            success: function(hasil){
                var isi_text = $("#text_soal_out"+kartu).val() 
                                +"<p>----------</p><p>"
                                +hasil
                                +"</p><p>----------</p>"
                                +$("#text_soal_pembahasan_out"+kartu).val();

                CKEDITOR.instances.input_id_isi_soal.setData(isi_text);
            },
            error: function(xhr){
                alert("gagal");
            }
        });

        goto_form();
    }

    //DELETE FUNCTION ----------------------------------------------

    function modal_hapus(isi_pesan){
        $("#p_id_isi_pesan_hapus").html(isi_pesan);
        $("#btn_tampil_modal_hapus").click();
    }

    function btn_hapus(id){
        modal_hapus("Anda yakin menghapus kartu soal ID:"+id+" ?");
        $("#idkey").val(id);
        $("#btn_ya").click(function(){
            hapus_function($("#idkey").val(),true);
        });
        $("#btn_tidak").click(function(){
            hapus_function($("#idkey").val(),false);
        });

    }

    function hapus_function(id,kondisi){
        if(kondisi == true){
            $.ajax({
                url: 'app/pages/models/kartu_soal/hapus.php',
                type: "POST",
                data: { idkey : id },
                success: function(hasil){
                    load_list_kartu();
                    pesan_modal(hasil);
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_kartu_soal();
        }
    }

    //END: DELETE FUNCTION -----------------------------------------

    $("#btn_simpan").click(function(){
        var hasil_validasi = true;

        if($("#input_id_mapel").val() == ""){
            hasil_validasi = false;
            $("#label_mapel").css({ 'color': 'red' });
        }else{
            $("#label_mapel").css({ 'color': '#666' });
        }

        if($("#input_id_kinti").val() == ""){
            hasil_validasi = false;
            $("#label_ki").css({ 'color': 'red' });
        }else{
            $("#label_ki").css({ 'color': '#666' });
        }

        if($("#input_id_guru").val() == ""){
            hasil_validasi = false;
            $("#label_penyusun").css({ 'color': 'red' });
        }else{
            $("#label_penyusun").css({ 'color': '#666' });
        }

        if($("#input_id_bentuk_tes").val() == ""){
            hasil_validasi = false;
            $("#label_bentuk_tes").css({ 'color': 'red' });
        }else{
            $("#label_bentuk_tes").css({ 'color': '#666' });
        }

        if($("#input_id_kdasar").val() == ""){
            hasil_validasi = false;
            $("#label_kd").css({ 'color': 'red' });
        }else{
            $("#label_kd").css({ 'color': '#666' });
        }

        if($("#input_id_mteri").val() == ""){
            hasil_validasi = false;
            $("#label_materi").css({ 'color': 'red' });
        }else{
            $("#label_materi").css({ 'color': '#666' });
        }

        if($("#input_id_jawaban").val() == "" || $("#input_id_jawaban").val() == undefined){
            hasil_validasi = false;
            $("#label_jawaban").css({ 'color': 'red' });
        }else{
            $("#label_jawaban").css({ 'color': '#666' });
        }

        if($("#input_buku").val() == ""){
            hasil_validasi = false;
            $("#label_buku").css({ 'color': 'red' });
        }else{
            $("#label_buku").css({ 'color': '#666' });
        }
       
        if(hasil_validasi == true){
             $("#id_form_tambahubah").submit();
        }else{
            pesan_modal("Harap Diisi Lengkap !");
        }
        
    });

    $("#btn_simpan2").click(function(){
        $("#id_form_import").submit();
    });

    function hasil_simpan(hasil){
        if(hasil == "Berhasil Tambah Soal !"){
            pesan_modal(hasil);
            load_list_kartu();
            $(".note-editable").html("");
            load_id_soal();
            goto_list();
        }else if(hasil == "Berhasil Ubah Soal !"){
            pesan_modal(hasil);
            load_kartu_soal();
            load_list_kartu();
            goto_list();
        }
        else{
            pesan_modal(hasil);
        }
    }
</script>