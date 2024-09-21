<?php

namespace App\Controllers;

use App\Models\{BlogModel, HeroModel, HubungiModel, KlienModel, LayananModel, StatistikModel, TestimoniModel, TimModel};

class Home extends BaseController
{
    public function __construct()
    {
        $this->HeroModel = new HeroModel();
        $this->LayananModel = new LayananModel();
        $this->StatistikModel = new StatistikModel();
        $this->TimModel = new TimModel();
        $this->TestimoniModel = new TestimoniModel();
        $this->BlogModel = new BlogModel();
        $this->KlienModel = new KlienModel();
        $this->HubungiModel = new HubungiModel();
    }

    public function index()
    {
        $data['title'] = 'Home';
        if (templates() == 'Error') {
            echo 'Error Template gan. Silahkan hubungi Webmaster';
        } else {
            $data['hero'] = $this->HeroModel->get_hero(3, 'DESC');
            $data['layanan'] = $this->LayananModel->get_layanan(3, 'DESC');
            $data['statistik'] = $this->StatistikModel->get_statistik(4, 'DESC');
            $data['tim'] = $this->TimModel->get_tim(8, 'RANDOM');
            $data['testimoni'] = $this->TestimoniModel->get_testimoni(4, 'RANDOM');
            $data['blog'] = $this->BlogModel->get_blog(3, 'DESC');
            $data['klien'] = $this->KlienModel->get_klien(10, 'RANDOM');
            return view('frontend/' . templates()->folder . '/index', $data);
        }
    }

    public function kontak()
    {
        $data['title'] = 'Kontak Kami';
        return view('frontend/' . templates()->folder . '/kontak', $data);
    }

    public function kontak_save()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email',
            'no_wa' => 'required',
            'subjek' => 'required',
            'pesan' => 'required',
        ];

        $data['nama'] = $this->request->getPost('nama');
        $data['email'] = $this->request->getPost('email');
        $data['no_wa'] = $this->request->getPost('no_wa');
        $data['subjek'] = $this->request->getPost('subjek');
        $data['pesan'] = $this->request->getPost('pesan');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            $tambah = $this->HubungiModel->save_hubungi($data);
            if ($tambah) {
                session()->setFlashdata('success', 'Data berhasil disimpan. Kami akan segera membalas pesan Anda');
            } else {
                session()->setFlashdata('error', 'Data gagal disimpan');
            }
            return redirect()->to(base_url('kontak'));
        }
    }
}
