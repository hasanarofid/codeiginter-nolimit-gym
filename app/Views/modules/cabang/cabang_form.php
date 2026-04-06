<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('cabang'), 'Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
    </div>
    <div class="card-body">
        <?php
        if (!empty(session()->getFlashdata('pesan'))) :
        ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php
        endif;
        ?>
        <form name="cabang" action="<?= $action ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama">Nama Cabang <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $nama ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nama') ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" value="<?= $alamat ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.alamat') ?>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="kota">Kota <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= session('errors.kota') ? 'is-invalid' : '' ?>" id="kota" name="kota" value="<?= $kota ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.kota') ?>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="telp">Telp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= session('errors.telp') ? 'is-invalid' : '' ?>" id="telp" name="telp" value="<?= $telp ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.telp') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="hp">NO. HP / WA <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= session('errors.hp') ? 'is-invalid' : '' ?>" id="hp" name="hp" value="<?= $hp ?>" placeholder="cth : +6281321654777">
                    <div class="invalid-feedback">
                        <?= session('errors.hp') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $email ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="bank">Nama Bank <span class="text-danger">*</span></label>
                    <input type="text" name="bank" id="bank" class="form-control <?= session('errors.bank_name') ? 'is-invalid' : '' ?>" value="<?= $bank_name ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.bank_name') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="rekening">No Rek. <span class="text-danger">*</span></label>
                    <input type="text" name="rekening" id="rekening" class="form-control <?= session('errors.bank_rek') ? 'is-invalid' : '' ?>" value="<?= $bank_rek ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.bank_rek') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="atas_nama">Atas Nama <span class="text-danger">*</span></label>
                    <input type="text" name="atas_nama" id="atas_nama" class="form-control <?= session('errors.bank_acc_an') ? 'is-invalid' : '' ?>" value="<?= $bank_acc_an ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.bank_acc_an') ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="sosmed">Instagram ID:</label>
                <input type="text" class="form-control" id="sosmed" name="sosmed" value="<?= $sosmed ?>">
            </div>

            <input type="hidden" name="id" value="<?= $id ?>" />
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="<?= $btn_class ?>"><?= $button ?></button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>