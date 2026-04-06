<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('cabang'), '<i class="fas fa-arrow-left fa-sm text-white-50"></i> Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
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
                        <td>Cabang</td>
                        <td>:</td>
                        <td><?= $detail->id . ' | ' . $detail->nama ?></td>
                    </tr>
                    <tr>
                        <td>Alamat Cabang</td>
                        <td>:</td>
                        <td><?= $detail->alamat ?></td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td>:</td>
                        <td><?= ucfirst(strtolower($detail->kota)) ?></td>
                    </tr>
                    <tr>
                        <td>Telp</td>
                        <td>:</td>
                        <td><?= $detail->telp ?></td>
                    </tr>
                    <tr>
                        <td>HP</td>
                        <td>:</td>
                        <td><?= $detail->hp ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $detail->email ?></td>
                    </tr>
                    <tr>
                        <td>Bank</td>
                        <td>:</td>
                        <td><?= $detail->bank_name ?></td>
                    </tr>
                    <tr>
                        <td>Rek</td>
                        <td>:</td>
                        <td><?= $detail->bank_rek ?></td>
                    </tr>
                    <tr>
                        <td>Atas nama</td>
                        <td>:</td>
                        <td><?= $detail->bank_acc_an ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>