<?php
require_once ("post.php");

class Room implements JsonSerializable
{
    public $name;
    public $description;
    public $posts;
    public $lastid;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->lastid = 0;
        $this->posts = [];
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