<?php

namespace App\Models;

use CodeIgniter\Model;

class HubungiModel extends Model
{
    protected $table            = 'hubungi';
    protected $primaryKey       = 'id_hubungi';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->hubungi = $db->table('hubungi');
    }

    // --- hubungi ---
    public function get_hubungi($limit = NULL, $order = NULL)
    {
        $builder = $this->hubungi;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_hubungi', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_hubungi_by_id($id)
    {
        $builder = $this->hubungi;
        $builder->select('*');
        $builder->where('id_hubungi', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_hubungi($data)
    {
        return $this->hubungi->insert($data);
    }

    public function update_hubungi($data, $id)
    {
        $builder = $this->hubungi;
        $builder->where('id_hubungi', $id);
        return $builder->update($data);
    }

    public function delete_hubungi($id)
    {
        $builder = $this->hubungi;
        $builder->where('id_hubungi', $id);
        return $builder->delete();
    }
}
