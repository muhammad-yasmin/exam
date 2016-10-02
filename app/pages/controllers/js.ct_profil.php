<script>
	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
    function load_foto_profil(){
    	$.ajax({
    		url: 'app/pages/models/profil/load_foto_profil.php',
    		data: {},
    		success: function(data){
    			$("#divid_foto_profil").html(data);
    		},
    		error: function(xhr){
    			alert("gagal");
    		}
    	});
    }
    load_foto_profil();
    function load_data_profil(){
    	$.ajax({
    		url: 'app/pages/models/profil/load_data_profil.php',
    		data: {},
    		success: function(data){
    			$("#divid_data_profil").html(data);
    		},
    		error: function(xhr){
    			alert("gagal");
    		}
    	});
    }
    load_data_profil();
    function show_divpass(){
    	$("#status_pass").val("ganti");
    	$("#div_ganti_pass").show();
    }
    function cek_passlama(){
    	var pass_lama = $('#input_passlama').val();
    	$.ajax({
    		url: 'app/pages/models/profil/cek_passlama.php',
    		type: 'POST',
    		data: {
    			input_pass : pass_lama
    		},
    		success: function(data){
    			if(data == 'sama'){
    				$("#i_cek_passlama").val("sama");
    				$("#pesan_passlama").addClass('text-success');
    				$("#pesan_passlama").html("<i class='fa fa-check'></i>");
    			}else{
    				$("#i_cek_passlama").val("tidak");
    				$("#pesan_passlama").addClass('text-danger');
    				$("#pesan_passlama").html("<i class='fa fa-remove'></i>");
    			}
    		},
    		error: function(xhr){
    			alert("gagal");
    		}
    	});
    }
    function konfirmasi_pass(){
    	var pass_baru = $("#input_passbaru").val();
    	var conf_pass = $("#input_passbaru_conf").val();

    	if(conf_pass == pass_baru){
    		$("#pesan_passbaru_conf").addClass('text-success');
    		$("#pesan_passbaru_conf").html("<i class='fa fa-check'></i>");
    	}else{
    		$("#pesan_passbaru_conf").addClass('text-danger');
    		$("#pesan_passbaru_conf").html("<i class='fa fa-remove'></i>");
    	}
    }

    function form_submit(){
    	var status = $('#status_pass').val();
    	if(status == 'ganti'){
    		validasi();
    	}else{
    		$("#id_form_edit").submit();
    	}
    }

    function validasi(){
    	var hasil_validasi = true;

    	if($("#input_passlama").val() == "" || $("#i_cek_passlama").val() == "tidak"){
    		hasil_validasi = false;
    		$("#divid_passlama").addClass('has-error');
    	}else{
    		$("#divid_passlama").removeClass('has-error');
    	}

    	if($("#input_passbaru").val() == ""){
    		hasil_validasi = false;
    		$("#divid_passbaru").addClass('has-error');
    	}else{
    		$("#divid_passbaru").removeClass('has-error');
    	}

    	if($("#input_passbaru_conf").val() == "" || $("#input_passbaru_conf").val() !== $("#input_passbaru").val()){
    		hasil_validasi = false;
    		$("#divid_passbaru_conf").addClass('has-error');
    	}else{
    		$("#divid_passbaru_conf").removeClass('has-error');
    	}

    	if(hasil_validasi == true){
    		$("#id_form_edit").submit();
    	}
    }

    function hasil_edit(pesan){
    	if(pesan == 'oke'){
    		pesan_modal("Berhasil Ubah Data !");
    		window.location = "<?php echo $base_url; ?>/profil";
    	}else if(pesan == 'gagal'){
    		pesan_modal("Gagal Ubah Data !");
    	}else if(pesan == 'tidak berubah'){
    		window.location = "<?php echo $base_url; ?>/profil";
    	}else{
    		pesan_modal(pesan);
    	}
    }
</script>