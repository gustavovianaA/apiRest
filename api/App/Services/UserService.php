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
        $this->fields = ['name', 'email', 'password'];
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
        $this->userData = $_POST;
        //improve validation
        foreach ($this->fields as $field) {
            if (!Helper::validate($this->userData[$field], $field))
                throw new \Exception("Falha. Preencha corretamente os dados.");
        }
        return $this->user->insert($this->userData);
    }

    public function put()
    {
        $_PUT = array();
        if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
            parse_str(file_get_contents('php://input'), $_PUT);
            $this->userData = $_PUT;
            if (Helper::validate($this->userData['id'], 'id'))
                return $this->user->update($this->userData);
            else
                throw new \Exception("Falha. Preencha corretamente os dados.");
        }
    }

    public function delete()
    {
        $_DELETE = array();
        if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
            parse_str(file_get_contents('php://input'), $_DELETE);
            $this->userData = $_DELETE;
            if (Helper::validate($this->userData['id'], 'id'))
                return $this->user->delete($this->userData);
            else
                throw new \Exception("Falha. Informe um id válido.");
        }
    }
}
