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
                                <div class="form-group col-5">
                                    <label for="idmember">ID Member <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control <?= session('errors.idmember') ? 'is-invalid' : '' ?>" name="idmember" id="scanner_input" value="<?= $idmember ?>" placeholder="xxxxxxxxx" autofocus>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#livestream_scanner"><i class="fas fa-fw fa-barcode mr-1"></i>Scan</button>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#memberlist"><i class="fas fa-fw fa-users mr-1"></i>Cari</button>
                                        </div>

                                        <div class="invalid-feedback">
                                            <?= session('errors.idmember') ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-3">
                                    <label for="locker">Locker No.<span class="text-danger">*</span></label>
                                    <input type="text" name="locker" id="locker" class="form-control <?= session('errors.locker') ? 'is-invalid' : '' ?>" value="<?= $locker ?>" placeholder="No. Loker">
                                    <div class="invalid-feedback">
                                        <?= session('errors.locker') ?>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label>Handuk <span class="text-danger">*</span></label><br />
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="handuk" id="handuk" value="ya">
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
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </div>

                            <div class="row" id="memberDetails" class="mt-4" style="display: none;">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h4>Member Details</h4>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>ID Member</td>
                                                                <td><span id="memberID"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nama Member</td>
                                                                <td><span id="memberName"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Expiry Date</td>
                                                                <td><span id="memberExpiry"></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col text-center">
                                                    <img id="memberPhoto" src="" alt="Member Photo" class="img-thumbnail" width="150">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Modal scaner -->
                        <div class="modal" id="livestream_scanner">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">Barcode Scanner</h4>
                                    </div>
                                    <div class="modal-body" style="position: static">
                                        <div id="interactive" class="viewport"></div>
                                        <div class="error"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <label class="btn btn-default pull-left">
                                            <i class="fa fa-camera"></i> Use camera app
                                            <input type="file" accept="image/*;capture=camera" capture="camera" class="hidden" />
                                        </label> -->
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <!-- Modal listmember -->
                        <div class="modal" id="memberlist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Daftar Member</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered data-tables" id="table-member">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>ID Member</th>
                                                        <th>Nama Member</th>
                                                        <th><i class="fas fa=fw fa-cog"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 0;
                                                    foreach ($members as $rw):
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><?= $rw->id; ?></td>
                                                            <td><?= $rw->nama; ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-danger select-member" data-dismiss="modal">Pilih</button>
                                                            </td>
                                                        </tr>
                                                    <?php
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
                </div>

                <div class=" row mt-5" style="padding-top:25px;border-top: 0.1em solid #CCC;">
                    <div class="col">
                        <table class="table table-sm table-bordered data-tabless">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Member</th>
                                    <th>Nama Lengkap</th>
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
                                    $out = $pengunjung->updated_at == null ? '00:00' : date('H:i', strtotime($pengunjung->updated_at));
                                    $btn_out = $pengunjung->updated_at == null ? '' : ' disabled';
                                ?>
                                    <tr>
                                        <td><?= $nnn; ?></td>
                                        <td><?= $pengunjung->id ?></td>
                                        <td><?= $pengunjung->nama ?></td>
                                        <td><?= date('H:i', strtotime($pengunjung->created_at)) ?></td>
                                        <td><?= $out ?></td>
                                        <td><?= $pengunjung->locker ?></td>
                                        <td><?= strtoupper($pengunjung->handuk) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#pengunjung<?= $pengunjung->idx ?>" <?= $btn_out ?>>Out</button>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="pengunjung<?= $pengunjung->idx ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Out Gym</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form name="outgym" method="post" action="<?= base_url('visitors/update') ?>">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">No. Locker</label>
                                                            <input type="text" name="lkr" id="lkr" class="form-control" value="<?= $pengunjung->locker ?>" readonly="true" required="required">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Handuk</label>
                                                            <select name="hndk" id="hndk" class="form-control" required="required">
                                                                <option value="">: Pilih</option>
                                                                <?php
                                                                $arr = ['ya', 'kembali'];

                                                                for ($i = 0; $i < count($arr); $i++) {
                                                                    echo "<option value='$arr[$i]'";
                                                                    echo $pengunjung->handuk == $arr[$i] ? ' selected = "selected"' : '';
                                                                    echo ">" . strtoupper($arr[$i]) . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <input type="hidden" name="idx" value="<?= $pengunjung->idx ?>" />
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
<?= $this->endSection(); ?>