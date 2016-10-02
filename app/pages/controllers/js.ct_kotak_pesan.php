<script>
	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
	function load_list(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/kotak_pesan/load_list.php',
			data: {},
			success:function(data){
				$("#animasi_loading").hide();
				$("#div_materi").html(data);
			},
			error:function(xhr){
				alert("gagal");
			}
		});
	}
	load_list();
            function load_materi(id){
        $.ajax({
            url: 'app/pages/models/kotak_pesan/load_materi.php',
            type: 'post',
            data: {
                id_materi : id
            },
            success: function(data){
                $("#div_show_file").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });
    }
    
	function goto_form(){
		$("#list_materi").hide("slow",function(){
			$("#form_tambahubah").show("slow");
		});
	}
	function goto_list(){
		$("#form_tambahubah").hide("slow",function(){
			$("#show_file").hide("slow",function(){
				$("#list_materi").show("slow");
			});
		});
	}
	function goto_show_file(){
		$("#list_materi").hide("slow",function(){
			$("#show_file").show("slow");
		});
	}
	$("#btn_add_data").click(function() {
		load_form();
		goto_form();
	});
	$("#btn_cancel").click(function(){
		load_form();
		goto_list();
	});
	$("#btn_cancel2").click(function(){
		goto_list();
	});

	function btn_show(id){
        load_materi(id);
		goto_show_file();
	}

	/*$("#btn_simpan").click(function(){
		$("#id_form_tambahubah").submit();
	});
	function hasil_simpan(pesan){
		if(pesan == "Berhasil Tambah File !"){
			pesan_modal(pesan);
			load_list();
			goto_list();
		}else{
			pesan_modal(pesan);
		}
	}*/
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
                url: 'app/pages/models/kotak_pesan/hapus.php',
                type: "POST",
                data: { idkey : id },
                success: function(hasil){
                    load_list();
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_list();
        }
    }

    //END: DELETE FUNCTION -----------------------------------------
</script>