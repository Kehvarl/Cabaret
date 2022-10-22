<?php

class Post implements JsonSerializable
{
    public $id;
    public $user;
    public $display_name;
    public $message;
    public $color;
    public $font;
    public $date_time;

    public function __construct($user, $display_name, $message, $color="#000080", $font=null)
    {
        $this->user = $user;
        $this->display_name = $display_name;
        $this->message = $message;
        $this->color = $color;
        $this->font = $font;

        $this->date_time = date("Y-m-d h:i:sa");
    }

    public function render(): string
    {
        $ret = "<div class='post' style='color: $this->color;";
        if ($this->font)
        {   $ret .= "font-family: $this->font;";}
        $ret .= "'><span class='name'>$this->display_name</span> ";
        $ret .= "<span class='message'>$this->message</span> ";
        $ret .= "<span class='time'>$this->date_time</span>";
        $ret .= "&nbsp;&nbsp;<span class='user'>$this->user</span></div>\n";

        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'post_id' => $this->id,
            'display_name' => $this->display_name,
            'message' => $this->message,
            'color' => $this->color,
            'font' => $this->font,
            'date_time' => $this->date_time
        ];
    }
}