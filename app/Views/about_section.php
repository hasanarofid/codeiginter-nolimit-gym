<?= $this->extend('layouts/home_template'); ?>
<?= $this->section('contenthome'); ?>

<div class="bradcam_area" id="about-us" style="padding-top: 90px;">
    <div class="single_bradcam d-flex align-items-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('<?= base_url("img/bg-about-us.webp") ?>'); background-size: cover; background-position: center center; padding: 100px 0;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <!-- About Us Title -->
                    <h2 style="color: #ffe2b6; font-weight: 800; font-style: italic; font-size: 3.5rem; margin-bottom: 20px;">ABOUT US</h2>
                    
                    <!-- About Us Text -->
                    <p style="color: #DDD; font-size: 20px; font-weight: 500; line-height: 1.6; margin-bottom: 40px; text-align: center;">
                        No Limits is more than just a gym. It’s therapy, a sanctuary, a place where you can use all your negative energy to lift the weights. Some people came here to be healthier or to be part of the fit communities. But some people also came here to heal from their past, some to find purpose. Among all that, this is a place where the body and the willpower is tested. We grow through the pain and the pressure. Because the human race has NO LIMITS.
                    </p>

                    <!-- Our Location -->
                    <h5 style="color: #ffe2b6; font-family: 'Inter', 'Montserrat', sans-serif; font-weight: 400; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; font-size: 1rem;">OUR LOCATION</h5>
                    <div class="d-flex justify-content-center mb-5">
                        <div>
                            <?php foreach ($cabangs as $cab): ?>
                                <a href="https://maps.google.com/?q=<?= urlencode($cab['alamat']) ?>" target="_blank" class="location-link">
                                    <?= strtoupper($cab['nama']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Our Social Media -->
                    <h5 style="color: #ffe2b6; font-family: 'Inter', 'Montserrat', sans-serif; font-weight: 400; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; font-size: 1rem;">OUR SOCIAL MEDIA</h5>
                    <div class="d-flex justify-content-center align-items-center" style="gap: 30px; margin-bottom: 15px;">
                        <a href="https://www.instagram.com/nolimitstrainingfclty" target="_blank" style="color: #FFF; font-size: 3rem; transition: 0.3s;" onmouseover="this.style.color='#FF1414'" onmouseout="this.style.color='#FFF'"><i class="fa fa-instagram"></i></a>
                        
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

<style>
.location-link {
    color: #FFF;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: none;
    transition: color 0.3s;
    font-size: 20px;
    padding: 5px 15px;
}
.location-link:hover {
    color: #FF1414;
    text-decoration: none;
}
</style>

<?= $this->endSection(); ?>
