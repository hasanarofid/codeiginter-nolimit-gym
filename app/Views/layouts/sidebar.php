<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000000;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <img src="<?= base_url('img/logo_text.PNG') ?>" alt="NO LIMITS" class="img-fluid px-3" style="max-height: 40px;">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php get_menu($this, session()->userid) ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->