<script>

	function pesan_modal(isi_pesan){
        $("#p_id_isi_pesan").html(isi_pesan);
        $("#btn_tampil_modal").click();
    }
    function load_list_bank(){
        $("#animasi_loading").show();
        $.ajax({
            url: 'app/pages/models/bank_soal/load_list_bank.php',
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
	function load_form(){
		$.ajax({
			url: 'app/pages/models/bank_soal/load_form.php',
			data: {},
			success:function(data){
				$("#div_form_bank_soal").html(data);
			},
			error:function(xhr){
				alert("gagal");
			}
		});	
	}
	load_form();
	function load_kartu_soal(id_mapel){
        $("#load_btn_mapel").hide();
        $("#input_id_mapel").val(id_mapel);
        $.ajax({
            url: 'app/pages/models/bank_soal/load_kartu.php',
            type: "POST",
            data: { id_mapel : id_mapel },
            success:function(data){
                $("#div_kartu_soal").html(data);
            },
            error:function(xhr){
                alert("gagal");
            }
        });
    }
    function load_btn_mapel(){
        $("#load_btn_mapel").show();
        var keyword = $("#cari_mapel").val();
        if(keyword == ""){
            $("#load_btn_mapel").html("Silahkan cari..");
        }else{
            $.ajax({
                url: 'app/pages/models/bank_soal/load_mapel.php',
                type: 'POST',
                data: {keyword: keyword},
                success: function(data){
                    $("#load_btn_mapel").html(data);
                },
                error: function(xhr){
                    alert("gagal");
                }
            });
        }
    }
    load_btn_mapel();
	function goto_form(){
        $("#list_bank_soal").hide("slow",function(){
            $("#form_bank_soal").show("slow");
        });
    }
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
        load_form();
        $("#btn_simpan").show();
    });

    function btn_view(id){
        $.ajax({
            url: 'app/pages/models/bank_soal/load_view_data.php',
            type: 'POST',
            data: { id_bank: id },
            success:function(data){
                $("#div_form_bank_soal").html(data);
            },
            error:function(xhr){
                alert("gagal");
            }
        });
        $("#btn_simpan").hide();
        goto_form();
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

    function hapus_function(id,kondisi){
        if(kondisi == true){
            $.ajax({
                url: 'app/pages/models/bank_soal/hapus.php',
                type: "POST",
                data: { idkey : id },
                success: function(hasil){
                    load_list_bank();
                },
                error: function(xhr){
                    pesan_modal("Gagal Ambil Data !");
                }
            });
        }else{
            load_form();
        }
    }

    //END: DELETE FUNCTION -----------------------------------------
    
    $("#btn_simpan").click(function(){
        var hasil_validasi = true;
        var pesan = "";
        
        if($("#input_id_mapel").val() == ""){
            hasil_validasi = false;
            pesan = "Mata Pelajaran Belum Dipilih !";
        }
        if($("#input_id_tingkat").val() == ""){
            hasil_validasi = false;
            pesan = "Tingkat Belum Dipilih !";
        }
        if($("#input_id_pass_bank").val() == ""){
            hasil_validasi = false;
            pesan = "Password Belum Diisi !";
        }
        if($("#input_id_kkm").val() == ""){
            hasil_validasi = false;
            pesan = "Nilai KKM Belum Diisi !";
        }
        if($("#input_id_kartu:checked").val() == undefined){
            hasil_validasi = false;
            pesan = "Soal Belum Dipilih !";
        }

        if(hasil_validasi == true){
            $("#id_form_tambahubah").submit();
        }else{
            pesan_modal(pesan);
        }
    });

    function hasil_simpan(hasil){
        if(hasil == "Berhasil Tambah Bank Soal !"){
            pesan_modal(hasil);
            load_list_bank();
            load_form();
            goto_list();
        }else{
            pesan_modal(hasil);
            load_list_bank();
        }
    }
</script>