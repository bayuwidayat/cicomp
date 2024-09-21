<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimoniModel extends Model
{
    protected $table            = 'testimoni';
    protected $primaryKey       = 'id_testimoni';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->testimoni = $db->table('testimoni');
    }

    // --- testimoni ---
    public function get_testimoni($limit = NULL, $order = NULL)
    {
        $builder = $this->testimoni;
        $builder->select('*');
        $builder->join('klien', 'klien.id_klien=testimoni.klien_id');
        if ($order != NULL) {
            $builder->orderBy('id_testimoni', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_testimoni_by_id($id)
    {
        $builder = $this->testimoni;
        $builder->select('*');
        $builder->join('klien', 'klien.id_klien=testimoni.klien_id');
        $builder->where('id_testimoni', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_testimoni($data)
    {
        return $this->testimoni->insert($data);
    }

    public function update_testimoni($data, $id)
    {
        $builder = $this->testimoni;
        $builder->where('id_testimoni', $id);
        return $builder->update($data);
    }

    public function delete_testimoni($id)
    {
        $builder = $this->testimoni;
        $builder->where('id_testimoni', $id);
        return $builder->delete();
    }
}
