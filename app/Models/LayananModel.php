<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id_layanan';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->layanan = $db->table('layanan');
    }

    // --- layanan ---
    public function get_layanan($limit = NULL, $order = NULL)
    {
        $builder = $this->layanan;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_layanan', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_layanan_by_id($id)
    {
        $builder = $this->layanan;
        $builder->select('*');
        $builder->where('id_layanan', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_layanan_where($data, $limit = NULL)
    {
        $builder = $this->layanan;
        $builder->select('*');
        $builder->where($data);
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function save_layanan($data)
    {
        return $this->layanan->insert($data);
    }

    public function update_layanan($data, $id)
    {
        $builder = $this->layanan;
        $builder->where('id_layanan', $id);
        return $builder->update($data);
    }

    public function delete_layanan($id)
    {
        $builder = $this->layanan;
        $builder->where('id_layanan', $id);
        return $builder->delete();
    }
}
