<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <?php if (session()->group != 'MS') : ?>
            <!-- Notification -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <?php if (session()->unread_notif_count > 0) : ?>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter"><?= session()->unread_notif_count > 99 ? '99+' : session()->unread_notif_count; ?></span>
                    <?php endif; ?>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <?php 
                    $unread_notifs = session()->unread_notifs ?? [];
                    if (empty($unread_notifs)): ?>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div><span class="small text-gray-500">Tidak ada notifikasi baru.</span></div>
                        </a>
                    <?php else: 
                        foreach ($unread_notifs as $notif): ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?= $notif->link ?: '#' ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-fw fa-bell text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?= date('d M Y, H:i', strtotime($notif->created_at)) ?></div>
                                <span class="font-weight-bold"><?= esc($notif->title) ?></span>
                                <div class="small text-truncate" style="max-width: 250px;"><?= esc($notif->message) ?></div>
                            </div>
                        </a>
                    <?php 
                        endforeach; 
                    endif; ?>
                    <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('notifications') ?>">View All Notifications</a>
                </div>
            </li>
        <?php endif; ?>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi, <?= session()->nama; ?></span>
                <img class="img-profile rounded-circle" src="/img/uploads/fp/user.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php
                if (session()->group != 'MS'):
                ?>
                    <a class="dropdown-item" href="<?= base_url('user') ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                <?php
                endif;
                ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>

</nav>
<!-- End of Topbar -->