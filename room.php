<?php
require_once ("post.php");

class Room
{
    public $name;
    public $description;
    public $posts;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->posts = [];
    }

    public function render()
    {
        $ret = "<div class='header'>$this->name</div>";
        $ret .= "<div class='posts'>";
        foreach ($this->posts as $p)
        {
            $ret .= $p->render();
        }
        $ret .= "</div>";

        return $ret;
    }
}

$r = new Room("Main", "Room");
$r->posts[] = new Post("Kehvarl", "First Post.");
$r->posts[] = new Post("Kehvarl", "Second Post.");
$r->posts[] = new Post("Kehvarl", "Third Post.");

echo $r->render();