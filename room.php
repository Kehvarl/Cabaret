<?php
require_once ("post.php");
require_once ("login.php");

class Room implements JsonSerializable
{
    public $name;
    public $description;
    public $posts;
    public $lastid;
    public $logins;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->lastid = 0;
        $this->posts = [];
        $this->logins = [];
    }

    public function login($user, $name, $description="")
    {
        $newlogin = new Login($user, $name, $description);
        foreach($this->logins as $login)
        {
            if($newlogin->compare($login))
            {
                return false;
            }
        }
        $this->logins[] = $login;
        return true;
    }

    public function addpost($post)
    {
        $post->id = $this->lastid;
        $this->lastid++;
        $this->posts[] = $post;
    }

    public function render()
    {
        $ret = "<div class='header'>$this->name</div>\n";
        $ret .= "<div class='posts'>\n";
        foreach ($this->posts as $p)
        {
            $ret .= "\t".$p->render();
        }
        $ret .= "</div>";

        return $ret;
    }

    public function jsonSerialize()
    {
        return [
            'name'=> $this->name,
            'description'=> $this->description,
            'posts'=> $this->posts
        ];
    }
}