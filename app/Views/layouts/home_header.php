<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-6 d-lg-none">
                            <div class="logo">
                                <a href="<?= site_url() ?>">
                                    <div style="background: #ffffff; padding: 5px 12px; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                        <img src="<?= base_url('img/logo_text.PNG'); ?>" alt="NO LIMITS" style="max-height: 18px; width: auto;">
                                        <span style="font-family: 'Inter', sans-serif; font-size: 8px; font-weight: 700; color: #444444; line-height: 1; margin-top: 1px; text-transform: none;">Training Facility</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 col-lg-12">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation" class="d-flex justify-content-center align-items-center" style="margin-bottom:0; padding:0;">
                                        <li><a href="<?= base_url() ?>">HOME</a></li>
                                        <li><a href="#about-us">ABOUT US</a></li>
                                        <li><a href="#class_schedule">CLASSES</a></li>
                                        
                                        <li class="d-none d-lg-block logo-nav-item">
                                            <a href="<?= site_url() ?>" class="logo-nav-link">
                                                <img src="<?= base_url('img/logo_text.PNG'); ?>" alt="NO LIMITS">
                                                <span class="logo-subtitle">Training Facility</span>
                                            </a>
                                        </li>

                                        <li><a href="#pricing">MEMBERSHIP</a></li>
                                        <li><a href="<?= base_url('/maintenance') ?>">MERCH</a></li>
                                        <li><a href="<?= base_url('/maintenance') ?>"><i class="ti-shopping-cart" style="font-size: 1.2em;"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- header-end -->

<style>
/* Custom Premium Navbar Styles to match mockup */
.header-area {
    position: fixed !important;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
}
.header-area .main-header-area {
    background-color: #141414 !important;
    padding: 0 40px !important;
    height: 90px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}
.header-area .main-header-area.sticky {
    background-color: #111111 !important;
    height: 75px !important;
    padding: 0 40px !important;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3) !important;
    top: 0 !important;
    transform: none !important;
}
.header-area .container-fluid,
.header-area .header_bottom_border,
.header-area .row,
.header-area .col-lg-12,
.header-area .main-menu,
.header-area nav {
    height: 100%;
    width: 100%;
}
.header-area .header_bottom_border {
    border-bottom: none !important;
}
.header-area .row {
    display: flex;
    align-items: center;
    margin: 0;
}
.header-area .main-menu {
    padding: 0 !important;
}
ul#navigation {
    height: 100%;
    display: flex !important;
    align-items: stretch;
    justify-content: center;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none;
}
ul#navigation li {
    display: flex !important;
    align-items: center;
    height: 100%;
    margin: 0 25px !important;
}
ul#navigation li a {
    font-family: 'Inter', 'Montserrat', 'Helvetica Neue', Arial, sans-serif !important;
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    padding: 0 !important;
    display: flex !important;
    align-items: center;
    height: 100%;
    transition: color 0.2s ease !important;
    position: relative;
}
ul#navigation li a:hover {
    color: #FF1414 !important;
}
/* Disable default hover line from template */
ul#navigation li a::before {
    display: none !important;
}

/* White Box Logo Container */
ul#navigation li.logo-nav-item {
    background-color: #ffffff !important;
    height: 100% !important;
    margin: 0 45px !important;
    padding: 0 30px !important;
    display: flex !important;
    align-items: stretch !important;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
.logo-nav-link {
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    align-items: center !important;
    height: 100% !important;
    text-decoration: none !important;
    padding: 0 !important;
}
.logo-nav-link img {
    height: 24px !important;
    width: auto !important;
    display: block !important;
    margin-bottom: 2px !important;
    transition: height 0.3s ease;
}
.header-area .main-header-area.sticky .logo-nav-link img {
    height: 20px !important;
}
.logo-subtitle {
    font-family: 'Inter', 'Montserrat', sans-serif !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    color: #444444 !important;
    line-height: 1 !important;
    letter-spacing: 0.2px !important;
    text-transform: none !important;
    font-style: normal !important;
}
.header-area .main-header-area.sticky .logo-subtitle {
    font-size: 11px !important;
}

/* Shopping Cart styling */
ul#navigation li a i.ti-shopping-cart {
    font-size: 1.3em !important;
}

/* Hide logo inside slicknav mobile menu */
.slicknav_nav .logo-nav-item {
    display: none !important;
}

/* Mobile Menu Adjustments */
@media (max-width: 991px) {
    .header-area .main-header-area {
        height: 70px !important;
        padding: 0 15px !important;
    }
    .mobile_menu {
        top: 20px !important;
    }
}
</style>