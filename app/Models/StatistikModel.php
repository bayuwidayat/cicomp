<?php

namespace App\Models;

use CodeIgniter\Model;

class StatistikModel extends Model
{
    protected $table            = 'statistik';
    protected $primaryKey       = 'id_statistik';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->statistik = $db->table('statistik');
    }

    // --- statistik ---
    public function get_statistik($limit = NULL, $order = NULL)
    {
        $builder = $this->statistik;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_statistik', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_statistik_by_id($id)
    {
        $builder = $this->statistik;
        $builder->select('*');
        $builder->where('id_statistik', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_statistik($data)
    {
        return $this->statistik->insert($data);
    }

    public function update_statistik($data, $id)
    {
        $builder = $this->statistik;
        $builder->where('id_statistik', $id);
        return $builder->update($data);
    }

    public function delete_statistik($id)
    {
        $builder = $this->statistik;
        $builder->where('id_statistik', $id);
        return $builder->delete();
    }
}
