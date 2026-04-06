<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('trainer'), 'Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
    </div>
    <div class="card-body">
        <form name="trainer" action="<?= $action ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-group col">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $nama ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.nama') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="jenis">Jenis:</label>
                    <select class="form-control <?= session('errors.jenis') ? 'is-invalid' : '' ?>" id="jenis" name="jenis">
                        <option value="">: Pilih Jenis Trainer</option>
                        <?php
                        $arr = ['personal trainer', 'class trainer', 'coach boxing / muaithai'];

                        for ($x = 0; $x < count($arr); $x++) {
                            echo "<option value='$arr[$x]'";
                            echo $arr[$x] == $jenis ? ' selected = "selected"' : '';
                            echo ">";
                            echo ucwords(strtolower($arr[$x]));
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.jenis') ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="telp">Alamat:</label>
                <input type="text" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" value="<?= $alamat ?>">
                <div class="invalid-feedback">
                    <?= session('errors.alamat') ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="kdcab">Cabang</label>
                    <select class="form-control <?= session('errors.kdcab') ? 'is-invalid' : '' ?>" id="kdcab" name="kdcab">
                        <option value="">: Pilih cabang</option>
                        <?php
                        foreach ($cabang as $row) {
                            echo "<option value='$row[id]'";
                            echo $row['id'] == $kdcab ? ' selected="selected"' : '';
                            echo ">$row[nama]</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.kdcab') ?>
                    </div>
                </div>
                <div class="form-group col-3">
                    <label for="hp">HP:</label>
                    <input type="text" class="form-control <?= session('errors.hp') ? 'is-invalid' : '' ?>" id="hp" name="hp" value="<?= $hp ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.hp') ?>
                    </div>
                </div>
                <div class="form-group col-4">
                    <label for="foto">Foto:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input <?= session('errors.foto') ? 'is-invalid' : '' ?>" id="foto" name="foto" onchange="previewImg()" value="">
                        <div class="invalid-feedback">
                            <?= session('errors.foto') ?>
                        </div>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group col-2 text-center">
                    <img class="img-thumbnail img-preview" src="<?= base_url() ?>img/uploads/fp/<?= empty($foto) ? 'user.png' : $foto; ?>" width="95px" />
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>" />
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="<?= $btn_class ?>"><?= $button ?></button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>