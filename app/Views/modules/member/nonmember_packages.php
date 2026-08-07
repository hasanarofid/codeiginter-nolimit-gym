<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('nonmembership/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('pesan'))): ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php endif; ?>

        <?php if (empty($nm_cat_id)): ?>
            <div class="alert alert-warning">
                <strong>Perhatian:</strong> Kategori <b>Gym Non Membership</b> belum ditemukan di database.
                Silakan jalankan SQL berikut di phpMyAdmin terlebih dahulu:<br>
                <code>INSERT INTO `membership_cat` (`catname`, `created_at`) VALUES ('Gym Non Membership', NOW());</code>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-sm table-striped data-tables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Paket</th>
                        <th>Kota</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                        <th>Kadaluarsa</th>
                        <th><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($packages as $row) :
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['kota'] ?></td>
                            <td><?= $row['catname'] ?></td>
                            <td><?= number_format($row['nominal'], 0, '.', ',') ?></td>
                            <td><?= $row['expired'] == 0 ? 'Per Visit' : $row['expired'] . ' bln' ?></td>
                            <td width="120px">
                                <?php
                                echo (in_array($role_array[2], $permission)) ? anchor(base_url('nonmembership/edit/' . $row['id']), '<i class="fas fa-edit fa-sw text-white"></i>', ['title' => 'edit', 'class' => "btn btn-sm btn-warning shadow-sm mr-1"]) : '';
                                if (in_array($role_array[3], $permission)) :
                                    echo '<form action="' . base_url('nonmembership/delete/' . $row['id']) . '" method="post" class="d-inline">';
                                    echo csrf_field();
                                ?>
                                    <button type='submit' class='btn btn-sm btn-danger shadow-sm mr-1' onclick="return confirm('Hapus paket ini?')"><i class='fas fa-trash fa-sw text-white'></i></button>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
