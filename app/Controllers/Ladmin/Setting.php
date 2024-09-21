<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;

use App\Models\SettingModel;

class Setting extends BaseController
{
    public function __construct()
    {
        $this->SettingModel = new SettingModel();
    }

    public function index()
    {
        ceklogin();
        cekadmin();
        $data['title'] = 'Setting';
        $data['setting'] = $this->SettingModel->get_setting();
        return view('backend/setting', $data);
    }

    public function update_setting()
    {
        ceklogin();
        cekadmin();
        $data['nm_website'] = $this->request->getPost('nm_website');
        $data['slogan'] = $this->request->getPost('slogan');
        $data['meta_deskripsi'] = $this->request->getPost('meta_deskripsi');
        $data['meta_keyword'] = $this->request->getPost('meta_keyword');
        $data['profil'] = $this->request->getPost('profil');
        $data['alamat'] = $this->request->getPost('alamat');
        $data['email'] = $this->request->getPost('email');
        $data['no_telp'] = $this->request->getPost('no_telp');
        $data['no_wa'] = $this->request->getPost('no_wa');
        $data['gmaps'] = $this->request->getPost('gmaps');
        $data['facebook'] = $this->request->getPost('facebook');
        $data['twitter'] = $this->request->getPost('twitter');
        $data['instagram'] = $this->request->getPost('instagram');
        $data['youtube'] = $this->request->getPost('youtube');
        $data['linkedin'] = $this->request->getPost('linkedin');
        $data['tiktok'] = $this->request->getPost('tiktok');
        $id = $this->request->getPost('id_setting');


        // --- logo ---
        $favicon = $this->request->getFile('favicon');
        $gambar = $this->request->getFile('logo');
        if ($favicon != '') {
            // generate nama sampul random
            $namaSampul_f = rand(10, 99) . '-' . str_replace(' ', '-', $favicon->getName());
            // pindahkan file ke img
            $favicon->move('assets/img', $namaSampul_f);

            $data['favicon'] = $namaSampul_f;

            // favicon lama
            $favicon_l = $this->request->getPost('favicon_l');
            if ($favicon_l != '') {
                $file_name = 'assets/img/' . $favicon_l;
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
            }
        }
        if ($gambar != '') {
            // generate nama sampul random
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/img', $namaSampul);

            $data['logo'] = $namaSampul;

            // gambar lama
            $logo_l = $this->request->getPost('logo_l');
            if ($logo_l != '') {
                $file_name = 'assets/img/' . $logo_l;
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
            }
        }

        $updateData = $this->SettingModel->update_setting($data, $id);

        if ($updateData) {
            session()->setFlashdata('success', 'Berhasil ubah data');
        } else {
            session()->setFlashdata('error', 'Gagal ubah data');
        }
        return redirect()->to(base_url('ladmin/setting'));
    }


    public function ajax_delete_gambar($id, $field)
    {
        $setting = $this->SettingModel->get_setting();
        if (!empty($setting->$field)) {
            $file = 'assets/img/' . $setting->$field;
            if (file_exists($file)) {
                unlink($file);
                $data[$field] = '';
                $this->SettingModel->update_setting($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
