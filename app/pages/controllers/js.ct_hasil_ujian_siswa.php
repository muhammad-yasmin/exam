<script>
	function load_list_siswa(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/hasil_ujian_siswa/load_list_siswa.php',
			type: 'POST',
			data: {
				tapel : $("#input_id_tapel").val(),
				semester : $("#input_id_semester").val(),
				ujian : $("#input_id_namaujian").val(),
				jurusan : $("#input_id_jurusan").val(),
				tingkat : $("#input_id_tingkat").val()
			},
			success: function(data){
				$("#animasi_loading").hide();
				$("#div_list").html(data);
			},
			error: function(xhr){
				alert("gagal");
			}
		});
	}

	function form_set_siswa(){
		$.ajax({
			url: 'app/pages/models/hasil_ujian_siswa/set_siswa.php',
			data: {},
			success: function(data){
				$("#set_siswa").html(data);
				load_list_siswa();
			},
			error: function(xhr){
				alert("gagal");
			}
		});
	}
	form_set_siswa();

	$("#btn_cetak").click(function(){
		$("#id_form_print").submit();
	});

	function goto_list_nilai(){
		$("#list_siswa").hide("slow", function(){
			$("#list_nilai").show("slow");
		});
	}

	function goto_list_siswa(){
		$("#list_nilai").hide("slow", function(){
			$("#list_siswa").show("slow");
		});
	}

	function load_nilai_siswa(id){
		$.ajax({
			url: 'app/pages/models/hasil_ujian_siswa/load_data_nilai.ajax.php',
			type: "POST",
			data: {
				id_siswa: id,
				tapel: $("#input_id_tapel").val(),
				tingkat: $("#input_id_tingkat").val(),
				semester: $("#input_id_semester").val(),
				namaujian: $("#input_id_namaujian").val()
			},
			success: function(data){
				$("#input_id_siswa").val(id);
				$("#load_nilai").html(data);
			},
			error: function(xhr){
				alert("gagal");
			}
		});

		goto_list_nilai();
	}

</script>