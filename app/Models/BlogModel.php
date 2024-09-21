<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table            = 'blog';
    protected $primaryKey       = 'id_blog';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->blog = $db->table('blog');
    }

    // --- blog ---
    public function get_blog($limit = NULL, $order = NULL)
    {
        $builder = $this->blog;
        $builder->select('blog.*,kategori.nm_kategori,kategori.slug_kategori');
        $builder->join('kategori', 'kategori.id_kategori=blog.kategori_id');
        if ($order != NULL) {
            $builder->orderBy('id_blog', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_blog_where($data, $limit = NULL)
    {
        $builder = $this->blog;
        $builder->select('blog.*,kategori.nm_kategori,kategori.slug_kategori');
        $builder->join('kategori', 'kategori.id_kategori=blog.kategori_id');
        $builder->where($data);
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_blog_by_id($id)
    {
        $builder = $this->blog;
        $builder->select('*');
        $builder->where('id_blog', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_blog($data)
    {
        return $this->blog->insert($data);
    }

    public function update_blog($data, $id)
    {
        $builder = $this->blog;
        $builder->where('id_blog', $id);
        return $builder->update($data);
    }

    public function delete_blog($id)
    {
        $builder = $this->blog;
        $builder->where('id_blog', $id);
        return $builder->delete();
    }
}
