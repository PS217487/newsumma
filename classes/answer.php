<?php
class Answer {
    public $id;
    public $date_of_save;
    public $value;
    public $consecution;
    public $work_process;
    public $crebo;
    public $text;

    function __construct($sql_record)
    {
        $this->id = $sql_record["id"];
        $this->date_of_save = $sql_record["date_of_save"];
        $this->value = $sql_record["value"];
        $this->consecution = $sql_record["consecution"];
        $this->work_process = $sql_record["work_process"];
        $this->crebo = $sql_record["crebo"];
        $this->text = $sql_record["text"];
    }
}