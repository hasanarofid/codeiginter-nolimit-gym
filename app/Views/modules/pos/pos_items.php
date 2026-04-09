<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-2 text-gray-800"><?= $title ?> - <span class="text-primary"><?= $cabang_nama ?></span></h1>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Produk Snack & Minuman</h6>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalItem">
                    <i class="fas fa-plus mr-1"></i> Tambah Item
                </button>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')): ?>
                    <?= session()->getFlashdata('pesan') ?>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered data-tables" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th width="80">Stok</th>
                                <th>Harga</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($items as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->iditem ?></td>
                                    <td><?= $row->nama ?></td>
                                    <td><?= $row->kategori_nama ?></td>
                                    <td class="text-center font-weight-bold <?= $row->stok <= 5 ? 'text-danger' : 'text-success' ?>"><?= $row->stok ?></td>
                                    <td>Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-edit" 
                                                data-id="<?= $row->iditem ?>" 
                                                data-nama="<?= $row->nama ?>" 
                                                data-harga="<?= $row->harga ?>" 
                                                data-stok="<?= $row->stok ?>" 
                                                data-kat="<?= $row->idkat ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('pos/item-delete/' . $row->iditem) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus item ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add/Edit -->
<div class="modal fade" id="modalItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('pos/item-save') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Item Produk</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="iditem" id="iditem">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="idkat" id="idkat" class="form-control" required>
                            <option value="MNM">Minuman</option>
                            <option value="SNK">Snack</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="harga" id="harga" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok Sekarang</label>
                        <input type="number" name="stok" id="stok" class="form-control" value="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const harga = $(this).data('harga');
        const kat = $(this).data('kat');
        const stok = $(this).data('stok');

        $('#modalTitle').text('Edit Item Produk');
        $('#iditem').val(id);
        $('#nama').val(nama);
        $('#harga').val(harga);
        $('#idkat').val(kat);
        $('#stok').val(stok);
        $('#modalItem').modal('show');
    });

    $('#modalItem').on('hidden.bs.modal', function() {
        $('#modalTitle').text('Tambah Item Produk');
        $('#iditem').val('');
        $('#nama').val('');
        $('#harga').val('');
        $('#stok').val('0');
        $('#idkat').val('MNM');
    });
</script>

<?= $this->endSection(); ?>
