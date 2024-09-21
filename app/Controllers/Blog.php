<?php

namespace App\Controllers;

use App\Models\{BlogModel};

class Blog extends BaseController
{
    public function __construct()
    {
        $this->BlogModel = new BlogModel();
    }

    public function index()
    {
        $data['title'] = 'Blog';
        if (templates() == 'Error') {
            echo 'Error Template gan. Silahkan hubungi Webmaster';
        } else {
            $currentPage = $this->request->getVar('page_blog') ? $this->request->getVar('page_blog') : 1;
            $jPost = 10; // jumlah post per blog
            $data['blog'] = $this->BlogModel->select('blog.*,kategori.nm_kategori')->join('kategori', 'kategori.id_kategori=blog.kategori_id')->orderBy('id_blog', 'DESC')->paginate($jPost, 'blog');

            $data['pager'] = $this->BlogModel->pager;
            $data['jPost'] = $jPost;
            $data['currentPage'] = $currentPage;
            return view('frontend/' . templates()->folder . '/blog/index', $data);
        }
    }

    public function detail($slug)
    {
        $data['blog'] = $this->BlogModel->get_blog_where(['slug_blog' => $slug]);
        if (!empty($data['blog'])) {
            $data['title'] = $data['blog'][0]->judul;
            $data['blog_lain'] = $this->BlogModel->get_blog_where(['slug_blog <>' => $slug], 3);
        } else {
            $data['title'] = '';
        }
        return view('frontend/' . templates()->folder . '/blog/detail', $data);
    }

    public function kategori($slug)
    {
        $data['title'] = 'Kategori "' . $slug . '"';
        $currentPage = $this->request->getVar('page_blog') ? $this->request->getVar('page_blog') : 1;
        $jPost = 10; // jumlah post per blog
        $data['blog'] = $this->BlogModel->select('blog.*,kategori.nm_kategori')->join('kategori', 'kategori.id_kategori=blog.kategori_id')->where('kategori.slug_kategori', $slug)->orderBy('id_blog', 'DESC')->paginate($jPost, 'blog');

        $data['pager'] = $this->BlogModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('frontend/' . templates()->folder . '/blog/kategori', $data);
    }
}
