<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- <?= (in_array($role_array[0], $permission)) ? anchor(base_url('customer/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?> -->
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
                                // echo (in_array($role_array[2], $permission)) ? anchor(base_url('customer/edit/' . $row['id']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';
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
<?= $this->endSection(); ?>