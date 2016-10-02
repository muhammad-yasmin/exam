
<script>
    function load_data_materi(){
        $("#animasi_loading").show();
        $.ajax({
            url: 'app/pages/models/materi/load_data_materi.php',
            data: {},
            success: function(data){
                $("#animasi_loading").hide();
                $("#div_data_materi").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });
    }
    load_data_materi();

    function load_list_materi(){
        var id = $("#id_kd_sementara").val();
        $.ajax({
            url: 'app/pages/models/materi/load_list_materi.php',
            type: "POST",
            data: {
                id_kd : id
            },
            success: function(data){
                $("#div_data_list_materi").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });
    }

    function load_input_biasa(){
        $.ajax({
            url: 'app/pages/models/materi/load_input_biasa.php',
            data: {},
            success: function(data){
                $("#list_input_biasa").html(data);
            },
            error: function(xhr){
                alert("Gagal Ambil Data !");
            }
        });
    }
    load_input_biasa();
    function load_edit(){
        $.ajax({
            url: 'app/pages/models/materi/load_edit.php',
            data: {},
            success: function(data){
                $("#list_input_edit").html(data);
            },
            error: function(xhr){
                alert("Gagal Ambil Data !");
            }
        });
    }
    load_edit();

    function goto_form_tambahubah(){
        $("#materi").hide("slow",function(){
            $("#materi_list").hide("slow",function(){
                $("#form_tambahubah").show("slow");
            });
        });
    }
    function goto_list_materi(){
        $("#form_tambahubah").hide("slow",function(){
            $("#materi_list").hide("slow",function(){
                $("#materi").show("slow");
            });
        });
    }
    function goto_list_materi2(){
        $("#form_tambahubah").hide("slow",function(){
            $("#materi").hide("slow",function(){
                $("#materi_list").show("slow");
            });
        });
    }

    function btn_select(no,id){
        $("#id_kd_sementara").val(id);
        var text = $("#nama_kd_out"+id).val();
        $("#p_kd").html("Kompetensi Dasar 3."+no+" "+text);
        $("#input_id_mapel").val( $("#id_mapel_out"+id).val() );
        $("#i_id_kd").val(id);
        load_list_materi();
        goto_list_materi2();
    }

    $("#btn_add_data").click(function(){
        $("#jenis_proses").val("tambahdata");
        $("#idprimarykey").val("tambahdata");
        $("#list_input_edit").hide(function(){
            $("#list_input_biasa").show();
        });
        goto_form_tambahubah();
    });

    $("#btn_cancel").click(function(){
        load_input_biasa();
        goto_list_materi2();
    });
    $(".form-control").focus(function(){
        $("#pesan_alert_form").hide();
    });

    function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }

    function btn_edit(id){
        $("#jenis_proses").val("editdata");
        $("#idprimarykey").val(id);
        $("#list_input_biasa").hide(function(){
            $("#list_input_edit").show();
        });

        $("#input_materi_edit").val($.trim($("#nama_materi_out"+id).html()));
        goto_form_tambahubah();
    }

    //DELETE FUNCTION ----------------------------------------------

    function modal_hapus(isi_pesan){
        $("#p_id_isi_pesan_hapus").html(isi_pesan);
        $("#btn_tampil_modal_hapus").click();
    }

    function btn_hapus(id){
        modal_hapus("Anda yakin menghapus Materi Pokok ini ?");
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
                url: 'app/pages/models/materi/hapus.php',
                type: "POST",
                data: { idkey : id },
                success: function(hasil){
                    load_list_materi();
                    load_data_materi();
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_data_materi();
        }
    }

    //END: DELETE FUNCTION -----------------------------------------

    $("#btn_simpan").click(function(){
        //validasi();
        $("#id_form_tambahubah").submit();
    });


    function hasil_simpan(pesan){
        if(pesan == "Berhasil Tambah Materi Pokok !"){
            load_data_materi();
            load_list_materi();
            load_input_biasa();
            pesan_modal(pesan);
            goto_list_materi2();
        }else if(pesan == "Berhasil Ubah Data !"){
            load_edit();
            pesan_modal(pesan);
            load_list_materi();
            load_data_materi();
            goto_list_materi2();
        }else{
            load_data_materi();
            pesan_modal(pesan);
        }
    }
</script>