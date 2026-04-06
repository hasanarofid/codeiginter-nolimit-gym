<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('addon/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Addon</th>
                        <th>Kode Cab.</th>
                        <th>Biaya</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($addons as $row) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['kdcab'] ?></td>
                            <td><?= $row['biaya'] ?></td>
                            <td width="160px">
                                <?php
                                echo (in_array($role_array[1], $permission)) ? anchor(base_url('addon/detail/' . $row['id']), '<i class="fas fa-eye fa-sw text-white"></i>', ['title' => 'detail', 'class' => "btn btn-sm btn-info shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[2], $permission)) ? anchor(base_url('addon/edit/' . $row['id']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[3], $permission)) ? anchor(base_url('addon/delete/' . $row['id']), '<i class="fas fa-trash fa-sw text-white"></i>', ['title' => 'delete', 'class' => "btn btn-sm btn-danger shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[4], $permission)) ? anchor(base_url('addon/action/' . $row['id']), '<i class="fas fa-retweet fa-sw text-white"></i>', ['title' => 'action', 'class' => "btn btn-sm btn-secondary shadow-sm"]) : '';
                                ?>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    endforeach;
                    ?>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>