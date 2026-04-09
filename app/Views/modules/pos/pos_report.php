<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('pos/report') ?>" method="get" class="form-inline">
            <div class="form-group mr-3">
                <label class="mr-2">Dari:</label>
                <input type="date" name="date_satu" class="form-control" value="<?= $date_satu ?>">
            </div>
            <div class="form-group mr-3">
                <label class="mr-2">Sampai:</label>
                <input type="date" name="date_dua" class="form-control" value="<?= $date_dua ?>">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search mr-1"></i> Filter
            </button>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered data-tables" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Cabang</th>
                        <th>Waktu</th>
                        <th>ID Transaksi</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    $total_qty = 0;
                    $grand_total = 0;
                    foreach ($results as $row): 
                        $subtotal = $row->qty * $row->current_price;
                        $total_qty += $row->qty;
                        $grand_total += $subtotal;
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><span class="badge badge-info"><?= $row->cabang_nama ?></span></td>
                            <td><?= date('d/m/Y H:i', strtotime($row->created_at)) ?></td>
                            <td><small class="font-weight-bold text-primary"><?= $row->hdr_id ?></small></td>
                            <td><?= $row->item_nama ?></td>
                            <td class="text-center"><?= $row->qty ?></td>
                            <td class="text-right">Rp <?= number_format($row->current_price, 0, ',', '.') ?></td>
                            <td class="text-right font-weight-bold">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-light">
                        <th colspan="5" class="text-right">TOTAL TERJUAL:</th>
                        <th class="text-center"><?= $total_qty ?></th>
                        <th class="text-right">GRAND TOTAL:</th>
                        <th class="text-right text-primary">Rp <?= number_format($grand_total, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
