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
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="membership-box text-center">
                        <div class="membership-box-content">
                            <div class="d-flex flex-column align-items-center mb-3">
                                <table class="table table-borderless text-white mb-0 membership-table" style="width: 100%; max-width: 320px; font-weight: 700; font-size: 1.05rem; letter-spacing: 0.5px;">
                                    <tbody>
            ';
            
            foreach ($pkgs as $p) {
                $nom = $p['nominal'];
                $nom_str = number_format($nom / 1000, 0, ',', '.') . 'K';
                
                $package .= '
                                        <tr>
                                            <td class="text-left" style="padding: 6px 10px; text-transform: uppercase; font-family: \'Inter\', \'Montserrat\', sans-serif;">' . $p['nama'] . '</td>
                                            <td class="text-right" style="padding: 6px 10px; text-align: right; font-family: \'Inter\', \'Montserrat\', sans-serif;">' . $nom_str . '</td>
                                        </tr>
                ';
            }
            
            $package .= '
                                    </tbody>
                                </table>
                            </div>
                            
                            <div style="font-size: 0.85rem; font-weight: 600; margin-bottom: 25px; line-height: 1.5; letter-spacing: 0.3px; color: #CCCCCC;">
                                <p style="margin-bottom: 4px; color: #FFFFFF; text-transform: uppercase;">“ALL MEMBERSHIP PACKAGE INCLUDES GYM AND FIGHT CLASSES”</p>
                                <p style="margin-bottom: 16px; color: #999999; font-size: 0.8rem;">(GYM, KICKBOXING, BOXING, MUAYTHAI)</p>
                                <p style="margin-bottom: 4px; color: #FFFFFF; text-transform: uppercase; font-weight: 700;">FACILITY</p>
                                <p style="margin-bottom: 0; color: #999999; font-size: 0.8rem;">(TOWEL, LOCKER, SHOWER, WATER STATION)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3 mb-2">
                        <a href="' . base_url('/registration') . '" class="boxed-btn3 membership-join-btn">
                            JOIN NOW
                        </a>
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

    public function about()
    {
        $data = [
            'title' => '| About Us',
            'cabangs' => $this->modelcabang->get_cabang('%'),
            'cabang_footer' => $this->mcabangku->findAll(),
        ];
        return view('about_section', $data);
    }

    public function classes()
    {
        $data = [
            'title' => '| Classes',
            'cabangs' => $this->modelcabang->get_cabang('%'),
            'cabang_footer' => $this->mcabangku->findAll(),
            'classes' => $this->modelkelas,
            'bothai'  => $this->modelboxing,
        ];
        return view('classes_section', $data);
    }

    public function pricing()
    {
        $cities = $this->modelcabang->get_kota();

        $package = '';
        foreach ($cities as $ct) {
            $pkgs = $this->modelpaket->where('kota', $ct->kota)->orderBy('nominal', 'ASC')->findAll();
            
            if(count($pkgs) == 0) continue;

            $package .= '
            <div class="row mb-5 justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="membership-box text-center">
                        <div class="membership-box-content">
                            <div class="d-flex flex-column align-items-center mb-3">
                                <table class="table table-borderless text-white mb-0 membership-table" style="width: 100%; max-width: 320px; font-weight: 700; font-size: 1.05rem; letter-spacing: 0.5px;">
                                    <tbody>
            ';
            
            foreach ($pkgs as $p) {
                $nom = $p['nominal'];
                $nom_str = number_format($nom / 1000, 0, ',', '.') . 'K';
                
                $package .= '
                                        <tr>
                                            <td class="text-left" style="padding: 6px 10px; text-transform: uppercase; font-family: \'Inter\', \'Montserrat\', sans-serif;">' . $p['nama'] . '</td>
                                            <td class="text-right" style="padding: 6px 10px; text-align: right; font-family: \'Inter\', \'Montserrat\', sans-serif;">' . $nom_str . '</td>
                                        </tr>
                ';
            }
            
            $package .= '
                                    </tbody>
                                </table>
                            </div>
                            
                            <div style="font-size: 0.85rem; font-weight: 600; margin-bottom: 25px; line-height: 1.5; letter-spacing: 0.3px; color: #CCCCCC;">
                                <p style="margin-bottom: 4px; color: #FFFFFF; text-transform: uppercase;">“ALL MEMBERSHIP PACKAGE INCLUDES GYM AND FIGHT CLASSES”</p>
                                <p style="margin-bottom: 16px; color: #999999; font-size: 0.8rem;">(GYM, KICKBOXING, BOXING, MUAYTHAI)</p>
                                <p style="margin-bottom: 4px; color: #FFFFFF; text-transform: uppercase; font-weight: 700;">FACILITY</p>
                                <p style="margin-bottom: 0; color: #999999; font-size: 0.8rem;">(TOWEL, LOCKER, SHOWER, WATER STATION)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3 mb-2">
                        <a href="' . base_url('/registration') . '" class="boxed-btn3 membership-join-btn">
                            JOIN NOW
                        </a>
                    </div>
                </div>
            </div>
            ';
        }

        $data = [
            'title' => '| Membership',
            'packages' => $package,
            'cabangs' => $this->modelcabang->get_cabang('%'),
            'cabang_footer' => $this->mcabangku->findAll(),
        ];
        return view('membership_section', $data);
    }

    public function maintenance()
    {
        $data = [
            'title' => '| Maintenance',
            'cabangs' => $this->modelcabang->get_cabang('%'),
            'cabang_footer' => $this->mcabangku->findAll(),
        ];
        return view('maintenance', $data);
    }
}
