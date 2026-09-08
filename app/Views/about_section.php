<?= $this->extend('layouts/home_template'); ?>
<?= $this->section('contenthome'); ?>

<div class="bradcam_area" id="about-us">
    <div class="single_bradcam d-flex align-items-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.82), rgba(0, 0, 0, 0.82)), url('<?= base_url("img/bg-about-us.webp") ?>'); background-size: cover; background-position: center center;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <!-- About Us Title -->
                    <h2 class="about-title">ABOUT US</h2>
                    
                    <!-- About Us Text -->
                    <p class="about-desc">
                        No Limits is more than just a gym. It’s therapy, a sanctuary, a place where you can use all your negative energy to lift the weights. Some people came here to be healthier or to be part of the fit communities. But some people also came here to heal from their past, some to find purpose. Among all that, this is a place where the body and the willpower is tested. We grow through the pain and the pressure. Because the human race has NO LIMITS.
                    </p>

                    <!-- Our Location -->
                    <h5 class="about-subtitle">OUR LOCATION</h5>
                    <div class="location-badges-wrap d-flex justify-content-center flex-wrap mb-5">
                        <?php foreach ($cabangs as $cab): ?>
                            <a href="https://maps.google.com/?q=<?= urlencode($cab['alamat']) ?>" target="_blank" class="location-badge">
                                <?= strtoupper(esc($cab['nama'])) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- Our Social Media -->
                    <h5 class="about-subtitle">OUR SOCIAL MEDIA</h5>
                    <div class="d-flex justify-content-center align-items-center flex-wrap about-social-row mb-3">
                        <a href="https://www.instagram.com/nolimitstrainingfclty" target="_blank" class="about-social-icon" title="Instagram">
                            <i class="fa fa-instagram"></i>
                        </a>
                        
                        <!-- QR Code -->
                        <div class="qr-box-wrap">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=https://wa.me/628786686030" alt="QR Code" class="qr-code-img">
                        </div>
                        
                        <a href="https://wa.me/628786686030" target="_blank" class="about-social-icon" title="WhatsApp">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                    </div>
                    <div>
                        <a href="https://wa.me/628786686030" target="_blank" class="about-wa-link">
                            <i class="fa fa-whatsapp"></i> 0818-0249-0343
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bradcam_area#about-us {
    padding-top: 0;
    background-color: #000000;
}
.single_bradcam {
    padding: 50px 20px 80px 20px;
    min-height: calc(100vh - 90px);
}
.about-title {
    color: #ffe2b6;
    font-weight: 900;
    font-style: italic;
    font-size: 3.5rem;
    margin-bottom: 25px;
    letter-spacing: 1px;
}
.about-subtitle {
    color: #ffe2b6;
    font-family: 'Inter', 'Montserrat', sans-serif;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-top: 30px;
    margin-bottom: 20px;
    font-size: 1.1rem;
}
.about-desc {
    color: #DDDDDD;
    font-size: 18px;
    font-weight: 500;
    line-height: 1.8;
    margin-bottom: 45px;
    text-align: center;
    max-width: 850px;
    margin-left: auto;
    margin-right: auto;
}
.location-badge {
    display: inline-block;
    color: #FFFFFF !important;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    text-decoration: none !important;
    padding: 8px 20px;
    margin: 5px 6px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 30px;
    transition: all 0.3s ease;
}
.location-badge:hover {
    background: #FF1414 !important;
    border-color: #FF1414 !important;
    color: #000000 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 20, 20, 0.4);
}
.about-social-row {
    gap: 30px;
}
.about-social-icon {
    color: #FFFFFF !important;
    font-size: 2.8rem;
    transition: all 0.3s ease;
    text-decoration: none !important;
}
.about-social-icon:hover {
    color: #FF1414 !important;
    transform: scale(1.1);
}
.qr-box-wrap {
    padding: 5px;
    background: #FFFFFF;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    display: inline-block;
}
.qr-code-img {
    width: 90px;
    height: 90px;
    display: block;
    border-radius: 8px;
}
.about-wa-link {
    color: #FFFFFF !important;
    font-weight: 700;
    font-size: 1.1rem;
    text-decoration: none !important;
    transition: color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.about-wa-link:hover {
    color: #FF1414 !important;
}

/* Mobile Responsiveness (<= 768px) */
@media (max-width: 768px) {
    .bradcam_area#about-us {
        padding-top: 70px;
    }
    .single_bradcam {
        padding: 60px 15px 70px 15px;
    }
    .about-title {
        font-size: 2.2rem;
        margin-top: 15px;
        margin-bottom: 20px;
    }
    .about-desc {
        font-size: 14px;
        line-height: 1.65;
        margin-bottom: 30px;
        padding: 0 5px;
    }
    .about-subtitle {
        font-size: 0.95rem;
        margin-top: 25px;
        margin-bottom: 15px;
        letter-spacing: 1.5px;
    }
    .location-badge {
        font-size: 12px;
        padding: 6px 14px;
        margin: 3px 4px;
    }
    .about-social-row {
        gap: 20px;
    }
    .about-social-icon {
        font-size: 2.2rem;
    }
    .qr-code-img {
        width: 75px;
        height: 75px;
    }
    .about-wa-link {
        font-size: 1rem;
    }
}
</style>

<?= $this->endSection(); ?>
