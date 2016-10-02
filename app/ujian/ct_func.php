<script>
	// document.onkeydown = function (e) {
 //            return false;
 //    }
 //    $(document).bind('contextmenu', function (e) {
 //      e.preventDefault();
 //    });
 	
	//JS buat Timer
	var csec;
	if(readCookie("<?php echo md5('detiknya'); ?>")){
	  csec = readCookie("<?php echo md5('detiknya'); ?>");
	}else{
	  csec = <?php echo $total_waktu; ?>;
	}
	var upgradeTime = csec;
	var seconds = upgradeTime;
	function timer() {
	    var days        = Math.floor(seconds/24/60/60);
	    var hoursLeft   = Math.floor((seconds) - (days*86400));
	    var hours       = Math.floor(hoursLeft/3600);
	    var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
	    var minutes     = Math.floor(minutesLeft/60);
	    var remainingSeconds = seconds % 60;
	    if (remainingSeconds < 10) {
	        remainingSeconds = "0" + remainingSeconds; 
	    }
	    document.getElementById('countdown').innerHTML = hours + " : " + minutes + " : " + remainingSeconds;
	    document.getElementById('countdown_toggle').innerHTML = hours + " : " + minutes + " : " + remainingSeconds;
	    if (seconds > 0) {
	    	$("#tombol_submit").hide();
	        if(seconds < 900){
	        	$("#tombol_submit").show();
		        if(seconds < 60){
		        	$("#countdown").css('background','#E74C4C');//berubah merah
		        }
	        }

	        createCookie("<?php echo md5('detiknya'); ?>", seconds, 1);
	        seconds--;
	        
	    } else {
	      
	      $("#form_ujian").submit();
	      clearInterval(countdownTimer);
	      document.getElementById('countdown').innerHTML = "Waktu Habis !";
	      document.getElementById('countdown_toggle').innerHTML = "Waktu Habis !";
	    }
	}
	var countdownTimer = setInterval('timer()', 1000);
	//END : Timer

	$(document).ready(function() {
		$("#soal_dragend").dragend();

		for (var i = 1; i <= <?php echo $Jumlah_Soal; ?>; i++) {
			var id = $(".radios_cls"+i+":checked").val();
			if(id !== undefined){
				check_opsi('span_opsi'+id,i);
			}else{
				continue;
			}
		}
		check_jumlah_terjawab();

		$('#soal_dragend').bind({
			copy : function(){
				alert("copy");
			}
		});
	});

	function toggle_no(){
		$("#page_wrap").toggleClass('toggled');
	}

	function check_opsi(id_span,no_page){
		var hasil = no_page+". "+ $.trim($("#"+id_span).html());
		$("#id_no_soal"+no_page).html(hasil);
	}

	function check_jumlah_terjawab(){
		var jml = 0;
		for (var n = 1; n <= <?php echo $Jumlah_Soal; ?>; n++) {
			var id = $(".radios_cls"+n+":checked").val();
			if(id !== undefined){
				jml += 1;
			}else{
				continue;
			}
		}
		$("#span_id_jml_soal_terjawab").html(jml);
	}

	function goto_soal(no){
        $("#soal_dragend").dragend({
            scrollToPage: no
        });
    }

	function next_or_prev(arah) {
		$("#soal_dragend").dragend(arah);
	}

	function control_audio(id,method){
			if(method == 'play'){
				$("audio").trigger('pause');
				$(".btn-play").show()
				$(".btn-pause").hide();
				$("#button-play"+id).hide()
				$("#button-pause"+id).show();
			}else{
				$("#button-pause"+id).hide();
				$("#button-play"+id).show();
			}
			var yourAudio = document.getElementById('myplayer'+id);
		    // Update the Audio
		    yourAudio[method]();

		    // Prevent Default Action
		    return false;
		}

		function len(id){
			var count = 0;
			var audio = document.getElementById('myplayer'+id);
			var length = audio.duration;
			var current = audio.currentTime;
			if(current == length){
				if(readCookie("audio_cookie_"+id)){
					count = parseInt(readCookie("audio_cookie_"+id)) + 1;
					createCookie("audio_cookie_"+id, count, 1);
					if(readCookie("audio_cookie_"+id) > 1){
						$("#panel_audio"+id).html("");
					}
				}else{
					count = 1;
					createCookie("audio_cookie_"+id, count, 1);
				}
				$("#button-pause"+id).hide();
				$("#button-play"+id).show();
			}
		}

		function volume_up(){
		    var volume = $("audio").prop("volume")+0.2;
		    if(volume >1){
		        volume = 1;
		    }
		    $("audio").prop("volume",volume);
		}
		 
		function volume_down(){
		    var volume = $("audio").prop("volume")-0.2;
		    if(volume <0){
		        volume = 0;
		    }
		    $("audio").prop("volume",volume);
		}

	function jawab_soal(bank,no_soal,id_kartu,id_soal,value){
        createCookie("soal"+bank+"_"+id_kartu, value, 1);
        check_opsi('span_opsi'+value+'__'+id_soal,no_soal);
        $("#id_no_soal"+no_soal).css('background','#3498DB');
        check_jumlah_terjawab();
        //location.reload();
    }

    function pelanggaran(){
    	var count_foul = 0;
    	if(readCookie("count_foul")){
		  count_foul = parseInt(readCookie("count_foul"));
		}
    	var hasil = count_foul + 1;

    	$("#btn_foul").removeClass('btn-primary').addClass('btn-warning');

    	$("#foul_count").html(hasil);
    	createCookie('count_foul', hasil, 1);
    }

	

    function modal_confirm(isi_pesan){
        $("#p_id_isi_pesan_confirm").html(isi_pesan);
        $("#btn_tampil_modal_confirm").click();
    }

    function selesai(){
        modal_confirm("Apakah Anda yakin ?");
        $("#btn_ya").click(function(){
            $("#form_ujian").submit();
            //submit_form();
        });
    }

    function modal_hasil(nilai){
        $("#btn_tampil_modal_hasil").click();
    }

    function delete_cookies_jawaban(bank,kartu,id_soal){
        eraseCookie('soal'+bank+'_'+kartu);
        if(readCookie("audio_cookie_"+id_soal)){
        	eraseCookie("audio_cookie_"+id_soal);
        }
        if(readCookie("count_foul")){
        	eraseCookie("count_foul");
        }
    }

    function tutup_ujian(){
        
        window.location = "<?php echo $base_url."/ujian"; ?>";
    }

    function submit_form(){
    	var input_id_siswa = $("#input_id_siswa").val();
    	var input_id_bank = $("#input_id_bank").val();
    	var input_jumlah_soal = $("#input_jumlah_soal").val();
    	$.ajax({
    		url: '../app/ujian/hasilnya.php',
    		type: 'POST',
    		data: {
    			input_id_siswa : input_id_siswa,
    			input_id_bank : input_id_bank,
    			input_jumlah_soal : input_jumlah_soal
    		},
    		success: function(data){
    			$("#main_content").html(data);
    		},
    		error: function(xhr){
    			alert("gagal");
    		}
    	});
    	
    }

    

    function hasil_ujian(pesan,nilai){
        if(pesan == 'berhasil'){
            eraseCookie("<?php echo md5('detiknya'); ?>");
            eraseCookie("<?php echo md5('cek_status_pass').$id_bank; ?>");
            eraseCookie("CookiesKartu");
            modal_hasil(nilai);
        }else{
            alert("Coba Lagi !!!");
        }
    }

</script>