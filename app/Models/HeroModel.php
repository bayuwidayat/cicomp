<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroModel extends Model
{
    protected $table            = 'hero';
    protected $primaryKey       = 'id_hero';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->hero = $db->table('hero');
    }

    // --- hero ---
    public function get_hero($limit = NULL, $order = NULL)
    {
        $builder = $this->hero;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_hero', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_hero_by_id($id)
    {
        $builder = $this->hero;
        $builder->select('*');
        $builder->where('id_hero', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_hero($data)
    {
        return $this->hero->insert($data);
    }

    public function update_hero($data, $id)
    {
        $builder = $this->hero;
        $builder->where('id_hero', $id);
        return $builder->update($data);
    }

    public function delete_hero($id)
    {
        $builder = $this->hero;
        $builder->where('id_hero', $id);
        return $builder->delete();
    }
}
