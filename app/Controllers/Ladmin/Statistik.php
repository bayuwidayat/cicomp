<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\StatistikModel;

class Statistik extends BaseController
{
    public function __construct()
    {
        $this->StatistikModel = new StatistikModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Statistik';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/statistik/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/statistik" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_statistik') ? $this->request->getVar('page_statistik') : 1;
        $jPost = 10; // jumlah post per statistik

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['statistik'] = $this->StatistikModel->like('nm_statistik', $keyword)->orlike('goal', $keyword)->orderBy('id_statistik', 'DESC')->paginate($jPost, 'statistik');
        } else {
            $data['statistik'] = $this->StatistikModel->orderBy('id_statistik', 'DESC')->paginate($jPost, 'statistik');
        }
        $data['pager'] = $this->StatistikModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/statistik/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Statistik Baru';
        return view('backend/statistik/statistik_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'nm_statistik' => 'required',
            'goal' => 'required',
            'icon' => 'uploaded[icon]|max_size[icon,512]'
        ];

        $data['nm_statistik'] = $this->request->getPost('nm_statistik');
        $data['goal'] = $this->request->getPost('goal');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- icon ---
            $gambar = $this->request->getFile('icon');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/statistik', $namaSampul);

                $data['icon'] = $namaSampul;
            }

            $tambahData = $this->StatistikModel->save_statistik($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/statistik'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/statistik/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Statistik';
        $data['statistik'] = $this->StatistikModel->get_statistik_by_id($id);
        return view('backend/statistik/statistik_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'nm_statistik' => 'required',
            'goal' => 'required',
            'icon' => 'max_size[icon,512]'
        ];

        $data['nm_statistik'] = $this->request->getPost('nm_statistik');
        $data['goal'] = $this->request->getPost('goal');
        $id = $this->request->getPost('id_statistik');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- icon ---
            $gambar = $this->request->getFile('icon');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/statistik', $namaSampul);

                $data['icon'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('icon_l');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/statistik/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->StatistikModel->update_statistik($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/statistik'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/statistik/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $statistik = $this->StatistikModel->get_statistik_by_id($id);
        if (!empty($statistik->id_statistik)) {
            if (!empty($statistik->icon)) {
                $file = 'assets/img/statistik/' . $statistik->icon;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->StatistikModel->delete_statistik($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_icon($id)
    {
        $statistik = $this->StatistikModel->get_statistik_by_id($id);
        if (!empty($statistik->icon)) {
            $file = 'assets/img/statistik/' . $statistik->icon;
            if (file_exists($file)) {
                unlink($file);
                $data['icon'] = '';
                $this->StatistikModel->update_statistik($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
