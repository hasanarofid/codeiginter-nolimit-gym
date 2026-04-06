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
            $package .= '
            <!-- Yuhuu -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12"><h3 style="color:#ffffff !important;margin-bottom: 15px;">No Limits ' . ucfirst(strtolower($ct->kota)) . '</h3></div>
                    </div>
                    <div class="row">
            ';
            $cat = $this->modelpaket->get_cat_pkg($ct->kota);
            foreach ($cat as $row) {
                $package .= '
                    <div class="col-lg-4 col-md-6">
                            <div class="single_prising text-center">';
                $package .= '<div class="prising_header">
                                <h3>' . $row['catname'] . '</h3>
                            </div>';
                $pkg = $this->modelpaket->package_by_cat_kota($row['catid'], $ct->kota);
                foreach ($pkg as $p) {
                    $package .= '
                        <div class="pricing_body">
                            <span style="color:#fff !important;font-size:18px !important;">' . $p['nama'] . '</span>
                            <br/>
                            <span style="color:#fff !important;font-size:18px !important;">Rp. ' . number_format($p['nominal'], 0, '.', ',') . '</span>
                        </div>';
                }
                $package .= '<div class="pricing_btn">
                        <a href="' . base_url('/registration') . '" class="boxed-btn3">Join Now</a>
                    </div>';
                $package .= '</div></div>';
            }
            $package .= '</div>';

            // $x++;
        }
        $package .= '</div>';


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
}
