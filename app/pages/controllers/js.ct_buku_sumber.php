<script>
	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
	function load_list(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/buku_sumber/load_list.php',
			data: {},
			success:function(data){
				$("#animasi_loading").hide();
				$("#div_list").html(data);
			},
			error:function(xhr){
				alert("gagal");
			}
		});
	}
	load_list();

	//DELETE FUNCTION ----------------------------------------------

    function modal_hapus(isi_pesan){
        $("#p_id_isi_pesan_hapus").html(isi_pesan);
        $("#btn_tampil_modal_hapus").click();
    }

    function btn_hapus(id){
        modal_hapus("Anda yakin menghapus buku sumber ini ?");
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
                url: 'app/pages/models/buku_sumber/hapus.php',
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