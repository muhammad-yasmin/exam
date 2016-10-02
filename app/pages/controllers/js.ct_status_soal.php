<script>
	
	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
	function load_bank_soal(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/status_soal/load_bank_soal.php',
			data: {},
			success:function(data){
				$("#animasi_loading").hide();
				$("#div_status_soal").html(data);
			},
			error:function(xhr){
				alert("gagal");
			}
		});
	}
	load_bank_soal();
	function goto_edit_form(){
		$("#list_status_soal").hide("slow",function(){
			$("#form_status_soal").show("slow");
		});
	}
	function goto_list(){
		$("#form_status_soal").hide("slow",function(){
			$("#list_status_soal").show("slow");
		});
	}
	function btn_edit(id){
		$.ajax({
			url: 'app/pages/models/status_soal/load_form.php',
			type: 'POST',
			data: { id_bank : id},
			success:function(data){
				$("#div_form_status_soal").html(data);
				$("#cetak_id_bank").val(id);
			},
			error:function(xhr){
				alert("gagal");
			}
		});
		goto_edit_form();
	}
	$("#btn_cancel").click(function(){
		goto_list();
	});
	$("#btn_simpan").click(function(){
		$("#id_form_update").submit();
	});
	function hasil_simpan(pesan){
		if(pesan == "Bank Soal diaktifkan !" || pesan == "Bank Soal dinonaktifkan !"){
			pesan_modal(pesan);
			load_bank_soal();
			goto_list();
		}else{
			pesan_modal(pesan);
		}
	}

	function nonaktif_all(){
		$.ajax({
			url: 'app/pages/models/status_soal/nonaktif_all.php',
			data: {},
			success: function(hasil){
				pesan_modal(hasil);
				load_bank_soal();
			},
			error: function(xhr){
				alert("gagal");
			}
		});
	}
</script>