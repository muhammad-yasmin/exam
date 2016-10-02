<script>
	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
	function load_list(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/user_log/load_list.php',
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

    function btn_disconnect(id,lv){
            $.ajax({
                url: 'app/pages/models/user_log/disconnect.php',
                type: "POST",
                data: { idkey : id, level: lv },
                success: function(hasil){
                    //alert(hasil);
                    load_list();
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
    }
</script>