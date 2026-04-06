<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('membership'), 'Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
    </div>
    <div class="card-body">
        <form name="kelas" action="<?= $action ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nama">Nama Paket <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $nama ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.nama') ?>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="catid">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control <?= session('errors.catid') ? 'is-invalid' : '' ?>" name="catid" id="catid">
                        <option value="">: Pilih Kategori</option>
                        <?php
                        foreach ($category as $cat):
                            echo "<option value='$cat[catid]'";
                            echo $cat['catid'] == $catid ? ' selected="selected"' : '';
                            echo ">$cat[catname]</option>";
                        endforeach;
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.catid') ?>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="kota">Wilayah / Kota <span class="text-danger"></span></label>
                    <select class="form-control <?= session('errors.kota') ? 'is-invalid' : '' ?>" name="kota" id="kota">
                        <option value="">: Pilih Kota</option>
                        <?php
                        foreach ($cities as $ct):
                            echo "<option value='$ct->kota'";
                            echo $ct->kota == $kota ? ' selected="selected"' : '';
                            echo ">" . ucfirst(strtolower($ct->kota)) . "</option>";
                        endforeach;
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.kota') ?>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="nominal">Biaya <span class="text-danger">*</span></label>
                    <input type="number" class="form-control <?= session('errors.nominal') ? 'is-invalid' : '' ?>" id="nominal" name="nominal" value="<?= $nominal ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.nominal') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="expired">Jangka Waktu (bulan) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control <?= session('errors.expired') ? 'is-invalid' : '' ?>" id="expired" name="expired" value="<?= $expired ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.expired') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="deskripsi">Deskripsi </label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $deskripsi ?>">
                    <small class="help-text">Pisahkan dengan koma jika lebih dari satu</small>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>" />
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="<?= $btn_class ?>"><?= $button ?></button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>