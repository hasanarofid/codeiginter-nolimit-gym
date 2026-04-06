<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('membership/category'), 'Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
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
                <label for="nama">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= session('errors.catname') ? 'is-invalid' : '' ?>" id="catname" name="catname" value="<?= $catname ?>">
                <div class="invalid-feedback">
                    <?= session('errors.catname') ?>
                </div>
            </div>

            <input type="hidden" name="catid" value="<?= $catid ?>" />
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="<?= $btn_class ?>"><?= $button ?></button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>