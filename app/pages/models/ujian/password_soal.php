<?php 
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_user = $_SESSION['id_usernya'];
$id_bank = $_POST['id_bank'];
?>

       
          <input type="hidden" id="input_id_user" name="input_id_user" value="<?php echo $id_user; ?>">
          <input type="hidden" id="input_id_bank" name="input_id_bank" value="<?php echo $id_bank; ?>">
          <div id="divid_input_pass_soal" class="form-group">
            <label for="input_pass_soal">Password Soal</label>
            <input type="password" class="form-control" id="input_pass_soal" name="input_pass_soal" align="center">
          </div>
        