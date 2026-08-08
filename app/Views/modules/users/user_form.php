<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="row justify-content-md-center">
    <div class="col-md-7">
        <?php if (!empty(session()->getFlashdata('pesan'))): ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('errors'))): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $e): ?>
                        <li><?= $e ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3"><?= $title ?></div>
            <div class="card-body">
                <form method="post" action="<?= $action ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                                value="<?= $username ?>" <?= !empty($id) ? 'readonly' : '' ?> required>
                            <div class="invalid-feedback"><?= session('errors.username') ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                                value="<?= $nama ?>" required>
                            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="group">Role <span class="text-danger">*</span></label>
                            <select name="group" id="group" class="form-control <?= session('errors.group') ? 'is-invalid' : '' ?>" required>
                                <option value="">-- Pilih Role --</option>
                                <?php foreach ($groups as $g): ?>
                                    <option value="<?= $g->groupid ?>" <?= $group === $g->groupid ? 'selected' : '' ?>>
                                        <?= esc($g->nama) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.group') ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kdcab">Cabang <span class="text-danger">*</span></label>
                            <select name="kdcab" id="kdcab" class="form-control <?= session('errors.kdcab') ? 'is-invalid' : '' ?>" required>
                                <option value="">-- Pilih Cabang --</option>
                                <?php foreach ($cabangs as $c): ?>
                                    <option value="<?= $c['id'] ?>" <?= ($kdcab ?? '') === $c['id'] ? 'selected' : '' ?>>
                                        <?= esc($c['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.kdcab') ?></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">
                                Password <?= empty($id) ? '<span class="text-danger">*</span>' : '<small class="text-muted">(kosongkan jika tidak diubah)</small>' ?>
                            </label>
                            <input type="password" name="password" id="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                                <?= empty($id) ? 'required' : '' ?> minlength="6" placeholder="min. 6 karakter">
                            <div class="invalid-feedback"><?= session('errors.password') ?></div>
                        </div>
                        <?php if (!empty($id)): ?>
                        <div class="form-group col-md-6">
                            <label for="ket">Status</label>
                            <select name="ket" id="ket" class="form-control">
                                <option value="active"   <?= ($ket ?? 'active') === 'active'   ? 'selected' : '' ?>>Aktif</option>
                                <option value="disabled" <?= ($ket ?? '')        === 'disabled' ? 'selected' : '' ?>>Nonaktif</option>
                            </select>
                        </div>
                        <?php endif; ?>
                    </div>

                    <hr>
                    <?= anchor(base_url('admin/users'), 'Batal', ['class' => 'btn btn-secondary']) ?>
                    <button type="submit" class="<?= $btn_class ?>"><?= $button ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
