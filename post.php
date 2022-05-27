<?php

class post
{
    public $display_name;
    public $message;
    public $date_time;

    public function __construct($display_name, $message)
    {
        $this->display_name = $display_name;
        $this->message = $message;
        $date = new DateTime;
        $this->date_time = date("Y-m-d h:i:sa");
    }

    public function render()
    {
        $ret = "<div class='post'><span class='name'>{$this->display_name}</span>";
        $ret .= "<span class='message'>{$this->message}</span>";
        $ret .= "<span class='time'>{$this->date_time}</span></div>";
    }
}

?>