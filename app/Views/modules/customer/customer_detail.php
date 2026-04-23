<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('customer'), 'Back', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
        <?php if (in_array(session()->group, ['SA', 'AD', 'OP'])): ?>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right mr-2" data-toggle="modal" data-target="#modalPerpanjang">
                <i class="fas fa-plus fa-sm text-white-50"></i> Perpanjang
            </button>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-5 bg-dark d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Header Menu</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 19px, 0px);">
                                <div class="dropdown-header">Dropdown Menu:</div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#fp">Edit Foto</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ktps">Edit Ktp</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title mt-4 mb-0"><?= $detail['nama'] ?></h5>
                        <span><?= $detail['email'] ?> | <?= $detail['hp_wa'] == null ? '+62xx xxxx xxxx' : $detail['hp_wa'] ?></span>
                        <p class="card-text mt-2"><?= $detail['id'] ?> | <?= $cabang->nama ?></span></p>
                        <p class="card-text mt-2"><?= $detail['tgl_lhr'] == null ? 'N.A' : date('d/m/Y', strtotime($detail['tgl_lhr'])) ?></p>
                        <p class="card-text mt-2"><?= $detail['alamat'] ?></p>
                        <br />
                        <img class="img-fluid" src="/img/uploads/member/ktp/<?= $detail['idcard_image'] ?>" width="350" />
                    </div>
                    <div class="position-absolute profile-pic-wrapper">
                        <img src="/img/uploads/member/fp/<?= $detail['fp_image'] ?>" width="64" class="rounded-circle img-thumbnail" alt="Mads Obel">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
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
        <div class="row mt-4">
            <div class="col-md-12">
                <hr />
                <?php
                if (!empty(session()->getFlashdata('pesan'))) :
                ?>
                    <?= session()->getFlashdata('pesan') ?>
                <?php
                endif;
                ?>

                <?php
                if (!empty(session()->getFlashdata('konfirmpass'))) :
                ?>
                    <?= session()->getFlashdata('konfirmpass') ?>
                <?php
                endif;
                ?>
                <h3>Tabel Transaksi Membership</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered data-tables">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl. Daftar</th>
                                <th>Paket ID</th>
                                <th>Paket</th>
                                <th>Nominal</th>
                                <th>Jenis Byr</th>
                                <th>Tgl. Byr</th>
                                <th>Status</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($membership as $mbr):
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= date('d/m/Y', strtotime($mbr->created_at)) ?></td>
                                    <td><?= $mbr->membershipid ?></td>
                                    <td><?= ucwords(strtolower($mbr->nama)) ?></td>
                                    <td><?= number_format($mbr->nominal, 0, '.', ',') ?></td>
                                    <td><?= $mbr->payment_type ?></td>
                                    <td><?= $mbr->payment_date == null ? 'N.A' : date('d/m/Y', strtotime($mbr->payment_date)) ?></td>
                                    <td>
                                        <?php
                                        if ($mbr->payment_date == null) {
                                            echo '<span class="badge badge-warning">Pending</span>';
                                        } else {
                                            echo $mbr->status == 0 ? '<span class="badge badge-danger">Not Active</span>' : ($mbr->status == 2 ? '<span class="badge badge-secondary">Expired</span>' : '<span class="badge badge-success">Active</span>');
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($mbr->payment_date == null) :
                                        ?>
                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#exampleModal<?= $no ?>">
                                                Pembayaran
                                            </button>
                                        <?php
                                        endif;
                                        ?>
                                    </td>
                                </tr>

                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $no ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form name="konfirm" method="post" action="<?= base_url('/payment/confirm') ?>">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="payment_date">Konfirm. Tanggal Pembayaran <span class="text-danger">*</span></label>
                                                        <input type="text" name="payment_date" id="payment_date<?= $no ?>" class="form-control datepicker" placeholder="yyyy-mm-dd" required="required" readonly="true">
                                                    </div>

                                                    <input type="hidden" name="idtrx" value="<?= $mbr->id ?>" />
                                                    <input type="hidden" name="idcust" value="<?= $detail['id'] ?>" />
                                                    <input type="hidden" name="memid" value="<?= $mbr->membershipid ?>" />
                                                    <input type="hidden" name="renew" value="<?= $renewal > 1 ? 1 : 0; ?>" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                            <script>
                                                $(function() {
                                                    $("#payment_date<?= $no ?>").datepicker({
                                                        dateFormat: "yy-mm-dd",
                                                        changeMonth: true,
                                                        changeYear: true,
                                                        yearRange: "c-80:c+0"
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Fp-->
<div class="modal fade" id="fp" tabindex="-1" aria-labelledby="fpLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fpLabel">Edit Foto Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="upfp" method="post" action="<?= base_url('customer/update_foto') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fp">Foto Profile <span class="text-danger">*</span></label>
                        <input type="file" name="fp" id="fp" class="form-control" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $detail['id'] ?>" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Fp-->
<div class="modal fade" id="ktps" tabindex="-1" aria-labelledby="ktpsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ktpsLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="upktps" method="post" action="<?= base_url('customer/update_ktp') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ktp">KTP <span class="text-danger">*</span></label>
                        <input type="file" name="ktp" id="ktp" class="form-control" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $detail['id'] ?>" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (in_array(session()->group, ['SA', 'AD', 'OP'])): ?>
<!-- Modal Perpanjangan -->
<div class="modal fade" id="modalPerpanjang" tabindex="-1" aria-labelledby="modalPerpanjangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPerpanjangLabel">Form Perpanjangan Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('membership-renewal') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cabang <span class="text-danger">*</span></label>
                        <select class="form-control" name="cabang" id="renew_cabang" required>
                            <option value="">: Pilih Cabang</option>
                            <?php foreach ($cabangs as $b): ?>
                                <option value="<?= $b['id'] ?>" <?= $detail['kdcab'] == $b['id'] ? 'selected' : '' ?>><?= $b['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Paket Membership <span class="text-danger">*</span></label>
                        <select class="form-control" name="paket" id="renew_paket" required>
                            <option value="">: Pilih Paket</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Metode Bayar <span class="text-danger">*</span></label>
                        <select name="payment" class="form-control" required>
                            <option value="">: Metode Bayar</option>
                            <option value="Cash">Cash</option>
                            <option value="Qris">Qris</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <input type="hidden" name="idcust" value="<?= $detail['id'] ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perpanjangan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    function loadPaket(cabangId) {
        if (cabangId) {
            $('#renew_paket').empty().append('<option value="">: Loading...</option>');
            $.ajax({
                url: `<?= base_url("membership/getPaketByCabang") ?>/${cabangId}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#renew_paket').empty().append('<option value="">: Pilih Paket</option>');
                    response.forEach(function(paket) {
                        $('#renew_paket').append(`<option value="${paket.id}">${paket.category} ${paket.nama} - ${paket.nominal}</option>`);
                    });
                }
            });
        }
    }

    // Load initial packages for the selected branch
    loadPaket($('#renew_cabang').val());

    $('#renew_cabang').on('change', function() {
        loadPaket($(this).val());
    });
});
</script>
<?php endif; ?>

<?= $this->endSection(); ?>