<?php
class User {
    public $id;
    public $ps_number;
    public $name;
    public $surname;
    public $level_id;
    public $level;
    public $role;
    public $levels = array();

    function __construct($sql_record)
    {
        $this->id = $sql_record["id"];
        $this->ps_number = $sql_record["ps_number"];
        $this->name = $sql_record["name"];
        $this->surname = $sql_record["surname"];
        $this->level_id = $sql_record["level_id"];
        $this->level = $sql_record["level_name"];
        $this->role = $sql_record["role_name"];
    }
}