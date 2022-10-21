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
        return password_verify($password, password_hash("password", PASSWORD_DEFAULT));
    }

    /**
     * @throws Exception
     */
    public static function login($username, $password): User
    {
        try
        {
            $conn = new PDO('mysql:host=localhost;dbname=cabaret',$_SERVER['MYSQL_USER'],$_SERVER['MYSQL_PASSWORD']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $u = $conn->prepare('SELECT * from users WHERE Name = :name');
            $u->execute(['name'=>$username]);
            $l = $u->fetchAll()[0];
            print_r($l);
            print(password_verify($password, $l['password_hash'])?"OK": "Bad Password");
        }
        catch (PDOException  $e)
        {
            die("Unable to connect: " . $e->getMessage());
        }
        $conn = null;



        return new User($username, "", password_hash($password, PASSWORD_DEFAULT));
    }

    /**
     * @throws Exception
     */
    public static function set_pass($username, $password): bool
    {
        try
        {
            $conn = new PDO('mysql:host=localhost;dbname=cabaret',$_SERVER['MYSQL_USER'],$_SERVER['MYSQL_PASSWORD']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $u = $conn->prepare('UPDATE users SET password_hash=:password_hash  WHERE name=:name');
            $u->execute(['password_hash'=>password_hash($password, PASSWORD_DEFAULT),
                        'name'=>$username]);
        }
        catch (PDOException  $e)
        {
            die("Unable to connect: " . $e->getMessage());
        }
        $conn = null;

        return  true;
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
    public function jsonSerialize(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email
        ];
    }
}