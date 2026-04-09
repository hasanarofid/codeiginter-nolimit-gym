<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengeluaran Operasional</h6>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalExpense">
                    <i class="fas fa-plus mr-1"></i> Catat Pengeluaran
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
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th class="text-right">Nominal</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($expenses as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('d M Y', strtotime($row->tgl)) ?></td>
                                    <td><?= $row->kategori ?></td>
                                    <td><?= $row->keterangan ?></td>
                                    <td class="text-right font-weight-bold text-danger">Rp <?= number_format($row->nominal, 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('expenses/delete/' . $row->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus catatan ini?')">
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

<!-- Modal Add -->
<div class="modal fade" id="modalExpense" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('expenses/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Catat Pengeluaran Baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tgl" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="Listrik & Air">Listrik & Air</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <option value="Gaji Karyawan">Gaji Karyawan</option>
                            <option value="Belanja Stok F&B">Belanja Stok F&B</option>
                            <option value="Perawatan Alat">Perawatan Alat</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nominal (Rp)</label>
                        <input type="number" name="nominal" class="form-control" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Bayar listrik bulan April"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Simpan Catatan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
