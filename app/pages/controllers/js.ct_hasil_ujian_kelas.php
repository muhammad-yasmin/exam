<script>
	

	function load_list_hasil_ujian(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/hasil_ujian_kelas/load_list_hasil_ujian.php',
			type: 'POST',
			data: {
				tapel : $("#input_id_tapel").val(),
				semester : $("#input_id_semester").val(),
				ujian : $("#input_id_namaujian").val(),
				tingkat : $("#input_id_tingkat").val(),
				jurusan : $("#input_id_jurusan").val(),
				mapel : $("#input_id_mapel").val(),
				kelas : $("#input_id_kelas").val()
			},
			success: function(data){
				$("#animasi_loading").hide();
				$("#div_data_hasilujian").html(data);
			},
			error: function(xhr){
				alert("gagal");
			}
		});
	}
	
	function load_mapel(){
		$.ajax({
			url: 'app/pages/models/hasil_ujian_kelas/load_mapel.php',
			type: 'POST',
			data: {
				idjurusan:$('#input_id_jurusan').val(),
				tingkat:$('#input_id_tingkat').val()
			},
			success:function(data){
				$('#input_id_mapel').html(data);
				load_kelas();
				load_list_hasil_ujian();
			},
			error:function(xhr){
				alert('gagal');
			}
		});
	}

	function load_kelas(){
		$.ajax({
			url: 'app/pages/models/hasil_ujian_kelas/load_kelas.php',
			type: 'POST',
			data: {
				tingkat:$('#input_id_tingkat').val()
			},
			success:function(data){
				$('#input_id_kelas').html(data);
			},
			error:function(xhr){
				alert('gagal');
			}
		});
	}
	
	

	function form_set_hasil_ujian(){
		$.ajax({
			url: 'app/pages/models/hasil_ujian_kelas/set_hasil_ujian.php',
			data: {},
			success: function(data){
				$("#set_hasilujian").html(data);
				load_kelas();
				load_mapel();
				
				load_list_hasil_ujian();
			},
			error: function(xhr){
				alert("gagal");
			}
		});
	}
	form_set_hasil_ujian();

	$("#btn_cetak").click(function(){
		$("#id_form_print").submit();
	});

	

</script>