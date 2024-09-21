<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;

use App\Models\UsersModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Dashboard';
        return view('backend/index', $data);
    }

    // Upload Gambar Summernote
    function upload_image()
    {
        $gambar = $this->request->getFile('img');
        $dir = $this->request->getPost('dir');

        if ($gambar->getError() == 4) {
            echo '';
        } else {
            // generate nama sampul random
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            if ($dir == '') {
                $gambar->move('assets/img', $namaSampul);
                echo base_url() . 'assets/img/' . $namaSampul;
            } else {
                $gambar->move('assets/img/' . $dir, $namaSampul);
                echo base_url() . 'assets/img/' . $dir . '/' . $namaSampul;
            }
        }
    }

    //Delete image summernote
    function delete_image()
    {
        $src = $this->request->getPost('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }
}
