<script>
	function load_list_ujian(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/hasil_dan_pembahasan/load_list_hasil.php',
			data: {},
			success: function(data){
				$("#animasi_loading").hide();
				$("#div_ujian").html(data);
			},
			error: function(xhr){
				alert("gagal");
			}
		});
	}
	load_list_ujian();


	function mau_mulai(id){
		location.replace("<?php echo $base_url; ?>/jendela_pembahasan/"+id);
	}
</script>