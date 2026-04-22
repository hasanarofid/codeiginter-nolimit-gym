<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-2 text-gray-800"><?= $title ?> - <span class="text-primary"><?= $cabang_nama ?></span></h1>
<?= csrf_field() ?>

<div class="row">
    <!-- Items Selection -->
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Minuman & Snack</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (empty($items)): ?>
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Belum ada item. Silakan tambah di <a href="<?= base_url('pos/inventory') ?>">Manajemen Stok</a>.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 item-card border-left-primary shadow-sm" style="cursor: pointer;" 
                                     onclick="addToCart('<?= $item->iditem ?>', '<?= addslashes($item->nama) ?>', <?= $item->harga ?>, <?= $item->stok ?>)">
                                    <div class="card-body">
                                        <div class="font-weight-bold text-dark mb-1"><?= $item->nama ?></div>
                                        <div class="text-primary small mb-1">Rp <?= number_format($item->harga, 0, ',', '.') ?></div>
                                        <div class="small <?= $item->stok <= 0 ? 'text-danger font-weight-bold' : 'text-muted' ?>">
                                            Stok: <?= $item->stok ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Summary -->
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Keranjang Belanja</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0" id="cartTable">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th width="80">Qty</th>
                                <th class="text-right">Total</th>
                                <th width="40"></th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <tr id="emptyCartRow">
                                <td colspan="4" class="text-center py-4 text-muted">Keranjang kosong</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-light">
                                <th colspan="2" class="text-right">GRAND TOTAL:</th>
                                <th class="text-right" id="grandTotalLabel">Rp 0</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row no-gutters">
                    <div class="col-6 pr-1">
                        <button type="button" class="btn btn-success btn-block btn-lg" id="btnTunai" disabled onclick="processCheckout('Tunai')">
                            <i class="fas fa-money-bill-wave mr-1"></i> TUNAI
                        </button>
                    </div>
                    <div class="col-6 pl-1">
                        <button type="button" class="btn btn-info btn-block btn-lg" id="btnNonTunai" disabled onclick="processCheckout('Non-Tunai')">
                            <i class="fas fa-credit-card mr-1"></i> NON-TUNAI
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];

    function addToCart(id, nama, harga, stok) {
        if (stok <= 0) {
            alert('Stok habis!');
            return;
        }

        let existing = cart.find(i => i.id === id);
        if (existing) {
            if (existing.qty >= stok) {
                alert('Stok tidak mencukupi!');
                return;
            }
            existing.qty++;
        } else {
            cart.push({ id: id, nama: nama, harga: harga, qty: 1, stok: stok });
        }
        renderCart();
    }

    function updateQty(id, delta) {
        let item = cart.find(i => i.id === id);
        if (item) {
            if (delta > 0 && item.qty >= item.stok) {
                alert('Stok tidak mencukupi!');
                return;
            }

            item.qty += delta;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.id !== id);
            }
        }
        renderCart();
    }

    function removeFromCart(id) {
        cart = cart.filter(i => i.id !== id);
        renderCart();
    }

    function renderCart() {
        const body = $('#cartBody');
        body.empty();
        
        let total = 0;

        if (cart.length === 0) {
            body.append('<tr id="emptyCartRow"><td colspan="4" class="text-center py-4 text-muted">Keranjang kosong</td></tr>');
            $('#grandTotalLabel').text('Rp 0');
            $('#btnTunai, #btnNonTunai').prop('disabled', true);
            return;
        }

        cart.forEach(item => {
            let subtotal = item.harga * item.qty;
            total += subtotal;
            body.append(`
                <tr>
                    <td class="small font-weight-bold">${item.nama}</td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary px-1" onclick="updateQty('${item.id}', -1)">-</button>
                            </div>
                            <input type="text" class="form-control text-center p-0" value="${item.qty}" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary px-1" onclick="updateQty('${item.id}', 1)">+</button>
                            </div>
                        </div>
                    </td>
                    <td class="text-right small">Rp ${subtotal.toLocaleString('id-ID')}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-link text-danger p-0" onclick="removeFromCart('${item.id}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            `);
        });

        $('#grandTotalLabel').text('Rp ' + total.toLocaleString('id-ID'));
        $('#btnTunai, #btnNonTunai').prop('disabled', false);
    }

    function processCheckout(method) {
        if (!confirm('Proses pembayaran ' + method.toUpperCase() + ' sekarang?')) return;

        const btnBackupTunai = $('#btnTunai').html();
        const btnBackupNonTunai = $('#btnNonTunai').html();
        
        $('#btnTunai, #btnNonTunai').prop('disabled', true);
        if (method === 'Tunai') {
            $('#btnTunai').html('<i class="fas fa-spinner fa-spin"></i>');
        } else {
            $('#btnNonTunai').html('<i class="fas fa-spinner fa-spin"></i>');
        }

        $.ajax({
            url: '<?= base_url('pos/store') ?>',
            type: 'POST',
            data: { 
                cart: cart,
                payment_method: method,
                [$('input[name="<?= csrf_token() ?>"]').attr('name')]: $('input[name="<?= csrf_token() ?>"]').val()
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert('Berhasil! Transaksi: ' + response.trx_id);
                    cart = [];
                    renderCart();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            complete: function() {
                $('#btnTunai').html(btnBackupTunai);
                $('#btnNonTunai').html(btnBackupNonTunai);
                if (cart.length > 0) {
                    $('#btnTunai, #btnNonTunai').prop('disabled', false);
                }
            },
            error: function() {
                alert('Terjadi kesalahan koneksi');
            }
        });
    }
</script>

<style>
    .item-card:hover {
        background-color: #f8f9fc;
        transform: translateY(-2px);
        transition: all 0.2s;
    }
</style>

<?= $this->endSection(); ?>
