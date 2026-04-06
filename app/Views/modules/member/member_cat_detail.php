<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor(base_url('membership/category'), '<i class="fas fa-arrow-left fa-sm text-white-50"></i> Back', ['title' => 'kembali', 'class' => "d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right"]) ?>
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
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $name ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>