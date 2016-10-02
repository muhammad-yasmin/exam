<script>
	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
	function load_list_data(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/<?php echo $nama_folder; ?>/load_list_data.php',
			data: {},
			success: function(data){
				$("#animasi_loading").hide();
				$("#div_data").html(data);
			},
			error: function(xhr){
				alert("gagal");
			}
		});
	}
	load_list_data();
	function load_input_biasa(){
        $.ajax({
            url: 'app/pages/models/<?php echo $nama_folder; ?>/load_input_biasa.php',
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
            url: 'app/pages/models/<?php echo $nama_folder; ?>/load_input_import.php',
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
        $("#idlistdata").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#form_tambahubah").show("slow");
            });
        });
    }
    function goto_list(){
        $("#form_tambahubah").hide("slow",function(){
            $("#form_import").hide("slow",function(){
                $("#idlistdata").show("slow");
            });
        });
    }
    function goto_form_import(){
        $("#idlistdata").hide("slow",function(){
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
        $("#btn_simpan").show();
        load_input_biasa();
        goto_list();
    });
    $("#btn_cancel2").click(function(){
        load_input_biasa();
        goto_list();
    });
    $("#btn_import_data").click(function(){
        goto_form_import();
    });

    //DELETE FUNCTION ----------------------------------------------

    function modal_hapus(isi_pesan){
        $("#p_id_isi_pesan_hapus").html(isi_pesan);
        $("#btn_tampil_modal_hapus").click();
    }

    function btn_hapus(id){
        modal_hapus("Anda yakin menghapus data ini ?");
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
                url: 'app/pages/models/<?php echo $nama_folder; ?>/hapus.php',
                type: "POST",
                data: { idkey : id },
                success: function(hasil){
                    load_list_data();
                    pesan_modal(hasil);
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_list_data();
        }
    }

    $("#btn_simpan").click(function(){
        $("#id_form_tambahubah").submit();
    });
    $("#btn_simpan2").click(function(){
        $("#id_form_import").submit();
    });

    function hasil_simpan(pesan){
        if(pesan == "oke_tambah"){
            load_list_data();
            load_input_biasa();
            pesan_modal("Berhasil Tambah Data !");
            goto_list();
        }else if(pesan == "oke_ubah"){
            load_input_biasa();
            pesan_modal("Berhasil Ubah Data !");
            load_list_data();
            goto_list();
        }else{
            load_list_data();
            pesan_modal(pesan);
        }
    }

</script>