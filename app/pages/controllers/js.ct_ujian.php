<script>
	function pesan_alert_form(isi_pesan,show){
        $("#isi_pesan_alert_form").html(isi_pesan);

        if(show == true){
            $("#pesan_alert_form").show();
            $("#isi_pesan_alert_form").effect("bounce","slow");
        }else{
            $("#pesan_alert_form").hide();
        }
    }
	function load_list_ujian(){
		$("#animasi_loading").show();
		$.ajax({
			url: 'app/pages/models/ujian/load_list_ujian.php',
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

	function goto_pass(){
		$("#list_ujian").hide("slow",function(){
			$("#divid_halaman_pass").show("slow");
		});
	}
	function goto_list_soal(){
		$("#divid_halaman_pass").hide("slow",function(){
			$("#list_ujian").show("slow");
		});
	}	
	function mau_mulai(id_bank){
		$.ajax({
			url: 'app/pages/models/ujian/password_soal.php',
			type: 'POST',
			data: {id_bank: id_bank},
			success:function(data){
				$("#div_form_pass").html(data);
			},
			error:function(xhr){
				alert("gagal");
			}
		});
		var focus = $("#td_focus"+id_bank).val();
		if(focus == 0){
			$("#div_aturan_ujian").hide();
			$("#col_password").addClass('col-md-offset-3 col-lg-offset-3');
			$("#check_syarat").attr('checked', 'checked');
		}else{
			$("#div_aturan_ujian").show();
			$("#col_password").removeClass('col-md-offset-3 col-lg-offset-3');
			$("#check_syarat").removeAttr('checked');
		}

		goto_pass();
	}
	$("#btn_kembali").click(function(){
		goto_list_soal();
	});

	$("#btn_mulai").click(function(){
		$("#form_password_mulai_ujian").submit();
	});

	function hasil_cek(kondisi,fullscreen,id,pesan){
		if(kondisi == "benar"){
			if(fullscreen == 1){
				if((window.fullScreen) || (window.innerWidth == screen.width && window.innerHeight == screen.height)) {
					/*var md5nya = "?php echo md5('cek_status_ujian'); ?>";

					createCookie(md5nya, true, 1);*/
					window.location = "<?php echo $base_url; ?>/jendela_ujian/"+id;
					/*var params = [
					    'height='+screen.height,
					    'width='+screen.width,
					    'fullscreen=yes' // only works in IE, but here for completeness
					].join(',');
					var popup = window.open('php echo $base_url; /jendela_ujian/'+id, 'jendela_ujian', params); 
					popup.moveTo(0,0);*/
				} else {
					pesan_alert_form("Aktifkan mode fullscreen !", true);
				}
			}else{
				window.location = "<?php echo $base_url; ?>/jendela_ujian/"+id;
			}
		}else{
			pesan_alert_form(pesan, true);
		}
		
	}

	function createCookie(name, value, days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
            } else {
                var expires = "";
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name, "", -1);
        }
</script>