<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\BlogModel;
use App\Models\KategoriModel;

class Blog extends BaseController
{
    public function __construct()
    {
        $this->BlogModel = new BlogModel();
        $this->KategoriModel = new KategoriModel();
    }

    public function index()
    {
        ceklogin();
        $data['title'] = 'Blog';
        $data['btn'] = '<a href="' . base_url() . 'ladmin/blog/tambah" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a> <a href="' . base_url() . 'ladmin/blog" class="btn btn-sm btn-warning"><i class="ri-loop-right-line"></i> Reload</a>';

        $currentPage = $this->request->getVar('page_blog') ? $this->request->getVar('page_blog') : 1;
        $jPost = 10; // jumlah post per blog

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data['blog'] = $this->BlogModel->select('blog.*,kategori.nm_kategori')->join('kategori', 'kategori.id_kategori=blog.kategori_id')->like('judul', $keyword)->orlike('isi_blog', $keyword)->orderBy('id_blog', 'DESC')->paginate($jPost, 'blog');
        } else {
            $data['blog'] = $this->BlogModel->select('blog.*,kategori.nm_kategori')->join('kategori', 'kategori.id_kategori=blog.kategori_id')->orderBy('id_blog', 'DESC')->paginate($jPost, 'blog');
        }
        $data['pager'] = $this->BlogModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/blog/index', $data);
    }

    public function tambah()
    {
        ceklogin();
        $data['title'] = 'Tambah Blog Baru';
        $data['get_all_combobox_kategori'] = $this->KategoriModel->get_all_combobox_kategori();
        return view('backend/blog/blog_tambah', $data);
    }

    public function simpan()
    {
        ceklogin();

        $rules = [
            'judul' => 'required',
            'isi_blog' => 'required',
            'banner' => 'uploaded[banner]|max_size[banner,512]'
        ];

        $data['judul'] = $this->request->getPost('judul');
        $data['slug_blog'] = url_title($this->request->getPost('judul'), '-', true);
        $data['kategori_id'] = $this->request->getPost('kategori');
        $data['isi_blog'] = $this->request->getPost('isi_blog');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- banner ---
            $gambar = $this->request->getFile('banner');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/blog', $namaSampul);

                $data['banner'] = $namaSampul;
            }

            $tambahData = $this->BlogModel->save_blog($data);

            if ($tambahData) {
                session()->setFlashdata('success', 'Berhasil simpan data');
                return redirect()->to(base_url('ladmin/blog'));
            } else {
                session()->setFlashdata('error', 'Gagal simpan data');
                return redirect()->to(base_url('ladmin/blog/tambah'));
            }
        }
    }

    public function edit($id)
    {
        ceklogin();
        $data['title'] = 'Edit Blog';
        $data['blog'] = $this->BlogModel->get_blog_by_id($id);
        $data['get_all_combobox_kategori'] = $this->KategoriModel->get_all_combobox_kategori();
        return view('backend/blog/blog_edit', $data);
    }

    public function update()
    {
        ceklogin();

        $rules = [
            'judul' => 'required',
            'isi_blog' => 'required',
            'banner' => 'max_size[banner,512]'
        ];

        $data['judul'] = $this->request->getPost('judul');
        $data['slug_blog'] = url_title($this->request->getPost('judul'), '-', true);
        $data['kategori_id'] = $this->request->getPost('kategori');
        $data['isi_blog'] = $this->request->getPost('isi_blog');
        $id = $this->request->getPost('id_blog');

        if (!$this->validateData($data, $rules)) { // jika tidak tervalidasi
            return redirect()->back()->withInput();
        } else { //jika tervalidasi
            // --- banner ---
            $gambar = $this->request->getFile('banner');
            if ($gambar != '') {
                // generate nama sampul random
                $namaSampul = $gambar->getRandomName();
                // pindahkan file ke img
                $gambar->move('assets/img/blog', $namaSampul);

                $data['banner'] = $namaSampul;

                // gambar lama
                $gambar_l = $this->request->getPost('banner_l');
                if ($gambar_l != '') {
                    $file_name = 'assets/img/blog/' . $gambar_l;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }

            $ubahData = $this->BlogModel->update_blog($data, $id);

            if ($ubahData) {
                session()->setFlashdata('success', 'Berhasil ubah data');
                return redirect()->to(base_url('ladmin/blog'));
            } else {
                session()->setFlashdata('error', 'Gagal ubah data');
                return redirect()->to(base_url('ladmin/blog/edit/' . $id));
            }
        }
    }

    public function ajax_delete($id)
    {
        $blog = $this->BlogModel->get_blog_by_id($id);
        if (!empty($blog->id_blog)) {
            if (!empty($blog->banner)) {
                $file = 'assets/img/blog/' . $blog->banner;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $delete = $this->BlogModel->delete_blog($id);

            echo json_encode(array("status" => true));
        }
    }


    public function ajax_delete_banner($id)
    {
        $blog = $this->BlogModel->get_blog_by_id($id);
        if (!empty($blog->banner)) {
            $file = 'assets/img/blog/' . $blog->banner;
            if (file_exists($file)) {
                unlink($file);
                $data['banner'] = '';
                $this->BlogModel->update_blog($data, $id);
            }
        }
        echo json_encode(array("status" => true));
    }
}
