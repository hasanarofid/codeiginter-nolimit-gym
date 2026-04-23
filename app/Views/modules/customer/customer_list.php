<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('customer/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
        <a href="<?= base_url('customer/export') ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right mr-2">
            <i class="fas fa-download fa-sm text-white-50"></i> Export Excel
        </a>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm float-right mr-2" data-toggle="modal" data-target="#modalImport">
            <i class="fas fa-upload fa-sm text-white-50"></i> Import Excel
        </button>
        <a href="<?= base_url('customer/template') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right mr-2">
            <i class="fas fa-file-excel fa-sm text-white-50"></i> Template Import
        </a>
    </div>
    <div class="card-body">
        <?php
        if (!empty(session()->getFlashdata('pesan'))) :
        ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php
        endif;
        ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered data-tables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Member</th>
                        <th>Nama Lengkap</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($customers as $row) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['hp_wa'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><img class="img-fluid" src="/img/uploads/member/fp/<?= $row['fp_image'] ?>" width="64" /></td>
                            <td width="160px">
                                <?php
                                echo (in_array($role_array[1], $permission)) ? anchor(base_url('customer/detail/' . $row['id']), '<i class="fas fa-eye fa-sw text-white"></i>', ['title' => 'detail', 'class' => "btn btn-sm btn-info shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[2], $permission)) ? anchor(base_url('customer/edit/' . $row['id']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';
                                // echo (in_array($role_array[3], $permission)) ? anchor(base_url('customer/delete/' . $row['id']), '<i class="fas fa-trash fa-sw text-white"></i>', ['title' => 'delete', 'class' => "btn btn-sm btn-danger shadow-sm mr-1"]) : '';
                                // echo (in_array($role_array[4], $permission)) ? anchor(base_url('customer/action/' . $row['id']), '<i class="fas fa-retweet fa-sw text-white"></i>', ['title' => 'action', 'class' => "btn btn-sm btn-secondary shadow-sm"]) : '';
                                ?>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    endforeach;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImportLabel">Import Customer dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/import') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file_excel">File Excel (.xlsx)</label>
                        <input type="file" name="file_excel" class="form-control-file" id="file_excel" accept=".xlsx" required>
                    </div>
                    <div class="alert alert-warning">
                        <small>Pastikan format file sesuai dengan template yang disediakan.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>