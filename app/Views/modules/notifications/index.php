<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <a href="<?= base_url('notifications/readAll') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-check-double fa-sm text-white-50"></i> Mark All as Read
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Notifications</h6>
            </div>
            <div class="card-body">
                <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
                    <?= session()->getFlashdata('pesan') ?>
                <?php endif; ?>

                <?php if (empty($notifications)): ?>
                    <div class="alert alert-info">Tidak ada notifikasi untuk cabang ini.</div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($notifications as $notif): ?>
                            <a href="<?= $notif->link ?: '#' ?>" class="list-group-item list-group-item-action <?= $notif->is_read ? 'bg-light text-muted' : '' ?>">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 font-weight-bold <?= $notif->is_read ? 'text-secondary' : 'text-primary' ?>">
                                        <?= esc($notif->title) ?>
                                        <?php if (!$notif->is_read): ?>
                                            <span class="badge badge-danger ml-2">New</span>
                                        <?php endif; ?>
                                    </h5>
                                    <small><?= date('d M Y, H:i', strtotime($notif->created_at)) ?></small>
                                </div>
                                <p class="mb-1"><?= esc($notif->message) ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
