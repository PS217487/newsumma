<?php
include "dbInterface.php";
include "dbConfig.php";

class App
{
    private $db_config;
    public $db_interface;

    function __construct()
    {
        $this->db_config = new DbConfig();
        $this->db_interface = new DbInterface($this->db_config);
    }

    function get_user($id)
    {
        return $this->db_interface->get_user($id);
    }

    function get_user_levels($id)
    {
        return $this->db_interface->get_user_levels($id);
    }
    
    function get_all_students()
    {
        return $this->db_interface->get_all_students();
    }

    function get_all_students_search($value)
    {
        return $this->db_interface->get_all_students_search($value);
    }
  
    function get_forms($level)
    {
        return $this->db_interface->get_forms($level);
    }
    function get_form_questions($id)
    {
        return $this->db_interface->get_form_questions($id);
    }
    function save_form($question_id, $teacher_id, $student_id, $value)
    {
        $this->db_interface->save_form($question_id, $teacher_id, $student_id, $value);
    }
    function get_form_answers($formid, $userid)
    {
        return $this->db_interface->get_form_answers($formid, $userid);
    }
}