<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('admin/users/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Tambah User', ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right']) : '' ?>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('pesan'))): ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-sm table-striped data-tables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Cabang</th>
                        <th>Status</th>
                        <th><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($u['UserID']) ?></td>
                        <td><?= esc($u['Nama']) ?></td>
                        <td><span class="badge badge-<?= $u['UserGroup'] === 'SA' ? 'danger' : ($u['UserGroup'] === 'AD' ? 'primary' : 'info') ?>"><?= esc($u['group_nama']) ?></span></td>
                        <td><?= esc($u['cabang_nama'] ?? '-') ?></td>
                        <td>
                            <?php if ($u['Ket'] === 'active'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td width="130px">
                            <?= (in_array($role_array[2], $permission)) ? anchor(base_url('admin/users/edit/' . $u['UserID']), '<i class="fas fa-edit"></i>', ['class' => 'btn btn-sm btn-warning mr-1']) : '' ?>
                            <?php if (in_array($role_array[2], $permission)): ?>
                                <form action="<?= base_url('admin/users/toggle/' . $u['UserID']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm <?= $u['Ket'] === 'active' ? 'btn-secondary' : 'btn-success' ?>"
                                        onclick="return confirm('<?= $u['Ket'] === 'active' ? 'Nonaktifkan' : 'Aktifkan' ?> user ini?')">
                                        <i class="fas <?= $u['Ket'] === 'active' ? 'fa-ban' : 'fa-check' ?>"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
