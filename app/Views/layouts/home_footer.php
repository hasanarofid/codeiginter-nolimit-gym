<!-- footer_start  -->
<footer class="footer" id="contact" style="background-color: #0b0b0b; padding-top: 60px; padding-bottom: 0; color: #cccccc;">
    <style>
    .footer {
        background-color: #0b0b0b !important;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }
    .footer .footer_title {
        font-family: 'Inter', 'Montserrat', sans-serif !important;
        font-weight: 800 !important;
        font-size: 18px !important;
        color: #ffffff !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        margin-bottom: 25px !important;
        position: relative;
    }
    .footer .footer_title::after {
        content: '';
        display: block;
        width: 35px;
        height: 2px;
        background-color: #ff1414;
        margin-top: 8px;
    }
    .footer .footer_widget .links {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .footer .footer_widget .links li {
        margin-bottom: 12px !important;
    }
    .footer .footer_widget .links li a {
        color: #aaaaaa !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        display: inline-block;
    }
    .footer .footer_widget .links li a:hover {
        color: #ff1414 !important;
        transform: translateX(4px);
    }
    .footer-social-icon {
        color: #ffffff !important;
        font-size: 1.5rem !important;
        width: 42px;
        height: 42px;
        background-color: #1a1a1a;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }
    .footer-social-icon:hover {
        background-color: #ff1414 !important;
        border-color: #ff1414 !important;
        color: #ffffff !important;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 20, 20, 0.4);
    }
    .location-item {
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.08);
    }
    .location-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .location-item strong {
        color: #ffffff !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        letter-spacing: 0.5px !important;
        display: block;
        margin-bottom: 4px;
    }
    .location-item p {
        color: #999999 !important;
        font-size: 12px !important;
        line-height: 1.5 !important;
        margin-bottom: 6px !important;
    }
    .location-item a.phone-link {
        color: #ff1414 !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity 0.2s ease;
    }
    .location-item a.phone-link:hover {
        opacity: 0.8;
    }
    @media (max-width: 767px) {
        .footer_top {
            padding-bottom: 20px !important;
        }
        .footer_widget {
            margin-bottom: 35px !important;
        }
    }
    </style>

    <div class="footer_top" style="padding: 40px 0 30px 0; background-color: #0c0c0c;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <!-- Brand Logo & Description & Social Links -->
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="footer_widget mb-0 d-flex flex-column align-items-center">
                        <div class="footer_logo mb-3">
                            <a href="<?= site_url() ?>" style="text-decoration: none;">
                                <div style="background: #000000; padding: 10px 18px; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 6px; box-shadow: 0 4px 15px rgba(0,0,0,0.6); border: 1px solid rgba(255,255,255,0.15);">
                                    <img src="<?= base_url('img/logo_text.PNG'); ?>" alt="NO LIMITS" style="max-height: 22px; width: auto; display: block; margin-bottom: 2px;">
                                    <span style="font-family: 'Inter', 'Montserrat', sans-serif; font-size: 9px; font-weight: 700; color: #ffffff; line-height: 1; text-transform: none; display: block;">Training Facility</span>
                                </div>
                            </a>
                        </div>
                        <p style="font-size: 13px; color: #888888; line-height: 1.6; margin-bottom: 20px; max-width: 500px;">
                            No Limits is more than just a gym. It's a sanctuary to push your physical and mental boundaries.
                        </p>
                        <div class="socail_links d-flex align-items-center justify-content-center" style="gap: 12px;">
                            <a href="https://www.instagram.com/nolimitstrainingfclty" target="_blank" class="footer-social-icon" title="Instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                            <a href="https://youtube.com/@nolimitstrainingfacility" target="_blank" class="footer-social-icon" title="YouTube">
                                <i class="fa fa-youtube-play"></i>
                            </a>
                            <a href="https://wa.me/6287866860310" target="_blank" class="footer-social-icon" title="WhatsApp">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright Area -->
    <div class="copy-right_text" style="background-color: #050505; border-top: 1px solid rgba(255, 255, 255, 0.05); padding: 20px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12">
                    <p class="copy_right text-center" style="margin: 0; font-size: 12px; color: #777777;">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> <strong>NO LIMITS Training Facility</strong>. All rights reserved | Developed with <i class="fa fa-heart" style="color: #ff1414;" aria-hidden="true"></i> by <a href="https://www.cekotechnology.com/" target="_blank" style="color: #ff1414; font-weight: 700; text-decoration: none;">Cekotechnology</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer_end  -->

<!-- JS here -->
<script src="<?= base_url(); ?>tema/tema-satu/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/popper.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/isotope.pkgd.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/ajax-form.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/waypoints.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/jquery.counterup.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/scrollIt.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/jquery.scrollUp.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/wow.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/gijgo.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/nice-select.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/jquery.slicknav.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/plugins.js"></script>



<!--contact js-->
<script src="<?= base_url(); ?>tema/tema-satu/js/contact.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/jquery.form.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>tema/tema-satu/js/mail-script.js"></script>


<script src="<?= base_url(); ?>tema/tema-satu/js/main.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function() {
        function adjustCarousel(carouselId) {
            let carousel = $(carouselId); // Context-specific carousel
            let items = carousel.find('.carousel-item .col-lg-4');
            let visibleItems = $(window).width() >= 992 ? 3 : $(window).width() >= 768 ? 2 : 1;
            let rows = Math.ceil(items.length / visibleItems);

            carousel.find('.carousel-inner').html(''); // Clear existing items
            for (let i = 0; i < rows; i++) {
                let carouselItem = $('<div class="carousel-item"></div>');
                let row = $('<div class="row"></div>');

                for (let j = 0; j < visibleItems; j++) {
                    let index = i * visibleItems + j;
                    if (index < items.length) {
                        row.append(items[index]);
                    }
                }

                carouselItem.append(row);
                if (i === 0) carouselItem.addClass('active');
                carousel.find('.carousel-inner').append(carouselItem);
            }
        }

        // Adjust each carousel individually
        adjustCarousel('#trainerCarousel');
        adjustCarousel('#coachCarousel');

        $(window).resize(function() {
            adjustCarousel('#trainerCarousel');
            adjustCarousel('#coachCarousel');
        });
    });
</script>