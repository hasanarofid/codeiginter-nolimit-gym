<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('jadwal'), '<i class="fas fa-arrow-left fa-sm text-white-50"></i> Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
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
                        <td>Nama Kelas</td>
                        <td>:</td>
                        <td><?= $detail->nama ?></td>
                    </tr>
                    <tr>
                        <td>Cabang / Lokasi</td>
                        <td>:</td>
                        <td><?= $detail->nmcab ?></td>
                    </tr>
                    <tr>
                        <td>Trainer</td>
                        <td>:</td>
                        <td><?= $detail->nmtrainer ?></td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td><?= $detail->hari . ", " . date('H:i', strtotime($detail->jam_mulai)) . " s/d " . date('H:i', strtotime($detail->jam_akhir)) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>