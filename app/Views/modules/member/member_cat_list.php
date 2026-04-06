<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('membership/category/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
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
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($categories as $row) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['catname'] ?></td>
                            <td width="160px">
                                <?php
                                echo (in_array($role_array[1], $permission)) ? anchor(base_url('membership/category/detail/' . $row['catid']), '<i class="fas fa-eye fa-sw text-white"></i>', ['title' => 'detail', 'class' => "btn btn-sm btn-info shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[2], $permission)) ? anchor(base_url('membership/category/edit/' . $row['catid']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';
                                if (in_array($role_array[3], $permission)) :
                                    echo '<form action="' . base_url('membership/category/delete/' . $row['catid']) . '" method="post" class="d-inline">';
                                    echo csrf_field();
                                ?>
                                    <button type='submit' class='btn btn-sm btn-danger shadow-sm mr-1' onclick="return confirm(' Are you sure?')"><i class='fas fa-trash fa-sw text-white'></i></button>
                                    </form>
                                <?php
                                endif;
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