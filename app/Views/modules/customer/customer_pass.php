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
                        <form name="updatepass" method="post" action="<?= $action ?>">
                            <?= csrf_field() ?>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="">Nama Member</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $detail['nama']; ?>" readonly="true">
                                </div>
                                <div class="form-group col">
                                    <label for="">ID Member</label>
                                    <input type="text" name="idmem" id="idmem" class="form-control" value="<?= $detail['id']; ?>" readonly="true">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="">Password Lama <span class="text-danger">*</span></label>
                                    <input type="password" name="passlama" id="passlama" value="" class="form-control <?= session('errors.passlama') ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.passlama') ?>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="">Password Baru <span class="text-danger">*</span></label>
                                    <input type="password" name="passbaru" id="passbaru" value="" class="form-control <?= session('errors.passbaru') ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.passbaru') ?>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="">Ulangi Password Baru <span class="text-danger">*</span></label>
                                    <input type="password" name="pass2" id="pass2" value="" class="form-control <?= session('errors.pass2') ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.pass2') ?>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="email" value="<?= $detail['email'] ?>" />
                            <button type="submit" class="btn btn-warning">Ubah Password</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>