<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];
$id_mapel = $_POST['id_mapel'];
if($level == 1){
  $query_kartu = "SELECT draft_kartu_tabel.*, soal_tabel.*
      FROM draft_kartu_tabel
      INNER JOIN soal_tabel ON soal_tabel.id_soal = draft_kartu_tabel.id_soal
      WHERE draft_kartu_tabel.id_mapel = $id_mapel AND draft_kartu_tabel.status_verifikasi = 'sudah'";
}else if($level == 2){
  $query_kartu = "SELECT draft_kartu_tabel.*, soal_tabel.*
      FROM draft_kartu_tabel
      INNER JOIN soal_tabel ON soal_tabel.id_soal = draft_kartu_tabel.id_soal
      WHERE draft_kartu_tabel.id_mapel = $id_mapel AND draft_kartu_tabel.id_guru = $id_guru AND draft_kartu_tabel.status_verifikasi = 'sudah'";
}
$s_mapel = $conn->fetch("SELECT nama_mapel FROM mapel_tabel WHERE id_mapel='$id_mapel'");
$NamaMapel = $s_mapel[0]['nama_mapel'];

$proses_kartu = $conn->fetch($query_kartu);
?>
<label>Kartu Soal <?php echo $NamaMapel; ?> (Terpilih <span id="checked_kartu">0</span> soal)</label>
<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="10%">Pilih &nbsp
          <input type="checkbox" id="check_all">
        </th>
        <th width="10%">ID.</th>
        <th width="70%">Kartu Soal</th>
        <th width="10%">Preview</th>
      </tr>
  </thead>
  <tbody style="overflow-y:auto;height:30px;">
    <?php
      $jumlah_row = count($proses_kartu);
      if($jumlah_row > 0){
          $index = 0;
          $no = 0;
          foreach ($proses_kartu as $key => $data) {
              $index++;
              ?>
              <tr>
                <td align="center">
                    <input type="checkbox" id="input_id_kartu" name="input_id_kartu[]" value="<?php echo $data['id_kartu_soal']; ?>">
                    <input type="hidden" id="primaryoutkartu<?php echo $index;?>" value="<?php echo $data['id_kartu_soal']; ?>">
                </td>
                <td>
                  <?php echo $data['id_soal']; ?>
                </td>
                <td id="soalout<?php echo $index;?>">
                    <?php 
                    echo substr(strip_tags($data['soal']), 0, 80)."...";
                    ?>
                </td>
                <td align="center">
                    <a href="app/pages/preview.php?id=<?php echo $data['id_kartu_soal']; ?>" target="_blank" style="cursor:pointer;"><i class="fa fa-eye"></i></a>
                </td>
              </tr>
              <?php
          }
      }
    ?>
  </tbody>
</table>

<script>
        function count_checked(){
          var len = $("tbody input[type='checkbox']:checked").length;
          var jml = $("tbody input[type='checkbox']").length;
          $("#checked_kartu").html(len);
          if(len == jml){
            $("#check_all").attr('checked','checked');
          }else{
            $("#check_all").removeAttr('checked');
          }
        }
        $("#check_all").change(function(){
            $("tbody input:checkbox").prop('checked', $(this).prop("checked"));
            count_checked();
        });

        $("tbody input[type='checkbox']").click(function(){
          count_checked();
        });
          
        
</script>
<!-- 
<script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>$("#example1").dataTable({ "bSort": false });</script> -->