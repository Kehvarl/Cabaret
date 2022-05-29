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
        $ret = "<div class='header'>$this->name</div>\n";
        $ret .= "<div class='posts'>\n";
        foreach ($this->posts as $p)
        {
            $ret .= "\t".$p->render();
        }
        $ret .= "</div>";

        return $ret;
    }
}