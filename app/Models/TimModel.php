<?php

namespace App\Models;

use CodeIgniter\Model;

class TimModel extends Model
{
    protected $table            = 'tim';
    protected $primaryKey       = 'id_tim';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->tim = $db->table('tim');
    }

    // --- tim ---
    public function get_tim($limit = NULL, $order = NULL)
    {
        $builder = $this->tim;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_tim', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_tim_by_id($id)
    {
        $builder = $this->tim;
        $builder->select('*');
        $builder->where('id_tim', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_tim($data)
    {
        return $this->tim->insert($data);
    }

    public function update_tim($data, $id)
    {
        $builder = $this->tim;
        $builder->where('id_tim', $id);
        return $builder->update($data);
    }

    public function delete_tim($id)
    {
        $builder = $this->tim;
        $builder->where('id_tim', $id);
        return $builder->delete();
    }
}
