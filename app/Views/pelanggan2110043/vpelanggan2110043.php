<?= $this->extend('template/template') ?>
<?= $this->section('isi') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-primary tombolTambah">
                <i class="fa fa-plus"></i>Tambah Data
            </button>
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="/pelanggan2110043/index">
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama pelanggan" name="caripelanggan" autofocus value="<?= $cari; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombolpelanggan">Cari</button>
                    </div>
                </div>
            </form>
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Notelp</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1 + (($nohalaman - 1) * 10);
                    foreach ($databarang as $row) :
                    ?>
                        <tr>
                            <td><?= $nomor++; ?></td>
                            <td><?= $row['kdplg2110043'] ?></td>
                            <td><?= $row['namaplg2110043'] ?></td>
                            <td><?= $row['alamatplg2110043'] ?></td>
                            <td><?= $row['notlp2110043'] ?></td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm" title="Hapus Barang" onclick="hapus('<?= $row['kdplg2110043'] ?>','<?= $row['namaplg2110043'] ?>')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" class="btn btn-info btn-sm" title="Edit Barang" onclick="edit('<?= $row['kdplg2110043'] ?>')">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="float-center">
                <?= $pager->links('pelanggan2110043', 'paging_data'); ?>
            </div>
        </div>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>

<script>
    $(document).ready(function() {
        $('.tombolTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pelanggan2110043/formTambah') ?>",
                dataType: "json",
                type: 'post',
                data: {
                    aksi: 0
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('.modaltambahbarang').on('shown.bs.modal', function(event) {
                            $('#kode').focus();
                        });
                        $('#modaltambahbarang').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function hapus(kode, nama, satuan, harga, stok) {
        Swal.fire({
            title: 'Hapus Pelanggan',
            html: `Yakin Hapus Nama Pelanggan <strong>${nama}</strong> ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus !',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('pelanggan2110043/hapus') ?>",
                    data: {
                        kdplg2110043: kode
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }



    function edit(koder) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pelanggan2110043/formedit') ?>",
            data: {
                koder: koder
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalformedit').on('shown.bs.modal', function(event) {
                        $('#namabrg').focus();
                    });
                    $('#modalformedit').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<?= $this->endSection('') ?>