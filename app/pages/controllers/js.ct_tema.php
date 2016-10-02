<script>
	function pesan_modal(isi_pesan){
	        $("#p_id_isi_pesan").html(isi_pesan);
	        $("#btn_tampil_modal").click();
	    }

	 function gantiicon(){
	        $.ajax({
	            url: 'app/pages/models/tema/load_form_edit_icon.php',
	            data: {},
	            success: function(data){
	                $("#div_icon").html(data);
	            },
	            error: function(xhr){
	                alert("gagal");
	            }
	        });
	    }

	     function gantilogo(){
	        $.ajax({
	            url: 'app/pages/models/tema/load_form_edit_logo.php',
	            data: {},
	            success: function(data){
	                $("#div_logo").html(data);
	            },
	            error: function(xhr){
	                alert("gagal");
	            }
	        });
	    }

	     $(document).on('click', "#btn_simpan_edit_icon", function(){
	        $("#id_form_edit_icon").submit();
	        //alert("yoo");
	    });

	     $(document).on('click', "#btn_simpan_edit_logo", function(){
	        $("#id_form_edit_logo").submit();
	    });

	     $(document).on('click', "#btn_ganti_nama_instansi", function(){
	        $("#id_form_edit_instansi").submit();
	    });

	     function hasil_edit_icon(pesan){
	        if(pesan == "oke"){
	            pesan_modal("Berhasil Ubah Icon !");
	            location.reload();
	        }else{
	            pesan_modal(pesan);
	        }
	    }

	    function hasil_edit_logo(pesan){
	        if(pesan == "oke"){
	            pesan_modal("Berhasil Ubah Logo !");
	            location.reload();
	        }else{
	            pesan_modal(pesan);
	        }
	    }

	    function hasil_edit_instansi(pesan){
	        if(pesan == "oke"){
	            pesan_modal("Berhasil Ubah Nama Instansi !");
	            location.reload();
	        }else{
	            pesan_modal(pesan);
	        }
	    }
</script>