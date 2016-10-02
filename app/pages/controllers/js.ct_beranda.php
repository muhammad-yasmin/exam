<script>
function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
    function load_counter(){
    	$.ajax({
    		url: 'app/pages/models/beranda/load_counter.php',
    		data: {},
    		success: function(data){
    			$("#home-services").html(data);
    		},
    		error:function(xhr){
    			alert("gagal");
    		}
    	});
    }
    load_counter();
    function hasil_simpan(pesan){
        pesan_modal(pesan);
        $("#name").val("");
        $("#EMAIL").val("");
        $("#pesan").val("");
    }
</script>