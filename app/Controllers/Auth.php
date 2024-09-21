<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        if (session()->has('masukMember')) {
            return redirect()->to(base_url() . 'ladmin/dashboard');
        }
        return view('auth/login');
    }

    public function login_do()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data['username'] = $username;
        $data['blokir'] = 'N';
        $hasil = $this->UsersModel->get_users($data);

        if (count($hasil) > 0) {
            foreach ($hasil as $h);

            if (password_verify($password, $h->password)) {
                $sess_data = array(
                    'masukMember' => TRUE,
                    'uname' => $h->username,
                    'nama_lengkap' => $h->nm_lengkap,
                    'foto' => $h->foto,
                    'level' => $h->level,
                    'session_id' => $h->session_id,
                );
                $this->session->set($sess_data);

                return redirect()->to(base_url('ladmin/dashboard'));

                exit();
            } else {
                $this->session->setFlashdata('error', 'Password Salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            $this->session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout_do()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}
