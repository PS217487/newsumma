<?php
class Form {
    public $id;
    public $level;
    public $name;

    function __construct($sql_record)
    {
        $this->id = $sql_record["id"];
        $this->name = $sql_record["name"];
    }
}