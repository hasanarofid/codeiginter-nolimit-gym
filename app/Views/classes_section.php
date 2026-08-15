<?= $this->extend('layouts/home_template'); ?>
<?= $this->section('contenthome'); ?>

<div class="muaythai-schedule-section" id="boxing_muaythai" style="padding-top: 130px;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Tables Column -->
            <div class="col-lg-7">
                <!-- MULADI DOME Table -->
                <div class="branch-schedule-wrapper mb-5">
                    <div class="d-flex flex-column align-items-start">
                        <h3 class="branch-title w-100 text-center">MULADI DOME</h3>
                        <span class="branch-subtitle">• ADVANCE CLASS</span>
                    </div>
                    <div class="table-responsive">
                        <table class="muaythai-schedule-table">
                            <thead>
                                <tr>
                                    <th>TIME</th>
                                    <th>MON</th>
                                    <th>TUE</th>
                                    <th>WED</th>
                                    <th>THU</th>
                                    <th>FRI</th>
                                    <th>SAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="time-cell">19.00</td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">BOXING</span>
                                        <span class="trainer-name">with ROFIQ</span>
                                    </td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">BOXING</span>
                                        <span class="trainer-name">with WINARDI</span>
                                    </td>
                                    <td class="class-cell">
                                        <span class="class-name">KICKBOXING</span>
                                        <span class="trainer-name">with WINARDI</span>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PEKUNDEN Table -->
                <div class="branch-schedule-wrapper mb-5">
                    <div class="d-flex flex-column align-items-start">
                        <h3 class="branch-title w-100 text-center">PEKUNDEN</h3>
                        <span class="branch-subtitle">• ADVANCE CLASS</span>
                    </div>
                    <div class="table-responsive">
                        <table class="muaythai-schedule-table">
                            <thead>
                                <tr>
                                    <th>TIME</th>
                                    <th>MON</th>
                                    <th>TUE</th>
                                    <th>WED</th>
                                    <th>THU</th>
                                    <th>FRI</th>
                                    <th>SAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="time-cell">19.00</td>
                                    <td class="class-cell">
                                        <span class="class-name">BOXING</span>
                                        <span class="trainer-name">with ROFIQ</span>
                                    </td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">MUAYTHAI</span>
                                        <span class="trainer-name">with DANI</span>
                                    </td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">BOXING</span>
                                        <span class="trainer-name">with ROFIQ</span>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- WR. SUPRATMAN Table -->
                <div class="branch-schedule-wrapper mb-4">
                    <div class="d-flex flex-column align-items-start">
                        <h3 class="branch-title w-100 text-center">WR. SUPRATMAN</h3>
                        <span class="branch-subtitle">• ADVANCE CLASS</span>
                    </div>
                    <div class="table-responsive">
                        <table class="muaythai-schedule-table">
                            <thead>
                                <tr>
                                    <th>TIME</th>
                                    <th>MON</th>
                                    <th>TUE</th>
                                    <th>WED</th>
                                    <th>THU</th>
                                    <th>FRI</th>
                                    <th>SAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="time-cell">10.00</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">MUAYTHAI</span>
                                        <span class="trainer-name">with VANPUT</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="time-cell">18.30</td>
                                    <td class="class-cell">
                                        <span class="class-name">BOXING</span>
                                        <span class="trainer-name">with WINARDI</span>
                                    </td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">BOXING</span>
                                        <span class="trainer-name">with WINARDI</span>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="time-cell">19.00</td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">KICKBOXING</span>
                                        <span class="trainer-name">with VANPUT</span>
                                    </td>
                                    <td></td>
                                    <td class="class-cell">
                                        <span class="class-name">BOXING</span>
                                        <span class="trainer-name">with ROFIQ</span>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Slider Column -->
            <div class="col-lg-5">
                <div id="muaythaiCarousel" class="carousel slide muaythai-slider-container" data-ride="carousel" data-interval="4000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url('img/slider4.webp') ?>" class="d-block w-100" alt="Muaythai 1">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('img/slider5.webp') ?>" class="d-block w-100" alt="Muaythai 2">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('img/slider6.webp') ?>" class="d-block w-100" alt="Muaythai 3">
                        </div>
                    </div>
                    <!-- Indicators -->
                    <ol class="carousel-indicators muaythai-slider-indicators">
                        <li data-target="#muaythaiCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#muaythaiCarousel" data-slide-to="1"></li>
                        <li data-target="#muaythaiCarousel" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Bottom Warning/Disclaimer Note -->
        <div class="row">
            <div class="col-12">
                <p class="muaythai-note">*Segala fasilitas permainan mohon dijaga agar tidak rusak/hilang, dan dikembalikan ke kasir setelah digunakan</p>
            </div>
        </div>
    </div>
</div>

<style>
.muaythai-schedule-section {
    background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)), url('<?= base_url("img/bg-jadwal-nolimit.webp") ?>');
    background-size: cover;
    background-position: center center;
    padding: 80px 0;
    color: #ffffff;
    font-family: 'Inter', 'Montserrat', sans-serif;
    position: relative;
    border-bottom: 2px solid #222;
}

.muaythai-schedule-section .branch-title {
    font-size: 24px;
    font-weight: 800;
    text-transform: uppercase;
    color: #ffffff;
    letter-spacing: 2px;
    margin-bottom: 2px;
    font-family: 'Inter', 'Montserrat', sans-serif;
}

.muaythai-schedule-section .branch-subtitle {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ff1414;
    letter-spacing: 1.5px;
    margin-bottom: 12px;
    font-family: 'Inter', 'Montserrat', sans-serif;
}

.muaythai-schedule-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 4px;
    margin-bottom: 0px;
}

.muaythai-schedule-table th {
    background-color: #a10f0f;
    color: #ffffff;
    font-size: 13px;
    font-weight: 800;
    text-transform: uppercase;
    text-align: center;
    padding: 10px 5px;
    border: none;
    letter-spacing: 0.5px;
}

.muaythai-schedule-table td {
    background-color: #121212;
    color: #ffffff;
    text-align: center;
    padding: 10px 5px;
    font-size: 11px;
    border: none;
    height: 52px;
    vertical-align: middle;
    transition: all 0.2s ease;
    position: relative;
}

.muaythai-schedule-table td.time-cell {
    background-color: #a10f0f;
    font-weight: 800;
    font-size: 12px;
    width: 10%;
}

.muaythai-schedule-table td.class-cell {
    font-weight: 800;
    line-height: 1.2;
}

.muaythai-schedule-table td.class-cell .class-name {
    display: block;
    color: #ffffff;
    font-size: 10px;
    text-transform: uppercase;
    font-weight: 800;
}

.muaythai-schedule-table td.class-cell .trainer-name {
    display: block;
    color: #888888;
    font-size: 8px;
    font-weight: 400;
    text-transform: none;
    margin-top: 2px;
}

.muaythai-schedule-table td:not(.time-cell):hover {
    background-color: #222222;
    transform: scale(1.04);
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    z-index: 2;
    cursor: default;
}

.muaythai-slider-container {
    position: relative;
    border: 1px solid #ffffff;
    width: 100%;
    margin-bottom: 0px;
    overflow: hidden;
}

.muaythai-slider-container img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}

#muaythaiCarousel .carousel-indicators {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    margin: 0;
    padding: 0;
    list-style: none;
    z-index: 6;
}

#muaythaiCarousel .carousel-indicators li {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.4);
    border: none;
    margin: 0 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

#muaythaiCarousel .carousel-indicators li.active {
    background-color: #ffffff;
    transform: scale(1.2);
}

.muaythai-note {
    width: 100%;
    text-align: center;
    background-color: #212121;
    color: #ffe2b6;
    font-size: 17px;
    font-style: italic;
    margin-top: 30px;
    letter-spacing: 0.5px;
    padding: 15px 20px;
    border-radius: 8px;
    border: 1px solid rgba(255, 226, 182, 0.15);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

@media (max-width: 991px) {
    .muaythai-slider-container {
        max-width: 500px;
        margin: 40px auto 0 auto;
    }
    .muaythai-schedule-table th {
        font-size: 11px;
        padding: 8px 3px;
    }
    .muaythai-schedule-table td {
        font-size: 9px;
        padding: 8px 3px;
        height: 48px;
    }
    .muaythai-schedule-table td.class-cell .class-name {
        font-size: 9px;
    }
    .muaythai-schedule-table td.class-cell .trainer-name {
        font-size: 7px;
    }
}
</style>

<?= $this->endSection(); ?>
