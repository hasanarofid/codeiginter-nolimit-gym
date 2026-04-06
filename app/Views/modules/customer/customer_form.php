<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?= anchor(base_url('customer/profil'), 'Back', ['title' => 'back', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
            </div>
            <div class="card-body">
                <?php
                if (!empty(session()->getFlashdata('pesan'))) :
                ?>
                    <?= session()->getFlashdata('pesan') ?>
                <?php
                endif;
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <form name="updateprofil" method="post" action="<?= $action ?>">
                            <?= csrf_field() ?>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="">Tgl. Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_lhr" id="tgl_lhr" class="form-control <?= session('errors.tgl_lhr') ? 'is-invalid' : '' ?> datepicker" value="<?= $detail['tgl_lhr'] == null ? '' : date('Y-m-d', strtotime($detail['tgl_lhr'])); ?>" placeholder="yyyy-mm-dd" readonly="true">
                                    <div class="invalid-feedback">
                                        <?= session('errors.tgl_lhr') ?>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="">No. HP / WA <span class="text-danger">*</span></label>
                                    <input type="text" name="hp_wa" id="hp_wa" class="form-control <?= session('errors.hp_wa') ? 'is-invalid' : '' ?>" value="<?= $detail['hp_wa']; ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.hp_wa') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" name="alamat" id="alamat" value="<?= $detail['alamat'] ?>" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.alamat') ?>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?= $detail['id'] ?>" />
                            <button type="submit" class="btn btn-warning">Ubah</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>