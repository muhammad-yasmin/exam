<?php 
      $siswa_id = $_SESSION['id_usernya'];
      $que_kartu = mysql_query("SELECT * FROM isi_soal_tabel WHERE id_bank_soal_ujian='$id_bank'");
      while ($r_kartu = mysql_fetch_assoc($que_kartu)) {
        $kartu_id = $r_kartu['id_kartu_soal'];
        $q_j = "SELECT * FROM pilihan_jawab_tabel WHERE id_siswa='$siswa_id' AND id_bank_soal_ujian='$id_bank' AND id_kartu_soal='$kartu_id' ORDER BY id_pilihan_jawab DESC";
        
        $que_jawaban = mysql_query($q_j);
        $r_jawab = mysql_fetch_assoc($que_jawaban);
        $jwb = $r_jawab['jawaban'];
        echo "<h1>#radios".$kartu_id."_".$jwb."</h1><br>";
        ?>
        <script>
          $("#radios<?php echo $kartu_id; ?>_<?php echo $jwb; ?>").attr('checked', 'checked');
        </script>
        <?php
      }
      ?>