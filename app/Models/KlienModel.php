<?php

namespace App\Models;

use CodeIgniter\Model;

class KlienModel extends Model
{
    protected $table            = 'klien';
    protected $primaryKey       = 'id_klien';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->klien = $db->table('klien');
    }

    // --- klien ---
    public function get_klien($limit = NULL, $order = NULL)
    {
        $builder = $this->klien;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_klien', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_klien_by_id($id)
    {
        $builder = $this->klien;
        $builder->select('*');
        $builder->where('id_klien', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    function get_all_combobox_klien()
    {
        $data = $this->klien->orderBy('id_klien', 'ASC')->get();
        $numrows = count($data->getResult());
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_klien']] = $row['nm_klien'];
            }
            return $result;
        }
    }

    public function save_klien($data)
    {
        return $this->klien->insert($data);
    }

    public function update_klien($data, $id)
    {
        $builder = $this->klien;
        $builder->where('id_klien', $id);
        return $builder->update($data);
    }

    public function delete_klien($id)
    {
        $builder = $this->klien;
        $builder->where('id_klien', $id);
        return $builder->delete();
    }
}
