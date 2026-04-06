<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('boxing'), 'Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
    </div>
    <div class="card-body">
        <form name="kelas" action="<?= $action ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama">Nama Jadwal <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $nama ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nama') ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="kdcab">Lokasi <span class="text-danger">*</span></label>
                    <select class="form-control <?= session('errors.kdcab') ? 'is-invalid' : '' ?>" id="kdcab" name="kdcab">
                        <option value="">: Pilih Lokasi</option>
                        <?php
                        foreach ($cabang as $cab) {
                            echo "<option value='$cab[id]'";
                            echo $kdcab == $cab['id'] ? " selected = 'selected'" : "";
                            echo ">$cab[nama]</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.kdcab') ?>
                    </div>
                </div>

                <div class="form-group col">
                    <label for="trainer">Trainer <span class="text-danger">*</span></label>
                    <select class="form-control <?= session('errors.trainer') ? 'is-invalid' : '' ?>" id="trainer" name="trainer">
                        <option value="">: Pilih Trainer</option>
                        <?php
                        foreach ($trainers as $trn) {
                            echo "<option value='$trn[id]'";
                            echo $trn['id'] == $trainer ? ' selected="selected"' : "";
                            echo ">$trn[nama] ($trn[nmcab])</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.trainer') ?>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="hari">Hari <span class="text-danger">*</span></label>
                    <?php
                    $dayname = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    ?>
                    <select class="form-control <?= session('errors.hari') ? 'is-invalid' : '' ?>" id="hari" name="hari">
                        <option value="">: Pilih Hari</option>
                        <?php
                        for ($i = 0; $i < count($dayname); $i++) {
                            echo "<option value='$dayname[$i]'";
                            echo $hari == $dayname[$i] ? ' selected="selected"' : '';
                            echo ">$dayname[$i]</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.hari') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="jam_mulai">Jam Mulai <span class="text-danger">*</span></label>
                    <input type="time" class="form-control <?= session('errors.jam_mulai') ? 'is-invalid' : '' ?>" id="jam_mulai" name="jam_mulai" value="<?= $jam_mulai ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.jam_mulai') ?>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="jam_akhir">Jam Akhir <span class="text-danger">*</span></label>
                    <input type="time" class="form-control <?= session('errors.jam_akhir') ? 'is-invalid' : '' ?>" id="jam_akhir" name="jam_akhir" value="<?= $jam_akhir ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.jam_akhir') ?>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>" />
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="<?= $btn_class ?>"><?= $button ?></button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>