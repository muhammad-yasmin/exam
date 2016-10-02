<script>

    function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }

    function pesan_alert_form(isi_pesan,show){
        $("#isi_pesan_alert_form").html(isi_pesan);

        if(show == true){
            $("#pesan_alert_form").show();
            $("#isi_pesan_alert_form").effect("bounce","slow");
        }else{
            $("#pesan_alert_form").hide();
        }
    }
	function load_data_siswa(){
        $("#animasi_loading").show();
        $.ajax({
            url: 'app/pages/models/siswa/load_data_siswa.php',
            data: {},
            success: function(data){
                $("#animasi_loading").hide();
                $("#div_data_siswa").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });

    }
    load_data_siswa();
    function load_input_biasa(){
        $.ajax({
            url: 'app/pages/models/siswa/load_input_biasa.php',
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
            url: 'app/pages/models/siswa/load_input_import.php',
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
        $("#idlistsiswa").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#form_tambahubah").show("slow");
            });
        });
    }
    function goto_list_siswa(){
        $("#form_tambahubah").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#idlistsiswa").show("slow");
            });
        });
    }
    function goto_form_import(){
        $("#idlistsiswa").hide("slow",function(){
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
        load_input_biasa();
        goto_list_siswa();
    });
    $("#btn_cancel2").click(function(){
        goto_list_siswa();
    });
    $("#btn_import_data").click(function(){
        goto_form_import();
    });
    function gantifoto(){
        $("#show_foto").hide(function(){
            $("#input_foto").show();
        });
    }
    function btn_edit(id,index){

        $("#jenis_proses").val("ubahdata");
        $("#idprimarykey").val(
            $("#primaryout"+index).val()
        );
        $("#input_foto").hide();
        $("#img_foto").prop('src', $("#fotoout"+index).val());
        $("#show_foto").show();
        $("#input_id_nis").val(
            $.trim($("#nisout"+index).html())
        );
        $("#input_id_nama_siswa").val(
            $.trim($("#namaout"+index).html())
        );
        $("#input_id_jk").val(
            $.trim($("#jkout"+index).html())
        );
        $("#input_id_kelas").val(
            $.trim($("#kelasout"+index).html())
        );
        $("#input_id_jurusan").val(
            $("#jurusanout"+index).val()
        );
        $("#divid_password").show();

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
                url: 'app/pages/models/siswa/hapus.php',
                type: "POST",
                data: { idkey : id },
                success: function(hasil){
                    load_data_siswa();
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_data_siswa();
        }
    }

    //END: DELETE FUNCTION -----------------------------------------
    $("#btn_simpan").click(function(){
        validasi();
    });

    function validasi(){
        var hasil_validasi = true;
        if($("#input_id_nis").val() == ""){
            hasil_validasi = false;
            $("#divid_nis").addClass('has-error');
        }else{
            $("#divid_nis").removeClass('has-error');
        }
        if($("#input_id_nama_siswa").val() == ""){
            hasil_validasi = false;
            $("#divid_nama_siswa").addClass('has-error');
        }else{
            $("#divid_nama_siswa").removeClass('has-error');
        }
        if($("#input_id_jk").val() == ""){
            hasil_validasi = false;
            $("#divid_jk").addClass('has-error');
        }else{
            $("#divid_jk").removeClass('has-error');
        }
        if($("#input_id_kelas").val() == ""){
            hasil_validasi = false;
            $("#divid_kelas").addClass('has-error');
        }else{
            $("#divid_kelas").removeClass('has-error');
        }


        if(hasil_validasi == true){
            //pesan_modal("lanjut");
            $("#id_form_tambahubah").submit();
        }else{
            pesan_alert_form("Harap Diisi Lengkap !",true);
        }
    }
    $("#btn_simpan2").click(function(){
        $("#id_form_import").submit();
    });
    function hasil_simpan(pesan){
        if(pesan == "Berhasil Tambah Siswa !"){
            load_data_siswa();
            load_input_biasa();
            pesan_modal(pesan);
            goto_list_siswa();
        }else if(pesan == "Berhasil Import Siswa !"){
            load_input_biasa();
            pesan_modal(pesan);
            load_data_siswa();
            goto_list_siswa();
        }else if(pesan == "Berhasil Ubah Data !"){
            load_input_biasa();
            pesan_modal(pesan);
            load_data_siswa();
            goto_list_siswa();
        }else{
            load_data_siswa();
            pesan_alert_form(pesan,true);
        }
    }
</script>