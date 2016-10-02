<?php
$bentuk = $_POST['bentuk'];

if($bentuk == 1){
	?>
		<textarea class="textarea form-control" name="input_id_jawaban" id="input_id_jawaban" style="width: 100%; height: 50px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" cols="30" rows="5" required></textarea>
	<?php
}elseif($bentuk == 2){
	?>
		<select name="input_id_jawaban" id="input_id_jawaban" required>
			<option value="A">A</option>
			<option value="B">B</option>
		</select>
	<?php
}elseif($bentuk == 3){
	?>
		<select name="input_id_jawaban" id="input_id_jawaban" required>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>
		</select>
	<?php
}elseif($bentuk == 4){
	?>
		<select name="input_id_jawaban" id="input_id_jawaban" required>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>
			<option value="D">D</option>
		</select>
	<?php
}elseif($bentuk == 5){
	?>
		<select name="input_id_jawaban" id="input_id_jawaban" required>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>
			<option value="D">D</option>
			<option value="E">E</option>
		</select>
	<?php
}
?>