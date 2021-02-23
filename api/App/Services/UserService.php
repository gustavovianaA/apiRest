<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    private $user;
    private $userData;

    public function __construct()
    {
        $this->user = new User;
        $this->userData = $_POST;
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
        extract($this->userData);
        if (isset($id)) {
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
    }
}
