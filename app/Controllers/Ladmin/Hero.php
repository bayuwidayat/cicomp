<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\HeroModel;

class Hero extends BaseController
{
    public function __construct()
    {
        $this->HeroModel = new HeroModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Hero Section';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/hero/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/hero" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_hero') ? $this->request->getVar('page_hero') : 1;
        $jPost = 10; // jumlah post per hero

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['hero'] = $this->HeroModel->like('judul', $keyword)->orlike('sub_judul', $keyword)->orlike('keterangan', $keyword)->orderBy('id_hero', 'DESC')->paginate($jPost, 'hero');
        } else {
            $data['hero'] = $this->HeroModel->orderBy('id_hero', 'DESC')->paginate($jPost, 'hero');
        }
        $data['pager'] = $this->HeroModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/hero/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Hero';
        return view('backend/hero/hero_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'judul' => 'required',
            'keterangan' => 'required'
        ];

        $data['judul'] = $this->request->getPost('judul');
        $data['sub_judul'] = $this->request->getPost('sub_judul');
        $data['keterangan'] = $this->request->getPost('keterangan');
        $data['video'] = $this->request->getPost('video');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- foto ---
            $gambar = $this->request->getFile('foto');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/hero', $namaSampul);

                $data['banner'] = $namaSampul;
            }

            $tambahData = $this->HeroModel->save_hero($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/hero'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/hero/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Hero';
        $data['hero'] = $this->HeroModel->get_hero_by_id($id);
        return view('backend/hero/hero_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'judul' => 'required',
            'keterangan' => 'required'
        ];

        $data['judul'] = $this->request->getPost('judul');
        $data['sub_judul'] = $this->request->getPost('sub_judul');
        $data['keterangan'] = $this->request->getPost('keterangan');
        $data['video'] = $this->request->getPost('video');
        $id = $this->request->getPost('id_hero');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- foto ---
            $gambar = $this->request->getFile('foto');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/hero', $namaSampul);

                $data['banner'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('banner');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/hero/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->HeroModel->update_hero($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/hero'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/hero/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $hero = $this->HeroModel->get_hero_by_id($id);
        if (!empty($hero->id_hero)) {
            if (!empty($hero->banner)) {
                $file = 'assets/img/hero/' . $hero->banner;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->HeroModel->delete_hero($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_banner($id)
    {
        $hero = $this->HeroModel->get_hero_by_id($id);
        if (!empty($hero->banner)) {
            $file = 'assets/img/hero/' . $hero->banner;
            if (file_exists($file)) {
                unlink($file);
                $data['banner'] = '';
                $this->HeroModel->update_hero($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
