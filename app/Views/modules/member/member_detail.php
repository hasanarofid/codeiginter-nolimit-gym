<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('membership'), '<i class="fas fa-arrow-left fa-sm text-white-50"></i> Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
    </div>
    <div class="card-body">
        <?php
        if (session()->getFlashdata('pesan')) :
            echo session()->getFlashdata('pesan');
        endif;
        ?>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><?= $category ?></td>
                    </tr>
                    <tr>
                        <td>Nama Paket</td>
                        <td>:</td>
                        <td><?= $detail['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Nominal</td>
                        <td>:</td>
                        <td><?= number_format($detail['nominal'], 0, '.', ',') ?></td>
                    </tr>
                    <tr>
                        <td>Jangka Waktu</td>
                        <td>:</td>
                        <td><?= $detail['expired'] . ' bulan' ?></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><?= $detail['deskripsi'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>