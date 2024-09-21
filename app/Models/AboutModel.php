<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table            = 'about';
    protected $primaryKey       = 'id_about';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->about = $db->table('about');
    }

    // --- about ---
    public function get_about($limit = NULL, $order = NULL)
    {
        $builder = $this->about;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_about', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_about_by_id($id)
    {
        $builder = $this->about;
        $builder->select('*');
        $builder->where('id_about', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_about($data)
    {
        return $this->about->insert($data);
    }

    public function update_about($data, $id)
    {
        $builder = $this->about;
        $builder->where('id_about', $id);
        return $builder->update($data);
    }

    public function delete_about($id)
    {
        $builder = $this->about;
        $builder->where('id_about', $id);
        return $builder->delete();
    }
}
