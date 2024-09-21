<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        ceklogin();
        cekadmin();
        $data['title'] = 'Dashboard';
        return view('backend/users/index', $data);
    }

    public function profile()
    {
        ceklogin();
        $data['title'] = 'Profile';
        $data['user'] = $this->UsersModel->get_users(['username' => session()->get('uname')]);
        return view('backend/users/profile', $data);
    }
    // update profile guest, user, admin
    public function update_profile()
    {
        ceklogin();

        // --- password ----
        if (!empty($this->request->getPost('password'))) {
            $passwd = $this->request->getPost('password');
            // $data['password'] = hash("sha512", $passwd);
            $data['password'] = password_hash($passwd, PASSWORD_DEFAULT);
        }

        // --- foto ---
        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama sampul random
            $namaSampul = $gambar->getRandomName();
            // pindahkan file ke img
            $gambar->move('assets/img/users', $namaSampul);

            $data['foto'] = $namaSampul;

            $foto_lm = $this->request->getPost('foto_lm');
            if ($foto_lm != "") {
                $files = 'assets/img/users/' . $foto_lm;
                if (file_exists($files))
                    unlink($files);
            }
        }

        $data['nm_lengkap'] = $this->request->getPost('nm_lengkap');
        $data['email'] = $this->request->getPost('email');
        $username = session()->get('uname');
        $session_id = session()->get('session_id');

        $update = $this->UsersModel->update_users_profile($data, $session_id, $username);

        if ($update) {
            $this->session->setFlashdata('success', 'Data berhasil diperbaharui');
        } else {
            $this->session->setFlashdata('error', 'Data gagal diperbaharui');
        }

        return redirect()->to(base_url('ladmin/profile'));
    }
}
