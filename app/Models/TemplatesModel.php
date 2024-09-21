<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplatesModel extends Model
{
    protected $table            = 'templates';
    protected $primaryKey       = 'id_templates';
    protected $useAutoIncrement = true;

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->templates = $db->table('templates');
    }

    public function get_templates_aktif()
    {
        $builder = $this->templates;
        $builder->select('*');
        $builder->where('aktif', 'Y');
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_templates($data)
    {
        return $this->templates->insert($data);
    }

    public function update_templates($data, $id)
    {
        $builder = $this->templates;
        $builder->where('id_templates', $id);
        return $builder->update($data);
    }

    public function nonaktifkan_templates($data, $id)
    {
        $builder = $this->templates;
        $builder->where('id_templates !=', $id);
        return $builder->update($data);
    }

    public function delete_templates($id)
    {
        $builder = $this->templates;
        $builder->where('id_templates', $id);
        return $builder->delete();
    }
}
