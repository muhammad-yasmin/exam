<?php 
$jenisnya = $_GET['jenis'];
?>
<div class="pad">
    <textarea class="textareapem" id="input_id_isi_pembahasan" name="input_id_isi_pembahasan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
</div>
<script>
  $(document).ready(function() {
        CKEDITOR.replace('input_id_isi_pembahasan');
      });
</script>
