<?php

namespace App\Controllers;

use App\Models\{AboutModel, KlienModel, TimModel};

class About extends BaseController
{
    public function __construct()
    {
        $this->AboutModel = new AboutModel();
        $this->KlienModel = new KlienModel();
        $this->TimModel = new TimModel();
    }

    public function index()
    {
        $data['title'] = 'About Us';
        if (templates() == 'Error') {
            echo 'Error Template gan. Silahkan hubungi Webmaster';
        } else {
            $data['about'] = $this->AboutModel->get_about();
            $data['tim'] = $this->TimModel->get_tim(NULL, 'RANDOM');
            $data['klien'] = $this->KlienModel->get_klien(NULL, 'RANDOM');
            return view('frontend/' . templates()->folder . '/about', $data);
        }
    }
}
