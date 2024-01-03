<div class="modal fade" id="modaltambahbarang" tabindex="-1" aria-labelledby="modaltambahabarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahbarangLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pelanggan2110043/simpandata', ['class' => 'formsimpan']) ?>
            <input type="hidden" name="aksi" id="aksi" value="<?= $aksi; ?>">
            <div class="modal_body">
                <div class="form-group">
                    <label form="">Kode Pelanggan</label>
                    <input type="text" name="koder" id="koder" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label form="">Nama Pelanggan</label>
                    <input type="text" name="namar" id="namar" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label form="">Alamat</label>
                    <input type="text" name="satuanr" id="satuanr" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label form="">Notelp</label>
                    <input type="text" name="hargar" id="hargar" class="form-control form-control-sm" required>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary tombolSimpan">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(e) {
                    $('.tombolSimpan').prop('disabled', true);
                    $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    let aksi = $('#aksi').val();
                    if (response.sukses) {
                        if (aksi == 0) {
                            Swal.fire(
                                'Berhasil',
                                response.sukses,
                                'success'
                            ).then((result) => {
                                if ((result.isConfirmed)) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            tampilbarang();
                            $('#modaltambahbarang').modal('hide');
                        }
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>