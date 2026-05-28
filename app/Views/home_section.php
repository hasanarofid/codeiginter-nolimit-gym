<?= $this->extend('layouts/home_template'); ?>
<?= $this->section('contenthome'); ?>
<!-- slider_area_start -->
<div class="slider_area">
    <div class="slider_active owl-carousel">
        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <span>Join</span>
                            <!-- <h3>NO LIMITS</h3> -->
                            <img class="img-fluid" src="<?= base_url("/img/logo_text.png") ?>" />
                            <p>Team</p>
                            <a href="<?= base_url('/registration') ?>" class="boxed-btn3">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider  d-flex align-items-center slider_bg_2 overlay">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <span>Join</span>
                            <!-- <h3>NO LIMITS</h3> -->
                            <img class="img-fluid" src="<?= base_url("/img/logo_text.png") ?>" />
                            <p>Body Combat</p>
                            <a href="<?= base_url('/registration') ?>" class="boxed-btn3">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider  d-flex align-items-center slider_bg_3 overlay">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <span>Join</span>
                            <!-- <h3>NO LIMITS</h3> -->
                            <img class="img-fluid" src="<?= base_url("/img/logo_text.png") ?>" />
                            <p>Boxing / Muaythai</p>
                            <a href="<?= base_url('/registration') ?>" class="boxed-btn3">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider  d-flex align-items-center slider_bg_4 overlay">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <span>Join</span>
                            <!-- <h3>NO LIMITS</h3> -->
                            <img class="img-fluid" src="<?= base_url("/img/logo_text.png") ?>" />
                            <p>Inside Flow</p>
                            <a href="<?= base_url('/registration') ?>" class="boxed-btn3">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- marquee_start -->
<div class="marquee-wrapper" style="background: #212121; color: #656565; padding: 20px 0; overflow: hidden; position: relative; white-space: nowrap; display: flex; cursor: pointer;">
    <div class="marquee-content" style="display: flex; white-space: nowrap; animation: marquee-scroll 25s linear infinite; font-size: 44px; font-weight: 800; text-transform: uppercase; letter-spacing: 3px; line-height: 1;">
        <!-- First Block -->
        <div>
            FIGHT CLASS // POWER LIFTING // CARDIO // BODYBUILDING // FIGHT CLASS // POWER LIFTING // CARDIO // BODYBUILDING // FIGHT CLASS // POWER LIFTING // CARDIO // BODYBUILDING //&nbsp;
        </div>
        <!-- Second Block (Duplicate) -->
        <div>
            FIGHT CLASS // POWER LIFTING // CARDIO // BODYBUILDING // FIGHT CLASS // POWER LIFTING // CARDIO // BODYBUILDING // FIGHT CLASS // POWER LIFTING // CARDIO // BODYBUILDING //&nbsp;
        </div>
    </div>
</div>
<style>
.marquee-wrapper:hover .marquee-content {
    animation-play-state: paused;
}
@keyframes marquee-scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>
<!-- marquee_end -->

<!-- branch_locations_start -->
<div class="branch-slider-wrapper" style="background: #212121; position: relative;">
    <!-- Tabs -->
    <div class="branch-tabs-container" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="container d-flex justify-content-center align-items-center flex-wrap" style="gap: 40px; padding-left: 15px; padding-right: 15px;">
            <?php foreach ($cabangs as $index => $cab): ?>
                <button type="button" class="branch-tab-btn" data-index="<?= $index ?>">
                    <?= strtoupper($cab['nama']) ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Slides Container -->
    <div class="branch-slides-container" style="position: relative; overflow: hidden; background: #000; display: none;">
        <?php foreach ($cabangs as $index => $cab): ?>
            <?php
                // Check if this branch is Muladi Dome
                $is_muladi = (stripos($cab['nama'], 'muladi') !== false);
                $map_url = 'https://maps.google.com/?q=' . urlencode($cab['alamat']);
                if ($is_muladi) {
                    $map_url = 'https://maps.app.goo.gl/Eu2xBkz821Ja98xH6';
                    $slide_img = base_url('img/nolimit-muladi-dom-slider.webp');
                } else if ($index === 0) {
                    $slide_img = base_url('img/nolimit-muladi-dom-slider.webp');
                } else if ($index === 1) {
                    $slide_img = base_url('img/nolimit-muladi-dom-slider.webp');
                } else {
                    $slide_img = base_url('img/nolimit-muladi-dom-slider.webp');
                }
            ?>
            <div class="branch-slide-panel" id="branch-panel-<?= $index ?>" style="display: none; position: relative; width: 100%;">
                <a href="<?= $map_url ?>" target="_blank" style="display: block; width: 100%; position: relative; line-height: 0;">
                    <img src="<?= $slide_img ?>" alt="<?= esc($cab['nama']) ?>" style="width: 100%; height: auto; display: block;" />
                    
                    <?php if ($is_muladi): ?>
                    <!-- Overlay map area on top of the "FIND US" button in the mockup image -->
                    <span class="find-us-overlay" style="position: absolute; bottom: 8%; right: 5%; width: 18%; height: 10%; cursor: pointer; z-index: 10;"></span>
                    <?php endif; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.branch-tab-btn {
    background: none !important;
    border: none !important;
    color: #656565 !important;
    font-size: 20px !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 1.5px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    padding: 5px 20px !important;
    outline: none !important;
    position: relative !important;
    font-family: 'Inter', 'Montserrat', sans-serif !important;
}
.branch-tab-btn:hover,
.branch-tab-btn.active {
    color: #FFFFFF !important;
    text-decoration: none !important;
}
.branch-tab-btn::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 50%;
    width: 0;
    height: 2px;
    background-color: #ff1414;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}
.branch-tab-btn.active::after {
    width: 80%;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function initBranchSlider() {
        if (typeof jQuery === 'undefined') {
            setTimeout(initBranchSlider, 50);
            return;
        }

        var tabBtns = jQuery('.branch-tab-btn');
        var slidesContainer = jQuery('.branch-slides-container');
        var slidePanels = jQuery('.branch-slide-panel');
        var currentActiveIndex = null;

        tabBtns.on('click', function() {
            var index = jQuery(this).data('index');
            
            // If clicking the already active tab, slide it up and deactivate
            if (jQuery(this).hasClass('active') && currentActiveIndex === index) {
                jQuery(this).removeClass('active');
                slidesContainer.slideUp(500);
                currentActiveIndex = null;
                return;
            }

            // Remove active class from all tabs
            tabBtns.removeClass('active');
            // Add active class to clicked tab
            jQuery(this).addClass('active');

            if (currentActiveIndex === null) {
                // First time opening: show target panel, slide down container
                slidePanels.hide();
                jQuery('#branch-panel-' + index).show();
                slidesContainer.slideDown(500);
            } else {
                // Transitioning between panels: cross-fade smoothly without container collapsing
                var oldPanel = jQuery('#branch-panel-' + currentActiveIndex);
                var newPanel = jQuery('#branch-panel-' + index);
                
                slidesContainer.css('height', slidesContainer.height()); // lock height during transition
                oldPanel.fadeOut(200, function() {
                    newPanel.fadeIn(200, function() {
                        slidesContainer.css('height', ''); // unlock height
                    });
                });
            }
            currentActiveIndex = index;
        });
    }
    initBranchSlider();
});
</script>
<!-- branch_locations_end -->

<style>
.location-link {
    color: #777;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: none;
    transition: color 0.3s;
    font-size: 1rem;
    padding: 5px 15px;
}
.location-link:hover {
    color: #FF1414;
    text-decoration: none;
}
.location-box {
    border: 1px solid #FF1414;
    padding: 10px 15px;
    display: inline-flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    border-radius: 5px;
}
</style>
<!-- slider_area_start -->
<div class="bradcam_area" id="about-us">
    <div class="single_bradcam d-flex align-items-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('<?= base_url("img/bg-about-us.webp") ?>'); background-size: cover; background-position: center center; padding: 80px 0;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <!-- About Us Title -->
                    <h2 style="color: #ffe2b6; font-weight: 800; font-style: italic; font-size: 3.5rem; margin-bottom: 20px;">ABOUT US</h2>
                    
                    <!-- About Us Text -->
                    <p style="color: #DDD; font-size: 1.1rem; line-height: 1.6; margin-bottom: 40px; text-align: center;">
                        No Limits Training Facility menyediakan fasilitas lengkap untuk Powerlifting, Body Building, Boxing, & Cardio yang dirancang untuk mendukung berbagai tujuan latihan, mulai dari meningkatkan performa, membangun massa otot, menjaga kebugaran, hingga melatih mental dan disiplin. Sejak berdiri pada tahun 2021, No Limits terus berkembang menjadi tempat latihan dengan suasana yang solid dan penuh motivasi, didukung oleh penggunaan peralatan modern dan berkualitas, komunitas yang terus bertumbuh, serta berbagai event dan aktivitas yang rutin diadakan untuk membangun semangat, koneksi, dan kultur latihan yang kuat bagi setiap member.
                    </p>

                    <!-- Our Location -->
                    <h5 style="color: #ffe2b6; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; font-size: 1rem;">OUR LOCATION</h5>
                    <div class="d-flex justify-content-center mb-5">
                        <div >
                            <?php foreach ($cabangs as $cab): ?>
                                <a href="https://maps.google.com/?q=<?= urlencode($cab['alamat']) ?>" target="_blank" class="location-link">
                                    <?= strtoupper($cab['nama']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Our Social Media -->
                    <h5 style="color: #ffe2b6; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; font-size: 1rem;">OUR SOCIAL MEDIA</h5>
                    <div class="d-flex justify-content-center align-items-center" style="gap: 30px; margin-bottom: 15px;">
                        <a href="#" style="color: #FFF; font-size: 3rem; transition: 0.3s;" onmouseover="this.style.color='#FF1414'" onmouseout="this.style.color='#FFF'"><i class="fa fa-instagram"></i></a>
                        
                        <!-- QR Code Placeholder -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=https://wa.me/6281802490343" alt="QR Code" style="width: 100px; height: 100px; border: 2px solid #FFF; padding: 5px; border-radius: 10px; background: #FFF;">
                        
                        <a href="https://wa.me/6281802490343" target="_blank" style="color: #FFF; font-size: 3rem; transition: 0.3s;" onmouseover="this.style.color='#FF1414'" onmouseout="this.style.color='#FFF'"><i class="fa fa-whatsapp"></i></a>
                    </div>
                    <div>
                        <a href="https://wa.me/6281802490343" target="_blank" style="color: #FFF; font-weight: bold; font-size: 1.2rem; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#FF1414'" onmouseout="this.style.color='#FFF'">
                            <i class="fa fa-whatsapp"></i> 0818-0249-0343
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- pricing_area_start -->
<div class="priscing_area" id="pricing">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-5">
                    <h2 style="color: #FFF; font-weight: 800; font-style: italic; font-size: 3.5rem; text-transform: uppercase;">MEMBERSHIP PACKAGES</h2>
                </div>
            </div>
        </div>

        <?= $packages ?>
    </div>
</div>
<!-- pricing_area_end -->

<style>
/* Custom Premium Membership Package styling to match mockup */
#pricing {
    background-image: url('<?= base_url("img/bg-3.jpeg") ?>') !important;
    background-size: cover !important;
    background-position: center center !important;
    padding: 100px 0 !important;
    position: relative !important;
}
#pricing::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6) !important;
    z-index: 1;
}
#pricing .container {
    position: relative;
    z-index: 2;
}
.membership-box {
    position: relative !important;
    background: rgba(0, 0, 0, 0.85) !important;
    border: 3px solid #ff1414 !important;
    border-radius: 20px !important;
    padding: 50px 30px 45px 30px !important;
    color: #FFF !important;
    overflow: hidden !important;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5) !important;
}
.membership-box::before {
    content: "" !important;
    position: absolute !important;
    top: 0 !important; 
    left: 0 !important; 
    right: 0 !important; 
    bottom: 0 !important;
    background-image: url('<?= base_url("img/logo-transparent.png") ?>') !important;
    background-repeat: no-repeat !important;
    background-position: center center !important;
    background-size: 280px !important;
    opacity: 0.08 !important;
    z-index: 1 !important;
    pointer-events: none !important;
}
.membership-box-content {
    position: relative !important;
    z-index: 2 !important;
}
.membership-join-btn {
    background: #ff1414 !important;
    color: #000000 !important;
    font-weight: 800 !important;
    font-style: italic !important;
    font-family: 'Inter', 'Montserrat', sans-serif !important;
    padding: 14px 50px !important;
    font-size: 1.35rem !important;
    display: inline-block !important;
    margin-bottom: 5px !important;
    text-transform: uppercase !important;
    border: none !important;
    border-radius: 0px !important;
    transition: all 0.3s ease !important;
    line-height: 1 !important;
}
.membership-join-btn:hover {
    background: #e61010 !important;
    color: #000000 !important;
    transform: scale(1.05) !important;
    box-shadow: 0 5px 15px rgba(255, 20, 20, 0.4) !important;
}
.membership-wa-link {
    color: #FFF !important;
    font-weight: 800 !important;
    font-size: 1.2rem !important;
    text-decoration: none !important;
    transition: color 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}
.membership-wa-link:hover {
    color: #ff1414 !important;
}
.membership-box table,
.membership-box table tr,
.membership-box table td {
    border: none !important;
}
</style>

<!-- features_area_start  -->
<div class="features_area features_bg" id="features">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-73">
                    <h3>Our Facilities</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_feature text-center mb-73">
                    <div class="icon">
                        <img src="tema/tema-satu/img/svg_icon/1.svg" alt="">
                    </div>
                    <h4>Powerlifting Equipments</h4>
                    <p>Latihan angkat beban untuk membangun kekuatan dan massa otot secara efektif.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_feature text-center">
                    <div class="icon">
                        <img src="tema/tema-satu/img/svg_icon/bodybuilder.png" alt="">
                    </div>
                    <h4>Bodybuilding Equipments</h4>
                    <p>Latihan fokus untuk mengembangkan otot tertentu sesuai kebutuhan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_feature text-center">
                    <div class="icon">
                        <img src="tema/tema-satu/img/svg_icon/boxing-gloves.png" alt="">
                    </div>
                    <h4>Combat Sports Equipments</h4>
                    <p>Gerakan peregangan untuk meningkatkan fleksibilitas dan kekuatan otot.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_feature text-center">
                    <div class="icon">
                        <img src="tema/tema-satu/img/svg_icon/aerobics.png" alt="">
                    </div>
                    <h4>Group Class</h4>
                    <p>No Limits menyediakan kelas - kelas yang dapat Anda ikuti.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_feature text-center">
                    <div class="icon">
                        <img src="tema/tema-satu/img/svg_icon/4.svg" alt="">
                    </div>
                    <h4>Cardio Exercise</h4>
                    <p>Latihan kardiovaskular untuk meningkatkan stamina dan kesehatan jantung.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_feature text-center">
                    <div class="icon">
                        <img src="tema/tema-satu/img/svg_icon/other.png" alt="">
                    </div>
                    <h4>Others</h4>
                    <p>Locker, Shower, Towel, Water Dispenser</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- features_area_end  -->

<!-- schedule_area_start -->
<div class="priscing_area" id="class_schedule">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-73">
                    <h3>Class Schedule</h3>
                </div>
            </div>
        </div>

        <?php
        foreach ($cabangs as $cab):
        ?>
            <div class="row mb-73">
                <div class="col-xl-12">
                    <div class="section_title">
                        <h4 style="color:#FFF !important;"><?= $cab['nama'] ?></h4>
                        <p><?= $cab['alamat'] ?></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                    <th>Minggu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getjadwal = $classes->tabel_kelas($cab['id']);

                                if (count($getjadwal) > 0) {
                                    $xx = 1;
                                    foreach ($getjadwal as $row):
                                ?>
                                        <tr>
                                            <td><?= $xx ?></td>
                                            <td><?= htmlspecialchars($row['Waktu']) ?></td>
                                            <td><?= $row['Senin'] ?></td>
                                            <td><?= $row['Selasa'] ?></td>
                                            <td><?= $row['Rabu'] ?></td>
                                            <td><?= $row['Kamis'] ?></td>
                                            <td><?= $row['Jumat'] ?></td>
                                            <td><?= $row['Sabtu'] ?></td>
                                            <td><?= $row['Minggu'] ?></td>
                                        </tr>
                                    <?php
                                        $xx++;
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="9">
                                            <p>Belum Ada Jadwal Kelas</p>
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>

    </div>
</div>

<div class="priscing_area" id="boxing_muaythai">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-73">
                    <h3>Boxing / Muaythai Schedule</h3>
                </div>
            </div>
        </div>

        <?php
        foreach ($cabangs as $cab):
        ?>
            <div class="row mb-73">
                <div class="col-xl-12">
                    <div class="section_title">
                        <h4 style="color:#FFF !important;"><?= $cab['nama'] ?></h4>
                        <p><?= $cab['alamat'] ?></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                    <th>Minggu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getbothai = $bothai->tabel_bothai($cab['id']);

                                if (count($getbothai) > 0) {
                                    $xx = 1;
                                    foreach ($getbothai as $row):
                                ?>
                                        <tr>
                                            <td><?= $xx ?></td>
                                            <td><?= htmlspecialchars($row['Waktu']) ?></td>
                                            <td><?= $row['Senin'] ?></td>
                                            <td><?= $row['Selasa'] ?></td>
                                            <td><?= $row['Rabu'] ?></td>
                                            <td><?= $row['Kamis'] ?></td>
                                            <td><?= $row['Jumat'] ?></td>
                                            <td><?= $row['Sabtu'] ?></td>
                                            <td><?= $row['Minggu'] ?></td>
                                        </tr>
                                    <?php
                                        $xx++;
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="9">
                                            <p>Belum Ada Jadwal</p>
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>

    </div>
</div>
<!-- schedule_area_end -->



<!-- team_area_start  -->
<div class="team_area team_bg_23 overlay2" id="trainer_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-73">
                    <h3>Personal Trainers</h3>
                </div>
            </div>
        </div>

        <div id="trainerCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <?php
                        $idx = 0;
                        foreach ($trainers as $train):
                        ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single_team text-center">
                                    <div class="team_thumb">
                                        <img src="<?= base_url() ?>img/uploads/fp/<?= $train['foto'] ?>" class="img-fluid" alt="<?= str_replace(" ", "_", $train['nama']) ?>">
                                    </div>
                                    <div class="team_title">
                                        <h3><?= strtoupper(strtolower($train['nama'])) ?></h3>
                                        <a href="https://wa.me/<?= $train['hp'] ?>?text=Hi%20<?= str_replace(' ', '%20', $train['nama']) ?>" class="boxed-btn3">Chat Me</a>
                                    </div>
                                </div>
                            </div>
                            <?php if (($idx + 1) % 3 == 0): ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                    <?php endif; ?>
                <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#trainerCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#trainerCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!-- team_area_end  -->

<!-- team_area_start  -->
<div class="team_area team_bg_1 overlay2" id="coach_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-73">
                    <h3>Coach Boxing / Muaythai</h3>
                </div>
            </div>
        </div>

        <div id="coachCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <?php
                        $index = 0;
                        foreach ($coaches as $koch):
                        ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single_team text-center">
                                    <div class="team_thumb">
                                        <img src="<?= base_url() ?>img/uploads/fp/<?= $koch['foto'] ?>" class="img-fluid" alt="<?= str_replace(" ", "_", $koch['nama']) ?>">
                                    </div>
                                    <div class="team_title">
                                        <h3><?= strtoupper(strtolower($koch['nama'])) ?></h3>
                                        <a href="https://wa.me/<?= $koch['hp'] ?>?text=Hi%20<?= str_replace(' ', '%20', $koch['nama']) ?>" class="boxed-btn3">Chat Me</a>
                                    </div>
                                </div>
                            </div>
                            <?php if (($index + 1) % 3 == 0): ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                    <?php endif; ?>
                <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#coachCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#coachCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!-- team_area_end  -->

<?= $this->endSection(); ?>