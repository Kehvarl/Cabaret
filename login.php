<?php

class Login implements JsonSerializable
{
    public $name;
    public $description;
    public $user;
    public $update;

    public function __construct($user, $name, $description="")
    {
        $this->name = $name;
        $this->description = $description;
        $this->user = $user;
        $this->update = date("Y-m-d h:i:sa");
    }

    public function compare($other)
    {
        return ($this->name == $other->name &&
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