<?php
class Question {
    public $id;
    public $form_id;
    public $consecution;
    public $work_process;
    public $crebo;
    public $text;

    function __construct($sql_record)
    {
        $this->id = $sql_record["id"];
        $this->form_id = $sql_record["form_id"];
        $this->consecution = $sql_record["consecution"];
        $this->work_process = $sql_record["work_process"];
        $this->crebo = $sql_record["crebo"];
        $this->text = $sql_record["text"];
    }
}