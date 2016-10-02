<div class="row">

    <button type="button" style="display:none;" id="btn_tampil_modal_confirm"
        data-toggle="modal" data-target="#modalconfirmnya" data-backdrop="static" data-keyboard="false"
    >
        Modal Confirm
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalconfirmnya" tabindex="-1" role="dialog" aria-labelledby="modalLabelconfirm" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabelconfirm">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <p id="p_id_isi_pesan_confirm">zonk!</p>
                </div>
                <div class="modal-footer">
                    <button id="btn_ya" type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
                    <button id="btn_tidak" type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <button type="button" style="display:none;" id="btn_tampil_modal_hasil"
        data-toggle="modal" data-target="#modalhasilnya" data-backdrop="static" data-keyboard="false"
    >
        Modal Hasil
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalhasilnya" tabindex="-1" role="dialog" aria-labelledby="modalLabelhasil" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabelhasil">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <h4>Terima kasih, Anda telah mengerjakan ujian ini. <i class="fa fa-thumbs-o-up fa-2x"></i></h4>
                    <i style="color:#F64747;">*Jika nilai Anda kurang, silahkan menghubungi guru masing-masing.</i>
                </div>
                <div class="modal-footer">
                    <button id="btn_tutup" onclick="tutup_ujian();" type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <button type="button" style="display:none;" id="btn_tampil_modal_alasan"
        data-toggle="modal" data-target="#modalalasannya" data-backdrop="static" data-keyboard="false"
    >
        Modal Alasan
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalalasannya" tabindex="-1" role="dialog" aria-labelledby="modalLabelalasan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabelalasan">Pelanggaran !</h4>
                </div>
                <div class="modal-body">
                      <h4 style="color:red;"><i class="fa fa-exclamation-triangle fa-2x"></i> Anda telah dikeluarkan dari ujian ini.</h4>
                </div>
                <div class="modal-footer">
                    <button id="btn_kirim" onclick="tutup_ujian();" type="button" class="btn btn-default">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- END : JENDELA UJIAN -->

