<script>
	$(document).ready(function() {
    	var x = navigator.userAgent;
		var my = "examrplsmkn5malanglog";
		//document.getElementById("content").innerHTML = x;
		if(x != my){
			$.get('app/pages/views/404.php', function(data) {
				$("#content").html(data);
				$("#btn_beranda").hide();
			});

		}else{
			load_list_siswa();
		}
		
    });

	function load_list_siswa(){
		var text_cari = $("#text_cari").val();
		var kelas = $("#i_tingkat").val();
		var jurusan = $("#i_jurusan").val();
		$("#c_loading").show();
		$.ajax({
			url: 'app/user_log_mobile/load_list.mobile.user_log.php',
			type: 'POST',
			data: {
				text_cari: text_cari,
				kelas: kelas,
				jurusan: jurusan
			},
			success: function(data){
				$("#c_loading").hide();
				$("#c_list").html(data);
			},
			error: function(xhr){
				alert("error");
			}
		});
	}
	

	$("#btn_cari").click(function() {
		load_list_siswa();
		$("#btn_setting").click();
	});

	function btn_disconnect(id){
		$("#c_loading").show();
        $.ajax({
            url: 'app/user_log_mobile/dc.mobile.user_log.php',
            type: "POST",
            data: { idkey : id },
            success: function(hasil){
                //alert(hasil);
                $("#c_loading").hide();
                load_list_siswa();
            },
            error: function(xhr){
                pesan_modal("Gagal Ambil Data !");
            }
        });
    }

    function confirm_dc(answer){
    	if(answer == 'y'){
    		btn_disconnect('all');
    	}else{
    		$("#btn_dc_all").click();
    	}
    }
</script>