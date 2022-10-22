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
    public function __construct($id, $username, $email, $password_hash)
    {
        $this->name = $username;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->id = $id;
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
        try {
            $conn = new PDO('mysql:host=localhost;dbname=cabaret', $_SERVER['MYSQL_USER'], $_SERVER['MYSQL_PASSWORD']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $u = $conn->prepare('SELECT * from users WHERE Name = :name');
            $u->execute(['name' => $username]);
            $l = $u->fetchAll()[0];
            if (password_verify($password, $l['password_hash']))
                $ret = new User($l['id'],$l['name'], $l['email'], $l['password_hash']);
            else
                $ret = null;
        } catch (PDOException  $e) {
            die("Unable to connect: " . $e->getMessage());
        }
        finally
        {
            $conn = null;
        }

        return $ret;
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
        if (User::user_exists($username))
            throw new Exception("User Already Exists");
        else {
            try {
                $conn = new PDO('mysql:host=localhost;dbname=cabaret', $_SERVER['MYSQL_USER'], $_SERVER['MYSQL_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $u = $conn->prepare('INSERT INTO  users (name, email, password_hash, join_date) VALUES (:name, :email, :password_hash, CURDATE())');
                $u->execute(['password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'name' => $username,
                    'email' => $email]);
            } catch (PDOException  $e) {
                die("Unable to connect: " . $e->getMessage());
            }
            $conn = null;
        }
        return User::login($username, $password);
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

    public function __toString(): string
    {
        return implode(',', [$this->id, $this->name, $this->email]);
    }
}