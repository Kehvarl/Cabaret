<?php

class Post implements JsonSerializable
{
    public $display_name;
    public $message;
    public $color;
    public $date_time;

    public function __construct($display_name, $message, $color="#000080")
    {
        $this->display_name = $display_name;
        $this->message = $message;
        $this->color = $color;
        $this->date_time = date("Y-m-d h:i:sa");
    }

    public function render()
    {
        $ret = "<div class='post' style='color: $this->color;'><span class='name'>$this->display_name</span> ";
        $ret .= "<span class='message'>$this->message</span> ";
        $ret .= "<span class='time'>$this->date_time</span></div>\n";

        return $ret;
    }

    public function jsonSerialize()
    {
        return [
            'display_name' => $this->display_name,
            'message' => $this->message,
            'color' => $this->color,
            'date_time' => $this->date_time
        ];
    }
}