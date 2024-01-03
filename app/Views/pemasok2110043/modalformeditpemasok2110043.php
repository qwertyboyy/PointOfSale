<div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="modalformeditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalformeditLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pemasok2110043/update', ['class' => 'formsimpan']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Kode Pemasok</label>
                    <input type="text" name="kdpem2110043" id="kdpem2110043" class="form-control form-control-sm" value="<?= $koder; ?>">
                </div>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Pemasok</label>
                    <input type="text" name="namapem2110043" id="namapem2110043" class="form-control form-control-sm" required value="<?= $namar; ?>">
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" name="alamatpem2110043" id="alamatpem2110043" class="form-control form-control-sm" required value="<?= $satuanr; ?>">
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">No telp</label>
                    <input type="text" name="notlp2110043" id="notelp2110043" class="form-control form-control-sm" required value="<?= $hargar; ?>">

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary tombolUpdate">Update</button>
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
                    $('.tombolUpdate').prop('disabled', true);
                    $('.tombolUpdate').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire(
                            'Berhasil',
                            response.sukses,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });

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