<?php
require_once ('user.php');

class Login implements JsonSerializable
{
    public $name;
    public $description;
    public $user;
    public $room;
    public $unposted;
    public $update;

    public static function exists($user, $name, $room) : bool
    {
        return false;
    }

    public function __construct($user, $name, $description, $room)
    {
        $this->name = $name;
        $this->description = $description;
        $this->user = $user;
        $this->room = $room;
        $this->update = date("Y-m-d h:i:sa");
    }

    public function compare($other): bool
    {
        return ($this->name == $other->name &&
            $this->room->id == $other->room->id &&
            $this->user == $other->user);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'name'=>        $this->name,
            'description'=> $this->description,
            'update'=>      $this->update
        ];
    }
}