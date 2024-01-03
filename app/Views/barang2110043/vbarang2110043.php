<?= $this->extend('template/template') ?>
<?= $this->section('isi') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-primary tombolTambah">
                        <i class="fa fa-plus"></i>Tambah Data
                    </button>
                </div>
            </div>

        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="barang2110043/index">
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama Barang" name="caribarang" autofocus value="<?= $cari; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombolbarang">Cari</button>
                    </div>
                </div>
            </form>
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan Barang</th>
                        <th>Harga Barang</th>
                        <th>Stok Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1 + (($nohalaman - 1) * 5);
                    foreach ($databarang as $row) :
                    ?>
                        <tr>
                            <td><?= $nomor++; ?></td>
                            <td><?= $row['kdbrg2110043'] ?></td>
                            <td><?= $row['namabrg2110043'] ?></td>
                            <td><?= $row['satuanbrg2110043'] ?></td>
                            <td><?= $row['hargabrg2110043'] ?></td>
                            <td><?= $row['stokbrg2110043'] ?></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" title="Hapus Barang" onclick="hapus('<?= $row['kdbrg2110043'] ?>','<?= $row['namabrg2110043'] ?>')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <button type="button" class="btn btn-info btn-sm" title="Edit Barang" onclick="edit('<?= $row['kdbrg2110043'] ?>')">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="float-center">
                <?= $pager->links('barang2110043', 'paging_data'); ?>
            </div>
        </div>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<div class="viewmodaledit" style="display: none;"></div>

<script>
    $(document).ready(function() {
        $('.tombolTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('barang2110043/formTambah') ?>",
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

    function hapus(kdbrg2110043, nama, satuan, harga, stok) {
        Swal.fire({
            title: 'Hapus Barang',
            html: `Yakin Hapus Nama Barang <strong>${kdbrg2110043}</strong> ini ?`,
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
                    url: "<?= site_url('Barang2110043/hapus') ?>",
                    data: {
                        kdbrg2110043: kdbrg2110043
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

    function edit(kdbrg2110043) {
        $.ajax({
            type: "post",
            url: "<?= site_url('barang2110043/FormEdit') ?>",
            data: {
                kdbrg2110043: kdbrg2110043
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