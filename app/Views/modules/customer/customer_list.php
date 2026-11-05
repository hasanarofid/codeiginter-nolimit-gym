<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('customer/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
        <a href="<?= base_url('customer/export' . (!empty($status_filter) ? '?membership_status=' . $status_filter : '')) ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right mr-2">
            <i class="fas fa-download fa-sm text-white-50"></i> Export Excel
        </a>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm float-right mr-2" data-toggle="modal" data-target="#modalImport">
            <i class="fas fa-upload fa-sm text-white-50"></i> Import Excel
        </button>
        <a href="<?= base_url('customer/template') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right mr-2">
            <i class="fas fa-file-excel fa-sm text-white-50"></i> Template Import
        </a>
    </div>
    <div class="card-body">
        <form method="get" action="<?= base_url('customer') ?>" class="mb-4">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="membership_status">Status Membership</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-filter mr-1"></i> Status Membership</div>
                        </div>
                        <select name="membership_status" id="membership_status" class="form-control form-control-sm" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="aktif" <?= ($status_filter ?? '') === 'aktif' ? 'selected' : '' ?>>Membership Aktif</option>
                            <option value="tidak_aktif" <?= ($status_filter ?? '') === 'tidak_aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                            <option value="na" <?= ($status_filter ?? '') === 'na' ? 'selected' : '' ?>>N.A (Belum Ada Membership)</option>
                        </select>
                    </div>
                </div>
                <?php if (!empty($status_filter)): ?>
                    <div class="col-auto">
                        <a href="<?= base_url('customer') ?>" class="btn btn-sm btn-outline-secondary">Reset Filter</a>
                    </div>
                <?php endif; ?>
            </div>
        </form>
        <?php
        if (!empty(session()->getFlashdata('pesan'))) :
        ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php
        endif;
        ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered data-tables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Member</th>
                        <th>Nama Lengkap</th>
                        <th>Status Membership</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($customers as $row) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td>
                                <?php if ($row['membership_status'] === 'aktif'): ?>
                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Aktif</span>
                                    <br><small class="text-muted">Exp: <?= date('d/m/Y', strtotime($row['expired_date'])) ?></small>
                                <?php elseif ($row['membership_status'] === 'tidak_aktif'): ?>
                                    <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i>Tidak Aktif</span>
                                    <?php if (!empty($row['expired_date'])): ?>
                                        <br><small class="text-muted">Exp: <?= date('d/m/Y', strtotime($row['expired_date'])) ?></small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge badge-secondary px-2 py-1">N.A</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $row['hp_wa'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><img class="img-fluid" src="/img/uploads/member/fp/<?= $row['fp_image'] ?>" width="64" /></td>
                            <td width="210px">
                                <?php
                                echo (in_array($role_array[1], $permission)) ? anchor(base_url('customer/detail/' . $row['id']), '<i class="fas fa-eye fa-sw text-white"></i>', ['title' => 'detail', 'class' => "btn btn-sm btn-info shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[2], $permission)) ? anchor(base_url('customer/edit/' . $row['id']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';
                                if (!empty($row['idcard_image'])) {
                                    echo anchor(base_url('img/uploads/member/ktp/' . $row['idcard_image']), '<i class="fas fa-id-card fa-sw text-white"></i>', ['title' => 'Download KTP', 'class' => "btn btn-sm btn-success shadow-sm mr-1", 'download' => 'KTP_' . $row['id']]);
                                }
                                if (in_array($role_array[3], $permission) || in_array(session()->group, ['SA', 'AD'])) {
                                    echo '<form action="' . base_url('customer/delete/' . $row['id']) . '" method="post" class="d-inline" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus member ' . esc($row['nama']) . ' (' . esc($row['id']) . ')?\')">';
                                    echo csrf_field();
                                    echo '<button type="submit" class="btn btn-sm btn-danger shadow-sm mr-1" title="Hapus Member"><i class="fas fa-trash fa-sw text-white"></i></button>';
                                    echo '</form>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    endforeach;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImportLabel">Import Customer dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/import') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file_excel">File Excel (.xlsx)</label>
                        <input type="file" name="file_excel" class="form-control-file" id="file_excel" accept=".xlsx" required>
                    </div>
                    <div class="alert alert-warning">
                        <small>Pastikan format file sesuai dengan template yang disediakan.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>