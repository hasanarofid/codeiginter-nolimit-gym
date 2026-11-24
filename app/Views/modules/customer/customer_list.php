<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= (in_array($role_array[0], $permission)) ? anchor(base_url('customer/create'), '<i class="fas fa-plus fa-sm text-white-50"></i> Add New', ['title' => 'data baru', 'class' => "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"]) : '' ?>
        <a href="<?= base_url('customer/export' . (!empty($status_filter) ? '?membership_status=' . $status_filter : '')) ?>" id="btnExportCustomer" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right mr-2">
            <i class="fas fa-download fa-sm text-white-50"></i> Export Excel
        </a>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm float-right mr-2" data-toggle="modal" data-target="#modalImport">
            <i class="fas fa-upload fa-sm text-white-50"></i> Import Excel
        </button>
        <a href="<?= base_url('customer/template') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm float-right mr-2">
            <i class="fas fa-file-excel fa-sm text-white-50"></i> Template Import
        </a>
    </div>
    <div class="card-body">
        <form method="get" action="<?= base_url('customer') ?>" class="mb-4" id="filterCustomerForm">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="membership_status">Status Membership</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-filter mr-1"></i> Status Membership</div>
                        </div>
                        <select name="membership_status" id="membership_status" class="form-control form-control-sm">
                            <option value="">Semua Status</option>
                            <option value="aktif" <?= ($status_filter ?? '') === 'aktif' ? 'selected' : '' ?>>Membership Aktif</option>
                            <option value="tidak_aktif" <?= ($status_filter ?? '') === 'tidak_aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                            <option value="na" <?= ($status_filter ?? '') === 'na' ? 'selected' : '' ?>>N.A (Belum Ada Membership)</option>
                        </select>
                    </div>
                </div>
                <div class="col-auto" id="resetFilterWrap" style="<?= empty($status_filter) ? 'display:none;' : '' ?>">
                    <button type="button" id="btnResetFilter" class="btn btn-sm btn-outline-secondary">Reset Filter</button>
                </div>
            </div>
        </form>
        <?php
        if (!empty(session()->getFlashdata('pesan'))) :
        ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php
        endif;
        ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered" id="customerTable" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Member</th>
                        <th>Nama Lengkap</th>
                        <th>Status Membership</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th width="210px"><i class="fas fa-fw fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImportLabel">Import Customer dari Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/import') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file_excel">File Excel (.xlsx)</label>
                        <input type="file" name="file_excel" class="form-control-file" id="file_excel" accept=".xlsx" required>
                    </div>
                    <div class="alert alert-warning">
                        <small>Pastikan format file sesuai dengan template yang disediakan.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#customerTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        order: [[1, 'asc']],
        ajax: {
            url: '<?= base_url('customer/fetch') ?>',
            type: 'GET',
            data: function(d) {
                d.membership_status = $('#membership_status').val();
            }
        },
        columnDefs: [
            { orderable: false, searchable: false, targets: [0, 6, 7] }
        ],
        language: {
            processing: 'Memuat data...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Menampilkan 0 sampai 0 dari 0 data',
            infoFiltered: '(disaring dari _MAX_ total data)',
            emptyTable: 'Data customer tidak ditemukan',
            zeroRecords: 'Data customer tidak ditemukan',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Selanjutnya',
                previous: 'Sebelumnya'
            }
        }
    });

    function syncFilterUI() {
        var val = $('#membership_status').val();
        var exportUrl = '<?= base_url('customer/export') ?>' + (val ? '?membership_status=' + encodeURIComponent(val) : '');
        $('#btnExportCustomer').attr('href', exportUrl);
        if (val) {
            $('#resetFilterWrap').show();
        } else {
            $('#resetFilterWrap').hide();
        }
    }

    $('#membership_status').on('change', function() {
        syncFilterUI();
        table.ajax.reload();
    });

    $('#btnResetFilter').on('click', function() {
        $('#membership_status').val('');
        syncFilterUI();
        table.ajax.reload();
    });
});
</script>
<?= $this->endSection(); ?>