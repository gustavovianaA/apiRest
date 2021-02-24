<?php

namespace App\Services;

use App\Models\User;
use App\Libraries\Helper;

class UserService
{
    private $user;
    private $userData;
    private $fields;

    public function __construct()
    {
        $this->user = new User;
        $this->userData = $_POST;
        $this->fields = ['name','email','password'];
    }

    public function get($id = null)
    {
        if ($id) {
            return $this->user->select($id);
        } else {
            return $this->user->selectAll();
        }
    }

    public function post()
    {
        //to improve
        foreach($this->fields as $field){
            if(!Helper::validate($this->userData[$field],$field))
                throw new \Exception("Falha. Preencha corretamente os dados.");
        }
        
        if (isset($this->userData['id'])) {
            $this->update();
        } else {
            return $this->user->insert($this->userData);
        }
    }

    public function update()
    {
        return $this->user->update($this->userData);
    }

    public function delete()
    {
        //todo
    }
}
