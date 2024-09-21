<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\HubungiModel;

class Hubungi extends BaseController
{
    public function __construct()
    {
        $this->HubungiModel = new HubungiModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Pesan Masuk';

        $currentPage = $this->request->getVar('page_hubungi') ? $this->request->getVar('page_hubungi') : 1;
        $jPost = 10; // jumlah post per hubungi

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['hubungi'] = $this->HubungiModel->like('nama', $keyword)->orlike('email', $keyword)->orlike('no_wa', $keyword)->orlike('subjek', $keyword)->orlike('pesan', $keyword)->orderBy('id_hubungi', 'DESC')->paginate($jPost, 'hubungi');
        } else {
            $data['hubungi'] = $this->HubungiModel->orderBy('id_hubungi', 'DESC')->paginate($jPost, 'hubungi');
        }
        $data['pager'] = $this->HubungiModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/hubungi', $data);
    }

    public function ajax_delete($id)
    {
        $delete = $this->HubungiModel->delete_hubungi($id);
        if ($delete) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }
}
