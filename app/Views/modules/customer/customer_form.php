<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="row">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?= anchor(base_url('customer'), 'Back', ['title' => 'back', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
            </div>
            <div class="card-body">
                <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
                    <?= session()->getFlashdata('pesan') ?>
                <?php endif; ?>
                
                <form name="customer_form" method="post" action="<?= $action ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $detail['id'] ?>" />

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kdcab">Cabang <span class="text-danger">*</span></label>
                            <select name="kdcab" id="kdcab" class="form-control <?= session('errors.kdcab') ? 'is-invalid' : '' ?>" <?= $user_cabang != '%' ? 'readonly' : '' ?>>
                                <option value="">: Pilih Cabang</option>
                                <?php foreach ($cabang as $cb) : ?>
                                    <option value="<?= $cb['id'] ?>" <?= $detail['kdcab'] == $cb['id'] ? 'selected' : '' ?>><?= $cb['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($user_cabang != '%') : ?>
                                <input type="hidden" name="kdcab" value="<?= $detail['kdcab'] ?>">
                                <small class="text-muted">Cabang dikunci sesuai login admin.</small>
                            <?php endif; ?>
                            <div class="invalid-feedback">
                                <?= session('errors.kdcab') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_display">ID Customer</label>
                            <input type="text" id="id_display" class="form-control" value="<?= $detail['id'] ?: '(Otomatis)' ?>" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" value="<?= old('nama', $detail['nama']); ?>" required>
                            <div class="invalid-feedback">
                                <?= session('errors.nama') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" value="<?= old('email', $detail['email']); ?>" required <?= $detail['id'] ? 'readonly' : '' ?>>
                            <div class="invalid-feedback">
                                <?= session('errors.email') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="noktp">No. KTP</label>
                            <input type="text" name="noktp" id="noktp" class="form-control <?= session('errors.noktp') ? 'is-invalid' : '' ?>" value="<?= old('noktp', $detail['noktp']); ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.noktp') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hp_wa">No. HP / WA <span class="text-danger">*</span></label>
                            <input type="text" name="hp_wa" id="hp_wa" class="form-control <?= session('errors.hp_wa') ? 'is-invalid' : '' ?>" value="<?= old('hp_wa', $detail['hp_wa']); ?>" required>
                            <div class="invalid-feedback">
                                <?= session('errors.hp_wa') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tgl_lhr">Tgl. Lahir</label>
                            <input type="text" name="tgl_lhr" id="tgl_lhr" class="form-control <?= session('errors.tgl_lhr') ? 'is-invalid' : '' ?> datepicker" value="<?= $detail['tgl_lhr'] ? date('Y-m-d', strtotime($detail['tgl_lhr'])) : ''; ?>" placeholder="yyyy-mm-dd">
                            <div class="invalid-feedback">
                                <?= session('errors.tgl_lhr') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" rows="1"><?= old('alamat', $detail['alamat']) ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors.alamat') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password <?= $detail['id'] ? '<small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>' : '<span class="text-danger">*</span>' ?></label>
                            <input type="password" name="password" id="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" <?= $detail['id'] ? '' : 'required' ?>>
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pass_confirm">Konfirmasi Password <?= $detail['id'] ? '' : '<span class="text-danger">*</span>' ?></label>
                            <input type="password" name="pass_confirm" id="pass_confirm" class="form-control <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>" <?= $detail['id'] ? '' : 'required' ?>>
                            <div class="invalid-feedback">
                                <?= session('errors.pass_confirm') ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary"><?= $detail['id'] ? 'Simpan Perubahan' : 'Tambah Customer' ?></button>
                        <a href="<?= base_url('customer') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>