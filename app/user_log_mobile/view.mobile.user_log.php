
    <div id="c_setting" style="margin:3px;">
        
        <div class="form-group">
            <input type="text" class="form-control" id="text_cari" placeholder="Cari nis atau nama" onkeyup="load_list_siswa();">
        </div>
        <a href="#form_setting" class="btn btn-default form-control" id="btn_setting" data-toggle="collapse" style="width:100%;">Spesifik</a>
		<div id="form_setting" class="row collapse">
    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    			<div class="form-group">
                    <label for="i_tingkat">Kelas</label>
    				<select name="i_tingkat" id="i_tingkat" class="form-control">
    					<option value="" align="center">Semua</option>
						<option value="X">X</option>
						<option value="XI">XI</option>
						<option value="XII">XII</option>
					</select>
    			</div>
    		</div>
    		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    			<div class="form-group">
                    <label for="i_jurusan">Jurusan</label>
    				<select name="i_jurusan" id="i_jurusan" class="form-control">
    					<option value="" align="center">Semua</option>
    					<?php
	    				$qj = $conn->fetch("SELECT id_jurusan,jurusan FROM jurusan_tabel ORDER BY id_jurusan ASC");
	    				for($i=1;$i<count($qj);$i++){
	    					echo "<option value=".$qj[$i]['id_jurusan'].">".$qj[$i]['jurusan']."</option>";
	    				}
	    				?>
					</select>
    			</div>
    		</div>
    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    			<div class="form-group">
					<button type="button" class="btn btn-primary form-control" id="btn_cari">Submit</button>
				</div>
    		</div>
    	</div>
    </div>
	<div id="c_loading" style="text-align:center;display:none;"><b>Loading..</b></div>
    <div id="c_list" style="margin:3px;"></div>
	
	