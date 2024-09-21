<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\LayananModel;

class Layanan extends BaseController
{
    public function __construct()
    {
        $this->LayananModel = new LayananModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Layanan';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/layanan/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/layanan" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_layanan') ? $this->request->getVar('page_layanan') : 1;
        $jPost = 10; // jumlah post per layanan

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['layanan'] = $this->LayananModel->like('nm_layanan', $keyword)->orlike('keterangan', $keyword)->orderBy('id_layanan', 'DESC')->paginate($jPost, 'layanan');
        } else {
            $data['layanan'] = $this->LayananModel->orderBy('id_layanan', 'DESC')->paginate($jPost, 'layanan');
        }
        $data['pager'] = $this->LayananModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/layanan/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Layanan Baru';
        return view('backend/layanan/layanan_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'nm_layanan' => 'required',
            'keterangan' => 'required',
            'icon' => 'uploaded[icon]|max_size[icon,512]'
        ];

        $data['nm_layanan'] = $this->request->getPost('nm_layanan');
        $data['keterangan'] = $this->request->getPost('keterangan');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- icon ---
            $gambar = $this->request->getFile('icon');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/layanan', $namaSampul);

                $data['icon'] = $namaSampul;
            }

            $tambahData = $this->LayananModel->save_layanan($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/layanan'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/layanan/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Layanan';
        $data['layanan'] = $this->LayananModel->get_layanan_by_id($id);
        return view('backend/layanan/layanan_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'nm_layanan' => 'required',
            'keterangan' => 'required',
            'icon' => 'max_size[icon,512]'
        ];

        $data['nm_layanan'] = $this->request->getPost('nm_layanan');
        $data['keterangan'] = $this->request->getPost('keterangan');
        $id = $this->request->getPost('id_layanan');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- icon ---
            $gambar = $this->request->getFile('icon');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/layanan', $namaSampul);

                $data['icon'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('icon_l');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/layanan/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->LayananModel->update_layanan($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/layanan'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/layanan/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $layanan = $this->LayananModel->get_layanan_by_id($id);
        if (!empty($layanan->id_layanan)) {
            if (!empty($layanan->icon)) {
                $file = 'assets/img/layanan/' . $layanan->icon;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->LayananModel->delete_layanan($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_icon($id)
    {
        $layanan = $this->LayananModel->get_layanan_by_id($id);
        if (!empty($layanan->icon)) {
            $file = 'assets/img/layanan/' . $layanan->icon;
            if (file_exists($file)) {
                unlink($file);
                $data['icon'] = '';
                $this->LayananModel->update_layanan($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
