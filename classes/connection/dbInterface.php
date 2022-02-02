<?php
require_once "./classes/user.php";
require_once "./classes/answer.php";
require_once "./classes/form.php";
require_once "./classes/question.php";

class DbInterface
{
    public $connection;

    function __construct($db_config)
    {
        // Create connection
        $this->connection = new mysqli($db_config->servername, $db_config->username, $db_config->password, $db_config->dbname);
        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    function __destruct()
    {
        $this->connection->close();
    }

    function get_user($id)
    {
        $stmt = $this->connection->prepare("SELECT user.id, user.ps_number, user.name, user.surname, level.name AS level_name, level.id AS level_id, role.name AS role_name FROM user INNER JOIN user_role ON user.id = user_role.user_id INNER JOIN role ON user_role.role_id = role.id INNER JOIN user_level ON user.id = user_level.user_id INNER JOIN level ON user_level.level_id = level.id WHERE user.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $output = new User($row);
        $output->levels = $this->get_user_levels($id);
        return $output;
    }

    function get_user_levels($id)
    {
        $stmt = $this->connection->prepare("SELECT level.name AS level FROM user_level INNER JOIN level ON level_id = level.id WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $output = array();
        while ($row = $result->fetch_assoc()) {
            array_push($output, $row['level']);
        }
        return $output;
    }

    function get_all_students()
    {
        $stmt = $this->connection->prepare("SELECT user.id, user.ps_number, user.name, user.surname, level.name AS level_name, level.id AS level_id, role.name AS role_name FROM user INNER JOIN user_role ON user.id = user_role.user_id INNER JOIN role ON user_role.role_id = role.id INNER JOIN user_level ON user.id = user_level.user_id INNER JOIN level ON user_level.level_id = level.id WHERE role.id = 2 ORDER BY level.name");
        $stmt->execute();
        $result = $stmt->get_result();
        $output = array();
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $user = new User($row);
            array_push($output, $user);
        }
        return $output;
    }

    function get_all_students_search($value)
    {
        $value = '%' . $value . '%';
        $stmt = $this->connection->prepare("SELECT user.id, user.ps_number, user.name, user.surname, level.name AS level_name, level.id AS level_id, role.name AS role_name FROM user INNER JOIN user_role ON user.id = user_role.user_id INNER JOIN role ON user_role.role_id = role.id INNER JOIN user_level ON user.id = user_level.user_id INNER JOIN level ON user_level.level_id = level.id WHERE role.id = 2 AND (user.name LIKE ? OR user.surname LIKE ? OR user.ps_number LIKE ? OR level.name LIKE ?) ORDER BY level.name");
        $stmt->bind_param('ssss', $value, $value, $value, $value);
        $stmt->execute();
        $result = $stmt->get_result();
        $output = array();
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $user = new User($row);
            array_push($output, $user);
        }
        return $output;
    }

    function get_forms($level)
    {
        $stmt = $this->connection->prepare("SELECT * FROM form WHERE level_id = ?");
        $stmt->bind_param('s', $level);
        $stmt->execute();
        $result = $stmt->get_result();
        $output = array();
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $form = new Form($row);
            array_push($output, $form);
        }
        return $output;
    }

    function get_form_questions($id)
    {
        $stmt = $this->connection->prepare("SELECT form_question.question_id, question.id, question.form_id, question.consecution, question.work_process, question.crebo, question.text FROM form_question INNER JOIN question ON form_question.question_id = question.id WHERE question.form_id = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $output = array();
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $question = new Question($row);
            array_push($output, $question);
        }
        return $output;
    }

    function save_form($question_id, $teacher_id, $student_id, $value)
    {
        date_default_timezone_set('Europe/Amsterdam');    
        $date = date('m-d-Y h:i:s a', time());
        $stmt = $this->connection->prepare("INSERT INTO answer (date_of_save, question_id, user_id, second_user_id, value) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiis", $date, $question_id, $teacher_id, $student_id, $value);
        $stmt->execute();
    }

    function get_form_answers($formid, $userid)
    {
        $stmt = $this->connection->prepare("SELECT answer.date_of_save, answer.question_id , answer.user_id , answer.second_user_id , answer.value, question.id, question.form_id, question.consecution, question.work_process, question.crebo, question.text FROM answer INNER JOIN question ON answer.question_id = question.id WHERE question.form_id = ? AND answer.second_user_id = ?");
        $stmt->bind_param('ii', $formid, $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $output = array();
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $answer = new Answer($row);
            array_push($output, $answer);
        }
        return $output;
    }
}
