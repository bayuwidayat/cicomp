<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\AboutModel;

class About extends BaseController
{
    public function __construct()
    {
        $this->AboutModel = new AboutModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'About';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/about/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/about" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_about') ? $this->request->getVar('page_about') : 1;
        $jPost = 10; // jumlah post per about

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['about'] = $this->AboutModel->like('nm_about', $keyword)->orlike('keterangan', $keyword)->orlike('tipe', $keyword)->orderBy('id_about', 'DESC')->paginate($jPost, 'about');
        } else {
            $data['about'] = $this->AboutModel->orderBy('id_about', 'DESC')->paginate($jPost, 'about');
        }
        $data['pager'] = $this->AboutModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/about/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah About Baru';
        return view('backend/about/about_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'nm_about' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
            'thumbnail' => 'uploaded[thumbnail]|max_size[thumbnail,512]'
        ];

        $data['nm_about'] = $this->request->getPost('nm_about');
        $data['tipe'] = $this->request->getPost('tipe');
        $data['keterangan'] = $this->request->getPost('keterangan');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- thumbnail ---
            $gambar = $this->request->getFile('thumbnail');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/about', $namaSampul);

                $data['thumbnail'] = $namaSampul;
            }

            $tambahData = $this->AboutModel->save_about($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/about'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/about/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit About';
        $data['about'] = $this->AboutModel->get_about_by_id($id);
        return view('backend/about/about_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'nm_about' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
            'thumbnail' => 'max_size[thumbnail,512]'
        ];

        $data['nm_about'] = $this->request->getPost('nm_about');
        $data['tipe'] = $this->request->getPost('tipe');
        $data['keterangan'] = $this->request->getPost('keterangan');
        $id = $this->request->getPost('id_about');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- thumbnail ---
            $gambar = $this->request->getFile('thumbnail');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/about', $namaSampul);

                $data['thumbnail'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('thumbnail_l');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/about/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->AboutModel->update_about($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/about'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/about/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $about = $this->AboutModel->get_about_by_id($id);
        if (!empty($about->id_about)) {
            if (!empty($about->thumbnail)) {
                $file = 'assets/img/about/' . $about->thumbnail;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->AboutModel->delete_about($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_thumbnail($id)
    {
        $about = $this->AboutModel->get_about_by_id($id);
        if (!empty($about->thumbnail)) {
            $file = 'assets/img/about/' . $about->thumbnail;
            if (file_exists($file)) {
                unlink($file);
                $data['thumbnail'] = '';
                $this->AboutModel->update_about($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
