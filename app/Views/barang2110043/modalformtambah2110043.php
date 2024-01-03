<div class="modal fade" id="modaltambahbarang" tabindex="-1" aria-labelledby="modaltambahabarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahbarangLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('barang2110043/simpandata', ['class' => 'formsimpan']) ?>
            <input type="hidden" name="aksi" id="aksi" value="<?= $aksi; ?>">
            <div class="modal_body">
                <div class="form-group">
                    <label form="">Kode Barang</label>
                    <input type="text" name="kode" id="kode" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label form="">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label form="">Satuan Barang</label>
                    <input type="text" name="satuan" id="satuan" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label form="">Harga Barang</label>
                    <input type="text" name="harga" id="harga" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label form="">Stok Barang</label>
                    <input type="text" name="stok" id="stok" class="form-control form-control-sm" required>
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