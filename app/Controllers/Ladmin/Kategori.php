<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Kategori';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/kategori/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/kategori" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1;
        $jPost = 10; // jumlah post per kategori

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['kategori'] = $this->KategoriModel->like('nm_kategori', $keyword)->orderBy('id_kategori', 'DESC')->paginate($jPost, 'kategori');
        } else {
            $data['kategori'] = $this->KategoriModel->orderBy('id_kategori', 'DESC')->paginate($jPost, 'kategori');
        }
        $data['pager'] = $this->KategoriModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/kategori/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Kategori Baru';
        return view('backend/kategori/kategori_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'nm_kategori' => 'required',
        ];

        $data['nm_kategori'] = $this->request->getPost('nm_kategori');
        $data['slug_kategori'] = url_title($this->request->getPost('nm_kategori'), '-', true);

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            $tambahData = $this->KategoriModel->save_kategori($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/kategori'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/kategori/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Kategori';
        $data['kategori'] = $this->KategoriModel->get_kategori_by_id($id);
        return view('backend/kategori/kategori_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'nm_kategori' => 'required',
        ];

        $data['nm_kategori'] = $this->request->getPost('nm_kategori');
        $data['slug_kategori'] = url_title($this->request->getPost('nm_kategori'), '-', true);
        $id = $this->request->getPost('id_kategori');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            $ubahData = $this->KategoriModel->update_kategori($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/kategori'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/kategori/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $delete = $this->KategoriModel->delete_kategori($id);
        if ($delete) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }
}
