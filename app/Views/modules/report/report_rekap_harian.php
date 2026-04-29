<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php endif; ?>
        
        <form id="reportForm" method="GET" class="mb-5">
            <div class="form-row">
                <div class="col-md-4">
                    <label for="branch_location">Cabang <span class="text-danger">*</span></label>
                    <select id="branch_location" class="form-control">
                        <option value="">: Pilih Cabang</option>
                        <?php if ($cab_def == '%'): ?>
                            <option value="%">Semua Cabang</option>
                        <?php endif; ?>
                        <?php foreach ($branches as $branch): ?>
                            <option value="<?= $branch['id'] ?>"><?= $branch['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="report_date">Tanggal <span class="text-danger">*</span></label>
                    <input type="text" id="report_date" class="form-control datepicker" value="<?= date('Y-m-d') ?>" placeholder="____-__-__" readonly="true">
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label>
                    <button type="button" id="searchBtn" class="btn btn-primary form-control">Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive mt-4">
            <table class="table table-sm table-bordered" id="transactionTable">
                <thead>
                    <tr>
                        <th>Nama Paket</th>
                        <th>Nama Member</th>
                        <th>Status</th>
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
                        <td id="totalAmount"><strong>0</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });

    const table = $('#transactionTable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "<?= base_url('/report/fetch_rekap_harian') ?>",
            "type": "GET",
            "data": function(d) {
                d.branch_location = $('#branch_location').val();
                d.date = $('#report_date').val();
            }
        },
        "columns": [
            { "data": 0 },
            { "data": 1 },
            { "data": 2 },
            { "data": 3 },
            { "data": 4 },
            { "data": 5 },
            { "data": 6 }
        ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api();
            $('#totalAmount').html('<strong>' + api.ajax.json().total_amount + '</strong>');
        }
    });

    $('#searchBtn').click(function() {
        if ($('#branch_location').val() == '') {
            alert('Pilih Cabang Terlebih Dahulu');
            return false;
        }
        table.ajax.reload();
    });
});
</script>
<?= $this->endSection(); ?>
