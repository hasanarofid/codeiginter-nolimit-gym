<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">

    <div class="card-body">
        <?php
        if (!empty(session()->getFlashdata('pesan'))) :
        ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php
        endif;
        ?>
        <form id="reportForm" method="GET" class="mb-5">
            <div class="form-row">
                <div class="col-md-3">
                    <label for="cabang">Cabang <span class="text-danger">*</span></label>
                    <select id="cabang" class="form-control">
                        <option value="">: Pilih Cabang</option>
                        <?php
                        if ($cab_def == '%'):
                        ?>
                            <option value="%">Semua Cabang</option>
                        <?php
                        endif;
                        ?>
                        <?php
                        foreach ($branches as $branch):
                            echo "<option value='$branch[id]'>$branch[nama]</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date_satu">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="text" id="date_satu" class="form-control datepicker" placeholder="____-__-__" readonly="true">
                </div>
                <div class="col-md-3">
                    <label for="date_dua">Tanggal Akhir <span class="text-danger">*</span></label>
                    <input type="text" id="date_dua" class="form-control datepicker" placeholder="____-__-__" readonly="true">
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <button type="button" id="srcTrx" class="btn btn-primary form-control">Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive mt-4">
            <table class="table table-sm table-bordered" id="trxumum">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Paket</th>
                        <th>Nama Member</th>
                        <th>Cabang</th>
                        <th>Tgl. Transaksi</th>
                        <th>Metode</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"><strong>Total Nominal</strong></td>
                        <td id="total"><strong>0</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>