<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('customer/edit/' . $detail['id']), 'Edit Data', ['title' => 'Update', 'class' => "d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm float-right"]) ?>
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
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">ID <span class="float-right font-weight-bold"><?= $detail['id'] ?></span></li>
                    <li class="list-group-item">Cabang <span class="float-right font-weight-bold"><?= $cabang->nama ?></span></li>
                    <li class="list-group-item">No. KTP <span class="float-right font-weight-bold"><?= $detail['noktp'] ?></span></li>
                    <li class="list-group-item">Nama Lengkap <span class="float-right font-weight-bold"><?= $detail['nama'] ?></span></li>
                    <li class="list-group-item">Tgl. Lahir <span class="float-right font-weight-bold"><?= $detail['tgl_lhr'] == null ? 'N.A' : date('d/m/Y', strtotime($detail['tgl_lhr'])) ?></span></li>
                    <li class="list-group-item">No. HP / WA <span class="float-right font-weight-bold"><?= $detail['hp_wa'] == null ? 'xxxx xxxx xxxx' : $detail['hp_wa'] ?></span></li>
                    <li class="list-group-item">E-mail <span class="float-right font-weight-bold"><?= $detail['email'] ?></span></li>
                    <li class="list-group-item">Alamat <br /><?= $detail['alamat'] ?></li>
                </ul>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Barcode</div>

                                        <div class="text-center">
                                            <?= $barcode ?><br />
                                            <small><?= $detail['id'] ?></small><br/>
                                            <a href="#" data-toggle="modal" data-target="#modalDownloadBarcode" class="btn btn-sm btn-primary mt-3">
                                                <i class="fas fa-download"></i> Download Barcode
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-barcode fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Membership Expired</div>
                                        <?php
                                        if ($expired && $expired->expired_date != null):
                                        ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= date('D, d M Y', strtotime($expired->expired_date)) ?></div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Download Barcode -->
<div class="modal fade" id="modalDownloadBarcode" tabindex="-1" aria-labelledby="modalDownloadBarcodeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDownloadBarcodeLabel">Pilih Wallpaper Barcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/barcode/download-bg/' . $detail['id']) ?>" method="get">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Wallpaper <span class="text-danger">*</span></label>
                        <select class="form-control" name="bg" required>
                            <option value="">: Pilih Wallpaper</option>
                            <option value="Boxing.jpg">Boxing</option>
                            <option value="Conquer.jpg">Conquer</option>
                            <option value="NL Team.jpg">NL Team</option>
                            <option value="Trust the Process.jpg">Trust the Process</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Download</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>