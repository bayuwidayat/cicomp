<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\TimModel;

class Tim extends BaseController
{
    public function __construct()
    {
        $this->TimModel = new TimModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Tim';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/tim/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/tim" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_tim') ? $this->request->getVar('page_tim') : 1;
        $jPost = 10; // jumlah post per tim

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['tim'] = $this->TimModel->like('nm_tim', $keyword)->orlike('posisi', $keyword)->orderBy('id_tim', 'DESC')->paginate($jPost, 'tim');
        } else {
            $data['tim'] = $this->TimModel->orderBy('id_tim', 'DESC')->paginate($jPost, 'tim');
        }
        $data['pager'] = $this->TimModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/tim/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Tim Baru';
        return view('backend/tim/tim_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'nm_tim' => 'required',
            'jabatan' => 'required',
            'lokasi' => 'required',
            'avatar' => 'uploaded[avatar]|max_size[avatar,512]'
        ];

        $data['nm_tim'] = $this->request->getPost('nm_tim');
        $data['jabatan'] = $this->request->getPost('jabatan');
        $data['lokasi'] = $this->request->getPost('lokasi');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- avatar ---
            $gambar = $this->request->getFile('avatar');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/tim', $namaSampul);

                $data['avatar'] = $namaSampul;
            }

            $tambahData = $this->TimModel->save_tim($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/tim'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/tim/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Tim';
        $data['tim'] = $this->TimModel->get_tim_by_id($id);
        return view('backend/tim/tim_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'nm_tim' => 'required',
            'jabatan' => 'required',
            'lokasi' => 'required',
            'avatar' => 'max_size[avatar,512]'
        ];

        $data['nm_tim'] = $this->request->getPost('nm_tim');
        $data['jabatan'] = $this->request->getPost('jabatan');
        $data['lokasi'] = $this->request->getPost('lokasi');
        $id = $this->request->getPost('id_tim');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- avatar ---
            $gambar = $this->request->getFile('avatar');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/tim', $namaSampul);

                $data['avatar'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('avatar_l');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/tim/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->TimModel->update_tim($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/tim'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/tim/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $tim = $this->TimModel->get_tim_by_id($id);
        if (!empty($tim->id_tim)) {
            if (!empty($tim->avatar)) {
                $file = 'assets/img/tim/' . $tim->avatar;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->TimModel->delete_tim($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_avatar($id)
    {
        $tim = $this->TimModel->get_tim_by_id($id);
        if (!empty($tim->avatar)) {
            $file = 'assets/img/tim/' . $tim->avatar;
            if (file_exists($file)) {
                unlink($file);
                $data['avatar'] = '';
                $this->TimModel->update_tim($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
