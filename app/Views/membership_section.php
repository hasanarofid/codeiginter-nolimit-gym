<?= $this->extend('layouts/home_template'); ?>
<?= $this->section('contenthome'); ?>

<div class="priscing_area" id="pricing" style="padding-top: 180px; padding-bottom: 120px;">
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

<?= $this->endSection(); ?>
