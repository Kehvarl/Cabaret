<?php
require_once ("post.php");
require_once ("login.php");

class Room implements JsonSerializable
{
    public $id;
    public $name;
    public $description;
    public $posts;
    public $lastid;
    public $logins;

    /**
     * @throws Exception
     */
    public function __construct($name, $description)
    {
        $this->id = random_int(1000,10000);
        $this->name = $name;
        $this->description = $description;
        $this->lastid = 0;
        $this->posts = [];
        $this->logins = [];
    }

    /**
     * @throws Exception
     */
    public static function list($user): array
    {
        return [new Room("Main", "The Main plane")];
    }

    public function login($user, $name, $description, $room): bool
    {
        $newlogin = new Login($user, $name, $description, $room);
        foreach($this->logins as $login)
        {
            if($newlogin->compare($login))
            {
                return false;
            }
        }
        $this->logins[] = $newlogin;
        return true;
    }

    public function addpost($post)
    {
        $post->id = $this->lastid;
        $this->lastid++;
        $this->posts[] = $post;
    }

    public function render(): string
    {
        $ret = "<div class='header'>$this->name</div><br>\n";
        $ret .= "<div class='posts'>\n";
        foreach ($this->posts as $p)
        {
            $ret .= "\t".$p->render();
        }
        $ret .= "</div>";

        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'name'=> $this->name,
            'description'=> $this->description,
            'posts'=> $this->posts
        ];
    }
}