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
                <div class="col-xl-2 col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Useful Links
                        </h3>
                        <ul class="links">
                            <li><a href="<?= base_url('/about-us') ?>">ABOUT US</a></li>
                            <li><a href="<?= base_url('/classes') ?>">CLASSES</a></li>
                            <li><a href="<?= base_url('/events') ?>">EVENT</a></li>
                            <li><a href="<?= base_url('/pricing') ?>">MEMBERSHIP</a></li>
                            <li><a href="<?= base_url('/merch') ?>">MERCH</a></li>
                            <li><a href="<?= base_url('/login') ?>">MEMBER LOGIN</a></li>
                        </ul>
                    </div>
                </div>

                <?php
                $loc_part1 = [];
                $loc_part2 = [];
                foreach ($cabang_footer as $c) {
                    $nama_lower = strtolower($c['nama']);
                    if (strpos($nama_lower, 'muladi') !== false || strpos($nama_lower, 'gik') !== false || strpos($nama_lower, 'muldom') !== false) {
                        $loc_part2[] = $c;
                    } else {
                        $loc_part1[] = $c;
                    }
                }
                if (empty($loc_part2) && count($cabang_footer) > 3) {
                    $loc_part1 = array_slice($cabang_footer, 0, 3);
                    $loc_part2 = array_slice($cabang_footer, 3);
                }
                ?>

                <!-- Column 3: Our Location (Part 1) -->
                <div class="col-xl-3 col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Our Location
                        </h3>
                        <?php foreach ($loc_part1 as $row): ?>
                            <p class="newsletter_text" style="margin-bottom: 20px;">
                                <strong style="color: #ffffff; font-size: 14px; font-weight: 800; display: block; margin-bottom: 3px; letter-spacing: 0.5px;">
                                    <?= strtoupper(esc($row['nama'])) ?>
                                </strong>
                                <span style="color: #cccccc; display: block; margin-bottom: 4px; line-height: 1.4; font-size: 12px;">
                                    <?= esc($row['alamat']) ?>
                                </span>
                                <?php 
                                    $phone = !empty($row['hp']) ? $row['hp'] : (!empty($row['telp']) ? $row['telp'] : '0818-0249-0343');
                                ?>
                                <span style="color: #ff1414; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa fa-phone"></i> <?= esc($phone) ?>
                                </span>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Column 4: Our Location (Part 2: Muladi Dome & GIK UGM) -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="footer_widget">
                        <h3 class="footer_title d-none d-lg-block" style="opacity: 0;">
                            Location Part 2
                        </h3>
                        <?php foreach ($loc_part2 as $row): ?>
                            <p class="newsletter_text" style="margin-bottom: 20px;">
                                <strong style="color: #ffffff; font-size: 14px; font-weight: 800; display: block; margin-bottom: 3px; letter-spacing: 0.5px;">
                                    <?= strtoupper(esc($row['nama'])) ?>
                                </strong>
                                <span style="color: #cccccc; display: block; margin-bottom: 4px; line-height: 1.4; font-size: 12px;">
                                    <?= esc($row['alamat']) ?>
                                </span>
                                <?php 
                                    $phone = !empty($row['hp']) ? $row['hp'] : (!empty($row['telp']) ? $row['telp'] : '0818-0249-0343');
                                ?>
                                <span style="color: #ff1414; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa fa-phone"></i> <?= esc($phone) ?>
                                </span>
                            </p>
                        <?php endforeach; ?>
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