<?php

namespace App\Controllers;

use App\Models\{KlienModel, LayananModel};

class Layanan extends BaseController
{
    public function __construct()
    {
        $this->LayananModel = new LayananModel();
        $this->KlienModel = new KlienModel();
    }

    public function index()
    {
        $data['title'] = 'Layanan Kami';
        if (templates() == 'Error') {
            echo 'Error Template gan. Silahkan hubungi Webmaster';
        } else {
            $data['layanan'] = $this->LayananModel->get_layanan();
            $data['klien'] = $this->KlienModel->get_klien(NULL, 'RANDOM');
            return view('frontend/' . templates()->folder . '/layanan/index', $data);
        }
    }

    public function detail($slug)
    {
        $data['layanan'] = $this->LayananModel->get_layanan_where(['slug_layanan' => $slug]);
        if (!empty($data['layanan'])) {
            $data['title'] = $data['layanan'][0]->nm_layanan;
            $data['layanan_lain'] = $this->LayananModel->get_layanan_where(['slug_layanan <>' => $slug], 3);
        } else {
            $data['title'] = '';
        }
        return view('frontend/' . templates()->folder . '/layanan/detail', $data);
    }
}
