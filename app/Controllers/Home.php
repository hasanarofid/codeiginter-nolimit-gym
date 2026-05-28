<?php

namespace App\Controllers;

use App\Models\Model_cabang;
use App\Models\ModelKelas;
use App\Models\ModelKlsBoxing;
use App\Models\ModelMembership;
use App\Models\ModelMemCat;
use App\Models\ModelTrainer;

class Home extends BaseController
{
    protected $modelpaket, $modeltrainer, $modelcabang;
    protected $modelkelas, $modelmemcat, $modelboxing;

    public function __construct()
    {
        $this->modelpaket = new ModelMembership();
        $this->modeltrainer = new ModelTrainer();
        $this->modelcabang = new Model_cabang();
        $this->modelkelas = new ModelKelas();
        $this->modelmemcat = new ModelMemCat();
        $this->modelboxing = new ModelKlsBoxing();
    }

    public function index(): string
    {
        $cities = $this->modelcabang->get_kota();
        $jmlkota = count($cities);

        $package = '';
        foreach ($cities as $ct) {
            $pkgs = $this->modelpaket->where('kota', $ct->kota)->orderBy('nominal', 'ASC')->findAll();
            
            if(count($pkgs) == 0) continue;

            $package .= '
            <div class="row mb-5 justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="membership-box text-center">
                        <div class="membership-box-content">
                            <div class="d-flex flex-column align-items-center mb-4">
                                <table class="table table-borderless text-white mb-0" style="width: auto; font-weight: 700; font-size: 1.15rem; text-align: left; letter-spacing: 0.5px;">
                                    <tbody>
            ';
            
            foreach ($pkgs as $p) {
                $nom = $p['nominal'];
                if ($nom % 1000000 == 0) {
                    $nom_str = number_format($nom / 1000, 0, ',', '.') . 'K';
                } else {
                    $nom_str = number_format($nom / 1000, 0, ',', '.') . 'K';
                }
                
                $package .= '
                                        <tr>
                                            <td style="padding: 6px 30px; text-transform: uppercase;">' . $p['nama'] . '</td>
                                            <td style="padding: 6px 30px; text-align: right;">' . $nom_str . '</td>
                                        </tr>
                ';
            }
            
            $package .= '
                                    </tbody>
                                </table>
                            </div>
                            
                            <div style="font-size: 0.95rem; font-weight: 600; margin-bottom: 35px; line-height: 1.6; letter-spacing: 0.5px;">
                                <p style="margin-bottom: 5px; color: #FFF; text-transform: uppercase;">“ALL MEMBERSHIP PACKAGE INCLUDES GYM AND FIGHT CLASSES”</p>
                                <p style="margin-bottom: 20px; color: #AAA;">(GYM, KICKBOXING, BOXING, MUAYTHAI)</p>
                                <p style="margin-bottom: 5px; color: #FFF; text-transform: uppercase; font-weight: 700;">FACILITY</p>
                                <p style="margin-bottom: 0; color: #AAA;">(TOWEL, LOCKER, SHOWER, WATER STATION)</p>
                            </div>
                            
                            <a href="' . base_url('/registration') . '" class="boxed-btn3 membership-join-btn">
                                JOIN NOW
                            </a>
                            
                            <div style="margin-top: 15px;">
                                <a href="https://wa.me/6281802490343" target="_blank" class="membership-wa-link">
                                    <i class="fa fa-whatsapp"></i> 0818-0249-0343
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }


        $data = [
            'title' => '| Home',
            'packages' => $package,
            'trainers' => $this->modeltrainer->get_jenis('personal trainer'),
            'coaches' => $this->modeltrainer->get_jenis('coach boxing / muaithai'),
            'cabangs' => $this->modelcabang->get_cabang('%'),
            'cabang_footer' => $this->mcabangku->findAll(),
            'classes' => $this->modelkelas,
            'bothai'  => $this->modelboxing,
        ];

        return view('home_section', $data);
    }

    public function maintenance()
    {
        return view('maintenance');
    }
}
