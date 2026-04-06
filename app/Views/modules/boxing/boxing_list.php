<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('boxing/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
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
                        <th>Nama Kelas</th>
                        <th>Cabang</th>
                        <th>Trainer</th>
                        <th>Waktu</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($classes as $row) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['nmcab'] ?></td>
                            <td><?= $row['nmtrainer'] ?></td>
                            <td><?= $row['hari'] . ', ' . date('H:i', strtotime($row['jam_mulai'])) . ' WIB s.d ' . date('H:i', strtotime($row['jam_akhir'] . ' WIB')) ?></td>
                            <td width="160px">
                                <?php
                                echo (in_array($role_array[1], $permission)) ? anchor(base_url('boxing/detail/' . $row['id']), '<i class="fas fa-eye fa-sw text-white"></i>', ['title' => 'detail', 'class' => "btn btn-sm btn-info shadow-sm mr-1"]) : '';
                                echo (in_array($role_array[2], $permission)) ? anchor(base_url('boxing/edit/' . $row['id']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';
                                if (in_array($role_array[3], $permission)) :
                                    echo '<form action="' . base_url('boxing/delete/' . $row['id']) . '" method="post" class="d-inline">';
                                    echo csrf_field();
                                ?>
                                    <button type='submit' class='btn btn-sm btn-danger shadow-sm mr-1' onclick="return confirm(' Are you sure?')"><i class='fas fa-trash fa-sw text-white'></i></button>
                                    </form>
                                <?php
                                endif;
                                echo (in_array($role_array[4], $permission)) ? anchor(base_url('boxing/action/' . $row['id']), '<i class="fas fa-retweet fa-sw text-white"></i>', ['title' => 'action', 'class' => "btn btn-sm btn-secondary shadow-sm"]) : '';
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