<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('cabang/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
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
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Cabang</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telp.</th>
                        <th>Hp / WA</th>
                        <th>Rek.</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($cabang as $row) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= '<p>' . $row['alamat'] . '</p>' ?></td>
                            <td><?= ucfirst(strtolower($row['kota'])) ?></td>
                            <td><?= $row['telp'] ?></td>
                            <td><?= $row['hp'] ?></td>
                            <td><?= $row['bank_name'] . ' ' . $row['bank_rek'] . ' ' . $row['bank_acc_an'] ?></td>
                            <td width="160px">
                                <?php
                                echo (in_array($role_array[1], $permission)) ? anchor(base_url('cabang/detail/' . $row['id']), '<i class="fas fa-eye fa-sw text-white"></i>', ['title' => 'detail', 'class' => "btn btn-sm btn-info shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[2], $permission)) ? anchor(base_url('cabang/edit/' . $row['id']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';


                                if (in_array($role_array[3], $permission)) :
                                    echo '<form action="' . base_url('cabang/delete/' . $row['id']) . '" method="post" class="d-inline">';
                                    echo csrf_field();
                                ?>
                                    <button type='submit' class='btn btn-sm btn-danger shadow-sm mr-1' onclick="return confirm(' Are you sure?')"><i class='fas fa-trash fa-sw text-white'></i></button>
                                    </form>
                                <?php
                                endif;
                                echo (in_array($role_array[4], $permission)) ? anchor(base_url('cabang/action/' . $row['id']), '<i class="fas fa-retweet fa-sw text-white"></i>', ['title' => 'action', 'class' => "btn btn-sm btn-secondary shadow-sm"]) : '';
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