<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\KlienModel;

class Klien extends BaseController
{
    public function __construct()
    {
        $this->KlienModel = new KlienModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Data Klien';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/klien/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/klien" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_klien') ? $this->request->getVar('page_klien') : 1;
        $jPost = 10; // jumlah post per klien

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['klien'] = $this->KlienModel->like('nm_klien', $keyword)->orlike('pekerjaan', $keyword)->orderBy('id_klien', 'DESC')->paginate($jPost, 'klien');
        } else {
            $data['klien'] = $this->KlienModel->orderBy('id_klien', 'DESC')->paginate($jPost, 'klien');
        }
        $data['pager'] = $this->KlienModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/klien/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Klien';
        return view('backend/klien/klien_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'nm_klien' => 'required',
            'pekerjaan' => 'required',
        ];

        $data['nm_klien'] = $this->request->getPost('nm_klien');
        $data['pekerjaan'] = $this->request->getPost('pekerjaan');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- logo ---
            $avatar = $this->request->getFile('avatar');
            $gambar = $this->request->getFile('logo');
            if ($avatar != '') {
                // generate nama sampul random
                $namaSampul = $avatar->getRandomName();
                // pindahkan file ke img
                $avatar->move('assets/img/klien', $namaSampul);

                $data['avatar'] = $namaSampul;
            }
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/klien', $namaSampul);

                $data['logo'] = $namaSampul;
            }

            $tambahData = $this->KlienModel->save_klien($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/klien'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/klien/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Klien';
        $data['klien'] = $this->KlienModel->get_klien_by_id($id);
        return view('backend/klien/klien_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'nm_klien' => 'required',
            'pekerjaan' => 'required'
        ];

        $data['nm_klien'] = $this->request->getPost('nm_klien');
        $data['pekerjaan'] = $this->request->getPost('pekerjaan');
        $id = $this->request->getPost('id_klien');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- foto ---

            $avatar = $this->request->getFile('avatar');
            $gambar = $this->request->getFile('logo');
            if ($avatar != '') {
                // generate nama sampul random
                $namaSampul = $avatar->getRandomName();
                // pindahkan file ke img
                $avatar->move('assets/img/klien', $namaSampul);

                $data['avatar'] = $namaSampul;

                // gambar lama
                $avatar_l = $this->request->getPost('avatar_l');
                if ($avatar_l != '') {
                    $file_name = 'assets/img/klien/' . $avatar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/klien', $namaSampul);

                $data['logo'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('logo_l');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/klien/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $gambar = $this->request->getFile('foto');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/klien', $namaSampul);

                $data['banner'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('banner');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/klien/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->KlienModel->update_klien($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/klien'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/klien/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $klien = $this->KlienModel->get_klien_by_id($id);
        if (!empty($klien->id_klien)) {
            if (!empty($klien->avatar)) {
                $file = 'assets/img/klien/' . $klien->avatar;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            if (!empty($klien->logo)) {
                $file = 'assets/img/klien/' . $klien->logo;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->KlienModel->delete_klien($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_gambar($id, $field)
    {
        $klien = $this->KlienModel->get_klien_by_id($id);
        if (!empty($klien->$field)) {
            $file = 'assets/img/klien/' . $klien->$field;
            if (file_exists($file)) {
                unlink($file);
                $data[$field] = '';
                $this->KlienModel->update_klien($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
