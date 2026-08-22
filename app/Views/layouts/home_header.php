<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-7 col-sm-6 d-lg-none">
                            <div class="logo">
                                <a href="<?= site_url() ?>" style="text-decoration: none;">
                                    <div style="background: #000000; padding: 6px 12px; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 4px; box-shadow: 0 4px 10px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.15);">
                                        <img src="<?= base_url('img/logo_text.PNG'); ?>" alt="NO LIMITS" style="max-height: 18px; width: auto; display: block; margin-bottom: 2px;">
                                        <span style="font-family: 'Inter', 'Montserrat', sans-serif; font-size: 8px; font-weight: 700; color: #ffffff; line-height: 1; text-transform: none; display: block;">Training Facility</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-5 col-sm-6 d-lg-none d-flex align-items-center justify-content-end" style="gap: 8px;">
                            <a href="<?= base_url('/maintenance') ?>" style="color: #ffffff; font-size: 1.1rem; display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; background: #000000; border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; text-decoration: none;" title="Cart">
                                <i class="ti-shopping-cart"></i>
                            </a>
                            <a href="<?= base_url('/login') ?>" style="color: #ffffff; font-size: 1.1rem; display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; background: #000000; border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; text-decoration: none;" title="Login Member">
                                <i class="ti-user"></i>
                            </a>
                            <div class="mobile_menu"></div>
                        </div>
                        <div class="col-12 d-none d-lg-block">
                            <div class="main-menu">
                                <nav>
                                    <ul id="navigation" class="d-flex justify-content-center align-items-center" style="margin-bottom:0; padding:0;">
                                         <li><a href="<?= base_url('/about-us') ?>">ABOUT US</a></li>
                                         <li><a href="<?= base_url('/classes') ?>">CLASSES</a></li>
                                         <li><a href="<?= base_url('/events') ?>">EVENT</a></li>
                                         
                                         <li class="d-none d-lg-block logo-nav-item">
                                             <a href="<?= site_url() ?>" class="logo-nav-link">
                                                 <img src="<?= base_url('img/logo_text.PNG'); ?>" alt="NO LIMITS">
                                                 <span class="logo-subtitle">Training Facility</span>
                                             </a>
                                         </li>

                                         <li><a href="<?= base_url('/pricing') ?>">MEMBERSHIP</a></li>
                                         <li><a href="<?= base_url('/merch') ?>">MERCH</a></li>
                                         <li class="mobile-hide-nav"><a href="<?= base_url('/maintenance') ?>"><i class="ti-shopping-cart" style="font-size: 1.2em;"></i></a></li>
                                         <li class="mobile-hide-nav"><a href="<?= base_url('/login') ?>" title="Login Member"><i class="ti-user" style="font-size: 1.2em;"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
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

/* Black Box Logo Container (Punjul / Protruding) */
ul#navigation li.logo-nav-item {
    background-color: #000000 !important;
    height: 120px !important;
    margin: 0 45px !important;
    padding: 0 30px !important;
    display: flex !important;
    align-items: center !important;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.6);
    align-self: flex-start !important;
    transition: height 0.3s ease;
}
.header-area .main-header-area.sticky ul#navigation li.logo-nav-item {
    height: 95px !important;
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
    height: 28px !important;
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
    color: #ffffff !important;
    line-height: 1 !important;
    letter-spacing: 0.2px !important;
    text-transform: none !important;
    font-style: normal !important;
}
.header-area .main-header-area.sticky .logo-subtitle {
    font-size: 10px !important;
}

/* Shopping Cart & User Icon styling */
ul#navigation li a i.ti-shopping-cart,
ul#navigation li a i.ti-user {
    font-size: 1.3em !important;
}

/* Hide logo and icon items inside slicknav mobile menu */
.slicknav_nav .logo-nav-item,
.slicknav_nav .mobile-hide-nav {
    display: none !important;
}

/* Mobile Header & Hamburger Menu Adjustments */
@media (max-width: 991px) {
    .header-area .main-header-area {
        height: 75px !important;
        padding: 0 15px !important;
        background-color: #141414 !important;
    }
    .mobile_menu {
        position: static !important;
        float: right !important;
        width: auto !important;
        margin-top: 0 !important;
    }
    .slicknav_menu {
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
        position: static !important;
    }
    .slicknav_btn {
        background: #000000 !important;
        border: 1px solid #FF1414 !important;
        border-radius: 6px !important;
        padding: 8px 10px !important;
        margin: 0 !important;
        position: relative !important;
        top: 0 !important;
        float: right !important;
        display: inline-block !important;
        box-shadow: 0 4px 10px rgba(255, 20, 20, 0.3) !important;
    }
    .slicknav_menu .slicknav_icon-bar {
        background-color: #ffffff !important;
        height: 2px !important;
        width: 22px !important;
        margin: 4px 0 !important;
        display: block !important;
        transition: all 0.3s ease;
    }
    .slicknav_btn:hover .slicknav_icon-bar,
    .slicknav_btn.slicknav_open .slicknav_icon-bar {
        background-color: #FF1414 !important;
    }
    .slicknav_nav {
        background: #141414 !important;
        position: fixed !important;
        top: 75px !important;
        left: 0 !important;
        right: 0 !important;
        width: 100vw !important;
        max-width: 100vw !important;
        border-top: 2px solid #FF1414 !important;
        border-bottom: 3px solid #FF1414 !important;
        padding: 10px 0 !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.95) !important;
        z-index: 999999 !important;
        margin: 0 !important;
    }
    .slicknav_nav li {
        width: 100% !important;
        text-align: center !important;
        display: block !important;
        margin: 0 !important;
    }
    .slicknav_nav li a {
        color: #ffffff !important;
        font-family: 'Inter', 'Montserrat', sans-serif !important;
        font-size: 16px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        padding: 14px 20px !important;
        display: block !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }
    .slicknav_nav li a:hover,
    .slicknav_nav li a:active {
        background: #FF1414 !important;
        color: #000000 !important;
    }
}
</style>