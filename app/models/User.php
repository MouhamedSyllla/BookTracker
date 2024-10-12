<?php

class User extends Model {
    protected $table = 'users';

    public function register($data) {
        $sql = "INSERT INTO {$this->table} (
                    name, 
                    email, 
                    password,
                    avatar
                ) VALUES (
                    :name, 
                    :email, 
                    :password,
                    :avatar
                )";
        return (
            $this->query($sql, [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'avatar' => $data['avatar']
        ], true)
    );
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $row = $this->query($sql, ['email' => $email])->fetch();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $row = $this->query($sql, ['email' => $email])->fetch();
        return $row ? true : false;
    }
}
