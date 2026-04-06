<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <?php
        if (session()->group != 'MS'):
        ?>
            <!-- Notification -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"><?= session()->pending_reqs > 10 ? '+' . session()->pending_reqs : session()->pending_reqs; ?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <?php
                    $pending_members = session()->pending_members;
                    foreach ($pending_members as $all):
                    ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('customer/detail/' . $all->custid) ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-fw fa-user text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?= date('M, d Y', strtotime($all->created_at)) ?></div>
                                <span class="font-weight-bold">New pending request, click for detail..</span>
                            </div>
                        </a>
                    <?php
                    endforeach;
                    ?>
                    <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('/customer') ?>">Show All Members</a>
                </div>
            </li>
        <?php
        endif;
        ?>
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