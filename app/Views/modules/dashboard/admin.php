<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $report['monthly_earning'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $report['anual_earning'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $report['pending_req'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Member</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $report['member_active'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Member Expired</h3>
            </div>
            <div class="card-body">
                <table class="table table-nordered data-tables">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Member</th>
                            <th>Cabang</th>
                            <th>Nama Member</th>
                            <th>Paket</th>
                            <th>HP / WA</th>
                            <th>Kadaluarsa</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($report['perpanjangan'] as $exp):
                        ?>
                            <tr>
                                <td><?= $n; ?></td>
                                <td><?= $exp->idcust ?></td>
                                <td><?= ucwords(strtolower($exp->cabang)) ?></td>
                                <td><?= ucwords(strtolower($exp->nmcust)) ?></td>
                                <td><?= ucwords(strtolower($exp->pkgname)) ?></td>
                                <td><?= $exp->hp_wa == null ? 'N.A' : $exp->hp_wa ?></td>
                                <td><?= $exp->expired_day < 0 ? '<span class="badge badge-danger">Over ' . abs($exp->expired_day) . ' hari</span>' : '<span class="badge badge-warning">' . $exp->expired_day . ' hari lagi</span>' ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#perpanjang<?= $n ?>">Perpanjang</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="perpanjang<?= $n ?>" tabindex="-1" aria-labelledby="perpanjang<?= $n ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Form Perpanjangan Membership</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form name="perpanjang<?= $n; ?>" method="post" action="<?= base_url('membership-renewal') ?>">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="cabang">Cabang <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="cabang" id="cabang<?= $n; ?>" required="required">
                                                                <option value="">: Pilih Cabang</option>
                                                                <?php
                                                                foreach ($cabangs as $b):
                                                                    if ($exp->branchid == $b['id']):
                                                                ?>
                                                                        <option value="<?= $b['id'] ?>"><?= $b['nama'] ?></option>
                                                                <?php
                                                                    endif;
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paket">Paket Membership <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="paket" id="paket<?= $n; ?>" required="required">
                                                                <option value="">: Paket Membership</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="payment">Metode Bayar <span class="text-danger">*</span></label>
                                                            <select name="payment" id="payment" class="form-control" required="required">
                                                                <option value="">: Metode Bayar</option>
                                                                <?php
                                                                $arr_mtd = ['Cash', 'Qris', 'Bank Transfer'];
                                                                for ($i = 0; $i < count($arr_mtd); $i++):
                                                                ?>
                                                                    <option value="<?= $arr_mtd[$i] ?>"><?= $arr_mtd[$i] ?></option>
                                                                <?php
                                                                endfor;
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <input type="hidden" name="idcust" value="<?= $exp->idcust ?>" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                                <script>
                                                    $(document).ready(function() {
                                                        // Load paket member berdasarkan cabang
                                                        $('#cabang<?= $n; ?>').on('change', function() {
                                                            const selectedCabangId = $(this).val();
                                                            $('#paket<?= $n; ?>').empty().append('<option value="">: Paket Membership</option>');
                                                            if (selectedCabangId) {
                                                                $.ajax({
                                                                    url: `<?= base_url("membership/getPaketByCabang") ?>/${selectedCabangId}`,
                                                                    type: 'GET',
                                                                    dataType: 'json',
                                                                    success: function(response) {
                                                                        response.forEach(function(paket) {
                                                                            $('#paket<?= $n; ?>').append(`<option value="${paket.id}">${paket.category} ${paket.nama} - ${paket.nominal}</option>`);
                                                                        });
                                                                    }
                                                                });

                                                                // alert('yuhuu..');
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $n++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- PushNotification Modal -->
<!-- Modal Notifikasi -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifikasi Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Konten notifikasi akan diisi oleh JavaScript -->
                <p id="notificationMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>