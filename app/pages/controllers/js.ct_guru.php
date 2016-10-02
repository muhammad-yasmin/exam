<script>

    function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
    
	function load_data_guru(){
        $("#animasi_loading").show();
        $.ajax({
            url: 'app/pages/models/guru/load_data_guru.php',
            data: {},
            success: function(data){
                $("#animasi_loading").hide();
                $("#div_data_guru").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });

    }
    load_data_guru();
    function load_input_biasa(){
        $.ajax({
            url: 'app/pages/models/guru/load_input_biasa.php',
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

    function load_input_import(){
        $.ajax({
            url: 'app/pages/models/guru/load_input_import.php',
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

    function goto_form_tambahubah(){
        $("#idlistguru").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#form_tambahubah").show("slow");
            });
        });
    }
    function goto_list_guru(){
        $("#form_tambahubah").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#idlistguru").show("slow");
            });
        });
    }
    function goto_form_import(){
        $("#idlistguru").hide("slow",function(){
            $("#form_tambahubah").hide("slow",function(){
                $("#form_import").show("slow");
            });
        });
    }
    $("#btn_add_data").click(function(){
        $("#jenis_proses").val("tambahdata");
        $("#idprimarykey").val("tambahdata");
        load_input_biasa();
        goto_form_tambahubah();
    });
    $("#btn_cancel").click(function(){
        goto_list_guru();
        load_input_biasa();
    });
    $("#btn_cancel2").click(function(){
        goto_list_guru();
    });
    $("#btn_import_data").click(function(){
        goto_form_import();
    });

    function gantifoto(){
        $("#show_foto").hide(function(){
            $("#input_foto").show();
        });
    }

    function load_mapel(){
        var jurusan = $("#input_id_jurusan").val();
        $.ajax({
            url: 'app/pages/models/guru/pilih_mapel.php',
            type: "POST",
            data: {
                jurusan : jurusan
            },
            success: function(data){
                $("#div_pilih_mapel").html(data);
            },
            error: function(xhr){
                alert("Gagal Ambil Data !");
            }
        });
    }

    $(document).on("change", "#input_id_jurusan", function(){
        load_mapel();
    });
    function setting_mapel(id,index){
        $("#jenis_proses").val("setting_mapel");
        $("#idprimarykey").val(
            $("#primaryout"+index).val()
        );
        $("#div_col_img").hide();
        $("#input_id_nip").val(
            $.trim($("#nipout"+index).html())
        );
        $("#input_id_nip").attr('disabled', 'disabled');
        $("#input_id_nama_guru").val(
            $.trim($("#namaout"+index).html())
        );
        $("#input_id_nama_guru").attr('disabled', 'disabled');
        $("#input_id_jk").val(
            $.trim($("#jkout"+index).html())
        );
        $("#divid_jk").hide();
        $("#divid_jurusan").show();
        goto_form_tambahubah();
    }
    $(document).on("change", "#input_id_jurusan", function(){
        load_mapel();
    });
    function btn_edit(id,index){
        $("#jenis_proses").val("ubahdata");
        $("#idprimarykey").val(
            $("#primaryout"+index).val()
        );

        $("#input_foto").hide();
        $("#img_foto").prop('src', $("#fotoout"+index).val());
        $("#show_foto").show();

        $("#input_id_nip").val(
            $.trim($("#nipout"+index).html())
        );
        $("#input_id_nama_guru").val(
            $.trim($("#namaout"+index).html())
        );
        $("#input_id_jk").val(
            $.trim($("#jkout"+index).html())
        );
        $("#input_id_jurusan").val(
            $("#jurusanout"+index).val()
        );
        $("#divid_jurusan").hide();
        $("#divid_password").show();
        /*load_mapel();

        $(".cekbox").attr("disabled","disabled");

        var max = $("#maxmapel").val();
        for(var z=1;z<=max;z++){
            var isimapelout = $("#mapelout"+index+z).val();
            //alert(isimapelout);
            if(isimapelout !== undefined){
                $("#input_id_mapel"+z).attr('checked', 'checked');
            }
        }*/

        goto_form_tambahubah();
    }
    //DELETE FUNCTION ----------------------------------------------

    function modal_hapus(isi_pesan){
        $("#p_id_isi_pesan_hapus").html(isi_pesan);
        $("#btn_tampil_modal_hapus").click();
    }

    function btn_hapus(id,x){
        modal_hapus("Anda yakin menghapus "+x+" ?");
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
                url: 'app/pages/models/guru/hapus.php',
                type: "POST",
                data: { idkey : id },
                success: function(hasil){
                    load_data_guru();
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_data_guru();
        }
    }

    //END: DELETE FUNCTION -----------------------------------------
    $("#btn_simpan").click(function(){
        validasi();
    });

    $("#btn_simpan2").click(function(){
        $("#id_form_import").submit();
    });

    function validasi(){
        var hasil_validasi = true;
        if($("#input_id_nip").val() == ""){
            hasil_validasi = false;
            $("#divid_nip").addClass('has-error');
        }else{
            $("#divid_nip").removeClass('has-error');
        }
        if($("#input_id_nama_guru").val() == ""){
            hasil_validasi = false;
            $("#divid_nama_guru").addClass('has-error');
        }else{
            $("#divid_nama_guru").removeClass('has-error');
        }
        if($("#input_id_jk").val() == ""){
            hasil_validasi = false;
            $("#divid_jk").addClass('has-error');
        }else{
            $("#divid_jk").removeClass('has-error');
        }


        if(hasil_validasi == true){
            //pesan_modal("lanjut");
            var hasil_nip = $("#hasilceknip").val();
            if(hasil_nip == 'benar'){
                $("#id_form_tambahubah").submit();
            }else{
                pesan_modal("NIP belum sesuai !");
            }
        }else{
            pesan_modal("Harap Diisi Lengkap !");
        }
    }
    function hasil_simpan(pesan){
        if(pesan == "Berhasil Tambah Guru !" || pesan == "Berhasil Tambah Data !"){
            load_data_guru();
            load_input_biasa();
            pesan_modal(pesan);
            goto_list_guru();
        }else if(pesan == "Berhasil Import Guru !"){
            load_data_guru();
            load_input_import();
            pesan_modal(pesan);
            goto_list_guru();
        }else if(pesan == "Berhasil Ubah Data !"){
            load_input_biasa();
            pesan_modal(pesan);
            load_data_guru();
            goto_list_guru();
        }else{
            load_data_guru();
            pesan_modal(pesan);
        }
    }
</script>