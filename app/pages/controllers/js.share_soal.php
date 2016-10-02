<script>

	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
    function load_list_bank(){
        $("#animasi_loading").show();
        $.ajax({
            url: 'app/pages/models/share/load_list_bank.php',
            data: {},
            success:function(data){
                $("#animasi_loading").hide();
                $("#div_bank_soal").html(data);
            },
            error:function(xhr){
                alert('gagal');
            }
        });
        
    }
    load_list_bank();
    function goto_list(){
        $("#form_bank_soal").hide("slow",function(){
            $("#list_bank_soal").show("slow");
        });
    }
    $("#btn_add_data").click(function(){
        goto_form();
    });
    $("#btn_cancel").click(function(){
        goto_list();
        load_list_bank();
    });
$("#btn_kirim").click(function(){
       $("#id_form_tambahshare").submit();
    });
    function btn_share(id){
        $("#input_id_banknya").val(id);
        $("#btn_modal_share").click();
        $.ajax({
            url: 'app/pages/models/share/load_guru.php',
            data: {},
            success: function(data){
                $("#isi_modal_share").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        })
        
    }
    

    //DELETE FUNCTION ----------------------------------------------

    function modal_hapus(isi_pesan){
        $("#p_id_isi_pesan_hapus").html(isi_pesan);
        $("#btn_tampil_modal_hapus").click();
    }

    function btn_hapus(id){
        modal_hapus("Anda yakin menghapus bank soal ini ?");
        $("#idkey").val(id);
        $("#btn_ya").click(function(){
            hapus_function($("#idkey").val(),true);
        });
        $("#btn_tidak").click(function(){
            hapus_function($("#idkey").val(),false);
        });

}
    //END: DELETE FUNCTION -----------------------------------------

    function btn_view(id){
        $("#input_id_banknya").val(id);
        window.open('load_kartu.php?window_baru','width=100%,height=100%px,left=120,top=10,scrollbars=1');
    	//window.open('preview.php?id='+id,'window_baru','width=800px,height=500px,left=120,top=10,scrollbars=1');
    }

    function preview_bank(id){
         $("#input_id_banknya").val(id);
        window.open('load_kartu.php?window_baru','width=100%,height=100%,left=120,top=10,scrollbars=1');
    }
     function hasil_simpan(pesan){
        if(pesan == "Berhasil Kirim !"){
            alert("Berhasil Kirim !");
        }else{
             alert("Gagal Kirim !");
        }
    }
</script>