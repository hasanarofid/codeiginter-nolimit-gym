<?php

namespace App\Controllers;

class Themes extends BaseController
{

    public function tema_satu()
    {
        return view('tema/tema-satu');
    }
    public function tema_dua()
    {
        return view('tema/tema-dua');
    }
    public function tema_tiga()
    {
        return view('tema/tema-tiga');
    }
    public function tema_empat()
    {
        return view('tema/tema-empat');
    }
}
