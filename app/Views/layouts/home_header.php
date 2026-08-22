<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="header_bottom_border">
                    <div class="row align-items-center justify-content-between">
                        
                        <!-- Mobile Header Left: Hamburger Toggle -->
                        <div class="col-3 col-sm-3 d-lg-none d-flex align-items-center justify-content-start">
                            <button type="button" id="mobile-drawer-toggle" class="mobile-drawer-btn" aria-label="Toggle Menu">
                                <span class="hamburger-bar"></span>
                                <span class="hamburger-bar"></span>
                                <span class="hamburger-bar"></span>
                            </button>
                        </div>

                        <!-- Mobile Header Center: Logo Box -->
                        <div class="col-6 col-sm-6 d-lg-none d-flex align-items-center justify-content-center">
                            <div class="logo">
                                <a href="<?= site_url() ?>" style="text-decoration: none;">
                                    <div class="mobile-logo-box">
                                        <img src="<?= base_url('img/logo_text.PNG'); ?>" alt="NO LIMITS" class="mobile-logo-img">
                                        <span class="mobile-logo-subtitle">Training Facility</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Mobile Header Right: Shopping Cart Icon -->
                        <div class="col-3 col-sm-3 d-lg-none d-flex align-items-center justify-content-end">
                            <a href="<?= base_url('/maintenance') ?>" class="mobile-cart-btn" title="Cart">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>

                        <!-- Desktop Navigation Menu -->
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

<!-- Mobile Offcanvas Side Drawer Overlay -->
<div id="mobile-drawer-backdrop" class="mobile-drawer-backdrop"></div>
<aside id="mobile-offcanvas-drawer" class="mobile-offcanvas-drawer">
    <div class="drawer-content">
        <nav class="drawer-nav">
            <ul>
                <li><a href="<?= site_url() ?>">HOME</a></li>
                <li><a href="<?= base_url('/about-us') ?>">ABOUT US</a></li>
                <li><a href="<?= base_url('/classes') ?>">CLASSES</a></li>
                <li><a href="<?= base_url('/pricing') ?>">MEMBERSHIP</a></li>
                <li><a href="<?= base_url('/merch') ?>">MERCH</a></li>
            </ul>
        </nav>
    </div>
    <div class="drawer-bg-image"></div>
</aside>

<style>
/* Custom Navbar Styles to match mockup */
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
ul#navigation li a::before {
    display: none !important;
}

/* Black Box Logo Container (Punjul / Protruding Desktop) */
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

/* Mobile Header Elements */
@media (max-width: 991px) {
    .header-area .main-header-area {
        height: 70px !important;
        padding: 0 15px !important;
        background-color: #141414 !important;
    }
    
    /* Hamburger Menu Toggle Button */
    .mobile-drawer-btn {
        background: transparent;
        border: none;
        padding: 5px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 5px;
        outline: none !important;
        z-index: 10001;
    }
    .mobile-drawer-btn .hamburger-bar {
        display: block;
        width: 22px;
        height: 2px;
        background-color: #ffffff;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    .mobile-drawer-btn:hover .hamburger-bar {
        background-color: #FF1414;
    }

    /* Mobile Logo Centered Black Box */
    .mobile-logo-box {
        background: #000000;
        padding: 8px 18px 10px 18px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.7);
        position: relative;
        top: 8px;
    }
    .mobile-logo-img {
        max-height: 20px;
        width: auto;
        display: block;
        margin-bottom: 2px;
    }
    .mobile-logo-subtitle {
        font-family: 'Inter', 'Montserrat', sans-serif;
        font-size: 9px;
        font-weight: 700;
        color: #ffffff;
        line-height: 1;
        text-transform: none;
        display: block;
    }

    /* Mobile Shopping Cart Button */
    .mobile-cart-btn {
        color: #ffffff !important;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
        transition: color 0.2s ease;
    }
    .mobile-cart-btn:hover {
        color: #FF1414 !important;
    }
}

/* Offcanvas Drawer Navigation Styles (Matching Image 2) */
.mobile-drawer-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(3px);
    z-index: 100000;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}
.mobile-drawer-backdrop.active {
    opacity: 1;
    visibility: visible;
}

.mobile-offcanvas-drawer {
    position: fixed;
    top: 0;
    left: -100%;
    width: 55vw;
    max-width: 280px;
    min-width: 220px;
    height: 100vh;
    background-color: #050505;
    z-index: 100001;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 10px 0 30px rgba(0, 0, 0, 0.8);
    overflow: hidden;
}
.mobile-offcanvas-drawer.active {
    left: 0;
}

.drawer-content {
    padding: 90px 25px 30px 30px;
    position: relative;
    z-index: 2;
}

.drawer-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.drawer-nav ul li a {
    font-family: 'Inter', 'Montserrat', sans-serif;
    font-size: 15px;
    font-weight: 800;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    text-decoration: none;
    display: inline-block;
    transition: color 0.2s ease, transform 0.2s ease;
}

.drawer-nav ul li a:hover,
.drawer-nav ul li a:active {
    color: #FF1414;
    transform: translateX(4px);
}

.drawer-bg-image {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 55%;
    background-image: linear-gradient(to top, rgba(0, 0, 0, 0.2), rgba(5, 5, 5, 1)), url('<?= base_url("img/bg-3.jpeg") ?>');
    background-size: cover;
    background-position: bottom left;
    opacity: 0.85;
    pointer-events: none;
    z-index: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var drawerToggle = document.getElementById('mobile-drawer-toggle');
    var drawer = document.getElementById('mobile-offcanvas-drawer');
    var backdrop = document.getElementById('mobile-drawer-backdrop');
    var drawerLinks = document.querySelectorAll('.drawer-nav ul li a');

    function openDrawer() {
        if (drawer && backdrop) {
            drawer.classList.add('active');
            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeDrawer() {
        if (drawer && backdrop) {
            drawer.classList.remove('active');
            backdrop.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (drawerToggle) {
        drawerToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            if (drawer.classList.contains('active')) {
                closeDrawer();
            } else {
                openDrawer();
            }
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeDrawer);
    }

    drawerLinks.forEach(function(link) {
        link.addEventListener('click', closeDrawer);
    });
});
</script>