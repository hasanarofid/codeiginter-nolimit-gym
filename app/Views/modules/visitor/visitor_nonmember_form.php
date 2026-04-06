<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <?php
                        if (!empty(session()->getFlashdata('pesan'))) :
                        ?>
                            <?= session()->getFlashdata('pesan') ?>
                        <?php
                        endif;
                        ?>
                        <form name="visitors" method="post" action="<?= $action ?>">
                            <?= csrf_field() ?>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="cabang">Cabang <span class="text-danger">*</span></label>
                                    <select name="cabang" id="cabang" class="form-control <?= session('errors.cabang') ? 'is-invalid' : '' ?>">
                                        <option value="">: Pilih</option>
                                        <?php
                                        $x = 0;
                                        foreach ($cabang as $cab) {
                                            if ($user_cabang == $cab['id']) {
                                                echo "<option value='$cab[id]'>$cab[nama]</option>";
                                            } else {
                                                echo "<option value='$cab[id]'>$cab[nama]</option>";
                                            }
                                            $x++;
                                        }
                                        // dd($prices);
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= session('errors.cabang') ?>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="paket">Biaya <span class="text-danger">*</span></label>
                                    <select name="paket" id="paket" class="form-control <?= session('errors.paket') ? 'is-invalid' : '' ?>">
                                        <option value="">: Pilih</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= session('errors.paket') ?>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="payment">Pembayaran <span class="text-danger">*</span></label>
                                    <select name="payment" id="payment" class="form-control <?= session('errors.payment') ? 'is-invalid' : '' ?>">
                                        <option value="">: Metode Bayar</option>
                                        <?php
                                        $arr_mtd = ['Cash', 'Qris'];
                                        for ($i = 0; $i < count($arr_mtd); $i++):
                                        ?>
                                            <option value="<?= $arr_mtd[$i] ?>"><?= $arr_mtd[$i] ?></option>
                                        <?php
                                        endfor;
                                        ?>
                                    </select>

                                    <div class="invalid-feedback">
                                        <?= session('errors.payment') ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="nama">Nama Pengunjung <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= $nama ?>" placeholder="Nama Lengkap" autofocus>

                                    <div class="invalid-feedback">
                                        <?= session('errors.nama') ?>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="locker">Locker No.<span class="text-danger">*</span></label>
                                    <input type="text" name="locker" id="locker" class="form-control <?= session('errors.locker') ? 'is-invalid' : '' ?>" value="<?= $locker ?>" placeholder="No. Loker">
                                    <div class="invalid-feedback">
                                        <?= session('errors.locker') ?>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label>Handuk <span class="text-danger">*</span></label><br />
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="handuk" id="handuk" value="ya" checked="checked">
                                        <label class="form-check-label" for="handuk">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="handuk" id="handuk" value="tidak">
                                        <label class="form-check-label" for="handuk">
                                            Tidak
                                        </label>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= session('errors.handuk') ? '<small class="form-text text-danger">' . session('errors.handuk') . '</small>' : '' ?>
                                    </div>
                                </div>
                                <div class="form-group col-1">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary d-flex">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class=" row mt-5" style="padding-top:25px;border-top: 0.1em solid #CCC;">
                    <div class="col">
                        <table class="table table-sm table-bordered data-tabless">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pengunjung</th>
                                    <th>In</th>
                                    <th>Out</th>
                                    <th>Locker</th>
                                    <th>Handuk</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nnn = 1;
                                foreach ($visitors as $pengunjung):
                                    $out = $pengunjung['updated_at'] == null ? '00:00' : date('H:i', strtotime($pengunjung['updated_at']));
                                    $btn_out = $pengunjung['updated_at'] == null ? '' : ' disabled';
                                ?>
                                    <tr>
                                        <td><?= $nnn; ?></td>
                                        <td><?= $pengunjung['nama'] ?></td>
                                        <td><?= date('H:i', strtotime($pengunjung['created_at'])) ?></td>
                                        <td><?= $out ?></td>
                                        <td><?= $pengunjung['locker'] ?></td>
                                        <td><?= strtoupper($pengunjung['handuk']) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#pengunjung<?= $pengunjung['idx'] ?>" <?= $btn_out ?>>Out</button>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="pengunjung<?= $pengunjung['idx'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Out Gym</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form name="outgym" method="post" action="<?= base_url('visitors/nonmember/update') ?>">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">No. Locker</label>
                                                            <input type="text" name="lkr" id="lkr" class="form-control" value="<?= $pengunjung['locker'] ?>" readonly="true" required="required">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Handuk</label>
                                                            <select name="hndk" id="hndk" class="form-control" required="required">
                                                                <option value="">: Pilih</option>
                                                                <?php
                                                                $arr = ['ya', 'kembali'];

                                                                for ($i = 0; $i < count($arr); $i++) {
                                                                    echo "<option value='$arr[$i]'";
                                                                    echo $pengunjung['handuk'] == $arr[$i] ? ' selected = "selected"' : '';
                                                                    echo ">" . strtoupper($arr[$i]) . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <input type="hidden" name="idx" value="<?= $pengunjung['idx'] ?>" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $nnn++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Load paket member berdasarkan cabang
        $('#cabang').on('change', function() {
            const selectedCabangId = $(this).val();
            $('#paket').empty().append('<option value="">: Pilih</option>');
            if (selectedCabangId) {
                $.ajax({
                    url: `<?= base_url("membership/getPervisitBycabang") ?>/${selectedCabangId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        response.forEach(function(paket) {
                            $('#paket').append(`<option value="${paket.id}">${paket.paket} - ${paket.nominal}</option>`);
                        });
                    }
                });

                // alert('yuhuu..');
            }
        });
    });
</script>
<?= $this->endSection(); ?>