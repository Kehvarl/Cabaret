<?php

class user implements JsonSerializable
{
    public $id;
    public $name;
    public $email;
    public $password_hash;

    /**
     * @throws Exception
     */
    public function __construct($username, $email, $password_hash)
    {
        $this->name = $username;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->id = random_int(1000,10000);
    }

    public static function user_exists($username): bool
    {
        return false;
    }

    public static function email_exists($email): bool
    {
        return false;
    }

    public static function check_password($username, $password): bool
    {
        return password_verify($password, password_hash("password", PASSWORD_BCRYPT));
    }

    /**
     * @throws Exception
     */
    public static function create($username, $email, $password): user
    {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        if (user::user_exists($username))
        {
            throw new Exception("User Exists");
        }
        elseif (user::email_exists($email))
        {
            throw new Exception("Email Exists");
        }

        return new user($username, $email, $password_hash);
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