<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\KlienModel;
use App\Models\TestimoniModel;

class Testimoni extends BaseController
{
    public function __construct()
    {
        $this->TestimoniModel = new TestimoniModel();
        $this->KlienModel = new KlienModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Testimoni';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/testimoni/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/testimoni" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_testimoni') ? $this->request->getVar('page_testimoni') : 1;
        $jPost = 10; // jumlah post per testimoni

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['testimoni'] = $this->TestimoniModel->join('klien', 'klien.id_klien=testimoni.klien_id')->like('klien.nm_klien', $keyword)->orlike('testimoni.pesan', $keyword)->orderBy('id_testimoni', 'DESC')->paginate($jPost, 'testimoni');
        } else {
            $data['testimoni'] = $this->TestimoniModel->join('klien', 'klien.id_klien=testimoni.klien_id')->orderBy('id_testimoni', 'DESC')->paginate($jPost, 'testimoni');
        }
        $data['pager'] = $this->TestimoniModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/testimoni/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Testimoni Baru';
        $data['get_all_combobox_klien'] = $this->KlienModel->get_all_combobox_klien();
        return view('backend/testimoni/testimoni_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'pesan' => 'required'
        ];

        $data['klien_id'] = $this->request->getPost('klien');
        $data['pesan'] = $this->request->getPost('pesan');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- foto ---
            $gambar = $this->request->getFile('foto');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/testimoni', $namaSampul);

                $data['thumbnail'] = $namaSampul;
            }

            $tambahData = $this->TestimoniModel->save_testimoni($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/testimoni'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/testimoni/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Testimoni';
        $data['testimoni'] = $this->TestimoniModel->get_testimoni_by_id($id);
        $data['get_all_combobox_klien'] = $this->KlienModel->get_all_combobox_klien();
        return view('backend/testimoni/testimoni_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'pesan' => 'required'
        ];

        $data['klien_id'] = $this->request->getPost('klien');
        $data['pesan'] = $this->request->getPost('pesan');
        $id = $this->request->getPost('id_testimoni');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- foto ---
            $gambar = $this->request->getFile('foto');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/testimoni', $namaSampul);

                $data['thumbnail'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('thumbnail_l');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/testimoni/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->TestimoniModel->update_testimoni($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/testimoni'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/testimoni/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $testimoni = $this->TestimoniModel->get_testimoni_by_id($id);
        if (!empty($testimoni->id_testimoni)) {
            if (!empty($testimoni->thumbnail)) {
                $file = 'assets/img/testimoni/' . $testimoni->thumbnail;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->TestimoniModel->delete_testimoni($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_thumbnail($id)
    {
        $testimoni = $this->TestimoniModel->get_testimoni_by_id($id);
        if (!empty($testimoni->thumbnail)) {
            $file = 'assets/img/testimoni/' . $testimoni->thumbnail;
            if (file_exists($file)) {
                unlink($file);
                $data['thumbnail'] = '';
                $this->TestimoniModel->update_testimoni($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
