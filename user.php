<?php

class user implements JsonSerializable
{
    public $id;
    public $name;
    public $email;
    public $password;

    public static function check_password($username, $password)
    {
        return password_verify($password, password_hash("password", PASSWORD_BCRYPT));
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'name'  => $this->name,
            'email' => $this->email
        ];
    }
}