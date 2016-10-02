<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_user = $_SESSION['id_usernya'];
?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6">
        <input type="hidden" id="input_id_mapel" name="input_id_mapel">
        <input type="hidden" id="i_id_kd" name="i_id_kd">
        <div id="divid_materi_pokok" class="form-group">
            <input id="idf" value="1" type="hidden" />
            <table class="table">
                <thead>
                    <tr>
                        <th>Materi Pokok</th>
                        <th width="30px"><a href="#" onclick="tambahinput();">Tambah(+)</a></th>
                    </tr>
                </thead>
                <tbody id="tbody_id_materi">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
         
     </div> 

<script language="javascript">
   function tambahinput() {
     var idf = document.getElementById("idf").value;
     var stre;
     stre="<tr id='tr_append"+idf+"'>"
        +"<td><input type='text' class='form-control' id='input_text_materi[]' name='input_text_materi[]'></td>"
        +"<td align='center'><a href='#' onclick='hapusElemen(\"#tr_append" + idf + "\"); return false;' title='Hapus'><i class='fa fa-remove'></i></a></td></tr>";

     $("#tbody_id_materi").append(stre);
     idf = (idf-1) + 2;
     document.getElementById("idf").value = idf;
   }
   function hapusElemen(idf) {
     $(idf).remove();
   }
</script>