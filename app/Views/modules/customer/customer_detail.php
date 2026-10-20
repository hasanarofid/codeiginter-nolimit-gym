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
        <?php if (in_array(session()->group, ['SA', 'AD']) || in_array($role_array[3] ?? '', $permission ?? [])): ?>
            <form action="<?= base_url('customer/delete/' . $detail['id']) ?>" method="post" class="d-inline float-right mr-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus member <?= esc($detail['nama']) ?> (<?= esc($detail['id']) ?>)? Semua data membership dan kunjungan terkait juga akan dihapus.')">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                    <i class="fas fa-trash fa-sm text-white-50"></i> Hapus Member
                </button>
            </form>
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
                        <?php if (!empty($detail['idcard_image'])): ?>
                            <img class="img-fluid" src="/img/uploads/member/ktp/<?= $detail['idcard_image'] ?>" width="350" /><br/>
                            <a href="<?= base_url('img/uploads/member/ktp/' . $detail['idcard_image']) ?>" download="KTP_<?= $detail['id'] ?>" class="btn btn-sm btn-success mt-2">
                                <i class="fas fa-download mr-1"></i> Download Foto KTP
                            </a>
                        <?php else: ?>
                            <small class="text-muted">Foto KTP belum diunggah</small>
                        <?php endif; ?>
                    </div>
                    <div class="position-absolute profile-pic-wrapper">
                        <img src="/img/uploads/member/fp/<?= $detail['fp_image'] ?>" width="64" class="rounded-circle img-thumbnail" alt="Mads Obel">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Membership Expired</div>
                                <?php if ($expired && $expired->expired_date != null): ?>
                                    <div class="h5 mb-3 font-weight-bold text-gray-800"><?= date('D, d M Y', strtotime($expired->expired_date)) ?></div>
                                <?php else: ?>
                                    <div class="h5 mb-3 font-weight-bold text-gray-800 text-danger">N.A</div>
                                <?php endif; ?>
                                
                                <hr/>

                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Barcode</div>
                                <?= $barcode ?>
                                <br/>
                                <small><?= $detail['id'] ?></small>
                                <br/>
                                <a href="#" data-toggle="modal" data-target="#modalDownloadBarcode" class="btn btn-sm btn-primary shadow-sm mt-3">
                                    <i class="fas fa-download fa-sm text-white-50"></i> Download Barcode
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-id-card fa-2x text-gray-300"></i>
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
                                <th>Periode</th>
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
                                    <td><?= $mbr->payment_date == null ? 'N.A' : date('d-m-Y', strtotime($mbr->payment_date)) . ' s/d ' . ($mbr->expired_date ? date('d-m-Y', strtotime($mbr->expired_date)) : 'N.A') ?></td>
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
                                        <?php if ($mbr->payment_date == null) : ?>
                                            <button type="button" class="btn btn-sm btn-secondary mr-1 mb-1" data-toggle="modal" data-target="#exampleModal<?= $no ?>">
                                                Pembayaran
                                            </button>
                                        <?php endif; ?>
                                        <?php if (in_array(session()->group, ['SA', 'AD', 'OP'])): ?>
                                            <button type="button" class="btn btn-sm btn-info mr-1 mb-1" data-toggle="modal" data-target="#modalEditDate<?= $no ?>" title="Edit Tanggal Membership">
                                                <i class="fas fa-calendar-alt"></i> Edit Tanggal
                                            </button>
                                        <?php endif; ?>
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
                                                        yearRange: "c-80:c+0",
                                                        beforeShow: function(input) {
                                                            return {
                                                                appendTo: $(input).closest('.modal-body')
                                                            };
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <?php if (in_array(session()->group, ['SA', 'AD', 'OP'])): ?>
                                <!-- Modal Edit Tanggal -->
                                <div class="modal fade" id="modalEditDate<?= $no ?>" tabindex="-1" aria-labelledby="modalEditDateLabel<?= $no ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditDateLabel<?= $no ?>">Edit Tanggal Membership</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url('membership/update-dates') ?>">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body text-left">
                                                    <div class="alert alert-info py-2">
                                                        <small><strong>Paket:</strong> <?= esc(ucwords(strtolower($mbr->nama))) ?> | <strong>ID:</strong> <?= esc($mbr->id) ?></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_payment_date<?= $no ?>">Tgl. Mulai (Periode) <span class="text-danger">*</span></label>
                                                        <input type="text" name="payment_date" id="edit_payment_date<?= $no ?>" class="form-control datepicker" placeholder="yyyy-mm-dd" value="<?= $mbr->payment_date ? date('Y-m-d', strtotime($mbr->payment_date)) : date('Y-m-d') ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_expired_date<?= $no ?>">Tgl. Expired (Berakhir) <span class="text-danger">*</span></label>
                                                        <input type="text" name="expired_date" id="edit_expired_date<?= $no ?>" class="form-control datepicker" placeholder="yyyy-mm-dd" value="<?= $mbr->expired_date ? date('Y-m-d', strtotime($mbr->expired_date)) : '' ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_status<?= $no ?>">Status Transaksi</label>
                                                        <select name="status" id="edit_status<?= $no ?>" class="form-control">
                                                            <option value="1" <?= $mbr->status == 1 ? 'selected' : '' ?>>Active</option>
                                                            <option value="2" <?= $mbr->status == 2 ? 'selected' : '' ?>>Expired</option>
                                                            <option value="0" <?= $mbr->status == 0 ? 'selected' : '' ?>>Pending / Not Active</option>
                                                        </select>
                                                    </div>

                                                    <input type="hidden" name="idtrx" value="<?= $mbr->id ?>">
                                                    <input type="hidden" name="idcust" value="<?= $detail['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                            <script>
                                                $(function() {
                                                    $("#edit_payment_date<?= $no ?>, #edit_expired_date<?= $no ?>").datepicker({
                                                        dateFormat: "yy-mm-dd",
                                                        changeMonth: true,
                                                        changeYear: true,
                                                        yearRange: "c-80:c+10",
                                                        beforeShow: function(input) {
                                                            return {
                                                                appendTo: $(input).closest('.modal-body')
                                                            };
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
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
                    <div class="form-group">
                        <label>Tgl. Mulai (Periode) <span class="text-danger">*</span></label>
                        <input type="text" name="payment_date" id="renew_payment_date" class="form-control datepicker" placeholder="yyyy-mm-dd" value="<?= date('Y-m-d') ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label>Tgl. Berakhir (Expired) <span class="text-danger">*</span></label>
                        <input type="text" name="expired_date" id="renew_expired_date" class="form-control datepicker" placeholder="yyyy-mm-dd" required="required">
                        <small class="form-text text-muted">Tanggal expired terisi otomatis sesuai durasi paket, namun dapat diubah manual.</small>
                    </div>
                    <?php if ($expired && !empty($expired->expired_date) && strtotime($expired->expired_date) >= strtotime(date('Y-m-d'))): ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="renew_accumulate" name="accumulate" value="1">
                        <label class="form-check-label" for="renew_accumulate">
                            Akumulasikan dari sisa membership aktif (s/d <?= date('d-m-Y', strtotime($expired->expired_date)) ?>)
                        </label>
                    </div>
                    <?php endif; ?>
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

<script>
$(document).ready(function() {
    $("#renew_payment_date, #renew_expired_date").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: "c-80:c+10",
        beforeShow: function(input) {
            return {
                appendTo: $(input).closest('.modal-body')
            };
        }
    });

    const activeExpDate = "<?= ($expired && !empty($expired->expired_date)) ? date('Y-m-d', strtotime($expired->expired_date)) : '' ?>";

    function updateCalculatedExpired() {
        const selectedOption = $('#renew_paket').find('option:selected');
        const months = parseInt(selectedOption.data('expired')) || 0;
        const isAccumulate = $('#renew_accumulate').is(':checked');
        
        let baseDateStr = $('#renew_payment_date').val();
        if (isAccumulate && activeExpDate) {
            baseDateStr = activeExpDate;
        }

        if (baseDateStr && months > 0) {
            const parts = baseDateStr.split('-');
            if (parts.length === 3) {
                const year = parseInt(parts[0], 10);
                const month = parseInt(parts[1], 10) - 1; // 0-indexed
                const day = parseInt(parts[2], 10);
                
                const d = new Date(year, month + months, day);
                const yyyy = d.getFullYear();
                const mm = String(d.getMonth() + 1).padStart(2, '0');
                const dd = String(d.getDate()).padStart(2, '0');
                $('#renew_expired_date').val(yyyy + '-' + mm + '-' + dd);
            }
        }
    }

    function loadPaket(cabangId) {
        if (cabangId) {
            $('#renew_paket').empty().append('<option value="">: Loading...</option>');
            $.ajax({
                url: "<?= base_url('membership/getPaketByCabang') ?>/" + cabangId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#renew_paket').empty().append('<option value="">: Pilih Paket</option>');
                    response.forEach(function(paket) {
                        let nominal = 'Rp ' + parseInt(paket.nominal).toLocaleString('id-ID');
                        let expMonths = parseInt(paket.expired) || 1;
                        $('#renew_paket').append('<option value="' + paket.id + '" data-expired="' + expMonths + '">' + paket.category + ' - ' + paket.nama + ' (' + nominal + ')</option>');
                    });
                    updateCalculatedExpired();
                },
                error: function(xhr, status, error) {
                    console.error("Error loading paket:", error);
                    $('#renew_paket').empty().append('<option value="">: Gagal memuat data</option>');
                }
            });
        }
    }

    // Load initial packages for the selected branch
    loadPaket($('#renew_cabang').val());

    $('#renew_cabang').on('change', function() {
        loadPaket($(this).val());
    });

    $('#renew_paket').on('change', function() {
        updateCalculatedExpired();
    });

    $('#renew_payment_date').on('change', function() {
        updateCalculatedExpired();
    });

    $('#renew_accumulate').on('change', function() {
        updateCalculatedExpired();
    });
});
</script>
<?php endif; ?>

<?= $this->endSection(); ?>