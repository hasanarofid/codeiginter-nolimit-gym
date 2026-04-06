<!-- footer_start  -->
<footer class="footer" id="contact">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 ">
                    <div class="footer_widget">
                        <div class="footer_logo">
                            <a href="<?= site_url() ?>">
                                <img src="tema/tema-satu/img/logo.png" alt="no_limits">
                            </a>
                        </div>

                        <div class="socail_links">
                            <ul>
                                <li>
                                    <a href="https://www.instagram.com/nolimitstrainingfclty" target="_blank">
                                        <i class="fa fa-instagram" style="font-size: 3.5em !important;"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://youtube.com/@nolimitstrainingfacility" target="_blank">
                                        <i class="fa fa-youtube-play" style="font-size: 3.5em !important;"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4 offset-xl-1">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Useful Links
                        </h3>
                        <ul class="links">
                            <li><a href="#about-us">About</a></li>
                            <li><a href="#features">Features</a></li>
                            <li><a href="#class_schedule">Class Schedule</a></li>
                            <li><a href="#boxing_muaythai">Boxing /Muaythai</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#trainer_area">Personal Trainer</a></li>
                            <li><a href="#coach_area">Coach Trainer</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Our Location
                        </h3>
                        <?php
                        foreach ($cabang_footer as $row):
                        ?>
                            <p class="newsletter_text">
                                <?= $row['alamat'] ?>
                            </p>
                            <br />
                        <?php
                        endforeach;
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-12">
                    <p class="copy_right text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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