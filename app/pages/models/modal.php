
    <button style="display: none;" id="btn_tampil_modal"
        data-toggle="modal" data-target="#modalnya"
    >
        Modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalnya" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <p id="p_id_isi_pesan">zonk!</p>
                </div>
                <div class="modal-footer">
                    <button id="btn_close_pesan" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


    <button style="display: none;" id="btn_tampil_modal_hapus"
        data-toggle="modal" data-target="#modalhapusnya"
    >
        Modal Hapus
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalhapusnya" tabindex="-1" role="dialog" aria-labelledby="modalLabelhapus" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabelhapus">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <input id="idkey" name="idkey" type="hidden">
                    <p id="p_id_isi_pesan_hapus">zonk!</p>
                </div>
                <div class="modal-footer">
                    <button id="btn_ya" type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
                    <button id="btn_tidak" type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>


    <button style="display:none;" id="btn_tampil_modal_besar"
        data-toggle="modal" data-target="#modalnya_besar"
    >
        Modal Besar
    </button>
    <!-- Modal -->
    <div class="modal fade" id="modalnya_besar" tabindex="-1" role="dialog" aria-labelledby="modalLabelbesar" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabelbesar">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <div id="isi_modal_besar">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi, sequi repellat dolor illum nesciunt aperiam totam quibusdam voluptas, tempore. Sunt, repellat quae at dicta. Ad sed atque iusto facere quod!</div>
                </div>
                <div class="modal-footer">
                    <button id="btn_close_pesan" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
