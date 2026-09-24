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
                            <option value="%" selected>Semua Cabang</option>
                        <?php endif; ?>
                        <?php foreach ($branches as $branch): ?>
                            <option value="<?= $branch['id'] ?>" <?= ($cab_def == $branch['id']) ? 'selected' : '' ?>><?= $branch['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="report_date">Tanggal <span class="text-danger">*</span></label>
                    <input type="text" id="report_date" class="form-control datepicker" value="<?= date('Y-m-d') ?>" placeholder="YYYY-MM-DD" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label>
                    <div class="d-flex">
                        <button type="button" id="searchBtn" class="btn btn-primary flex-fill mr-2">
                            <i class="fas fa-search fa-sm"></i> Cari
                        </button>
                        <button type="button" id="exportBtn" class="btn btn-success flex-fill">
                            <i class="fas fa-file-excel fa-sm"></i> Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive mt-4">
            <table class="table table-sm table-bordered" id="rekapHarianTable">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
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
                        <td colspan="7"><strong>Total Nominal</strong></td>
                        <td id="totalAmount"><strong>0</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });

    const table = $('#rekapHarianTable').DataTable({
        "processing": true,
        "serverSide": false,
        "language": {
            "emptyTable": "Data tidak ditemukan / Kosong",
            "zeroRecords": "Data tidak ditemukan / Kosong",
            "processing": "Memuat data...",
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(disaring dari _MAX_ total data)",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        },
        "ajax": {
            "url": "<?= base_url('/report/fetch_rekap_harian') ?>",
            "type": "GET",
            "data": function(d) {
                d.branch_location = $('#branch_location').val() || '%';
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
            { "data": 6 },
            { "data": 7 }
        ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api();
            var json = api.ajax.json();
            var total = json && json.total_amount ? json.total_amount : '0,00';
            $('#totalAmount').html('<strong>' + total + '</strong>');
        }
    });

    $('#searchBtn').click(function() {
        table.ajax.reload();
    });

    $('#exportBtn').click(function() {
        var branch = $('#branch_location').val() || '%';
        var date = $('#report_date').val();
        window.location.href = "<?= base_url('/report/export_rekap_harian') ?>?branch_location=" + encodeURIComponent(branch) + "&date=" + encodeURIComponent(date);
    });
});
</script>
<?= $this->endSection(); ?>
