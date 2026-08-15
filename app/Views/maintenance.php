<?= $this->extend('layouts/home_template'); ?>
<?= $this->section('contenthome'); ?>

<div class="maintenance-area" style="padding: 180px 20px 120px 20px; background-color: #121212; min-height: 70vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background: rgba(20, 20, 20, 0.95); border: 1px solid rgba(255, 20, 20, 0.3); border-radius: 16px; padding: 60px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.8);">
                    <i class="fa fa-wrench" style="font-size: 4rem; color: #FF1414; margin-bottom: 25px;"></i>
                    <h1 style="font-size: 42px; font-weight: 800; font-style: italic; color: #ffffff; text-transform: uppercase; margin-bottom: 15px;">We'll be back soon!</h1>
                    <p style="font-size: 18px; color: #cccccc; margin-bottom: 30px; line-height: 1.6;">Sorry for the inconvenience but we're performing some maintenance at the moment.</p>
                    <p style="font-size: 16px; color: #888888; margin-bottom: 35px;">&mdash; No Limits Team &mdash;</p>
                    <a href="<?= site_url() ?>" class="boxed-btn3" style="background: #FF1414; color: #ffffff; font-weight: 700; text-transform: uppercase; padding: 14px 35px; border-radius: 4px; display: inline-block; text-decoration: none; transition: 0.3s;">
                        Go Back Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
