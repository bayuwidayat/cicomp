<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->users = $db->table('users');
    }

    public function get_users($data)
    {
        $builder = $this->users;
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    public function save_users($data)
    {
        return $this->users->insert($data);
    }

    public function update_users($data, $id)
    {
        $builder = $this->users;
        $builder->where('session_id', $id);
        return $builder->update($data);
    }

    public function delete_users($id)
    {
        $builder = $this->users;
        $builder->where('session_id', $id);
        return $builder->delete();
    }

    public function update_users_profile($data, $id, $uname)
    {
        $builder = $this->users;
        $builder->where('username', $uname);
        $builder->where('session_id', $id);
        return $builder->update($data);
    }
}
