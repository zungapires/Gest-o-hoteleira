<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    protected $file = 'users.json';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        return readJson($this->file);
    }

    public function find($id)
    {
        $users = $this->all();
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }

    public function findByEmail($email)
    {
        $users = $this->all();
        foreach ($users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                return $user;
            }
        }
        return null;
    }

    public function create($data)
    {
        $users = $this->all();
        $data['id'] = getNextJsonId($users);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $users[] = $data;
        writeJson($this->file, $users);
        return $data;
    }

    public function update($id, $data)
    {
        return updateJson($this->file, $id, $data);
    }
}
