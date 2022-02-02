<?php
include_once("classes/connection/app.php");
$app = new App();
session_start();

if (!isset($_POST['ps_number'], $_POST['password'])) {
    header('Location: index.php');
    exit;
}

if ($stmt = $app->db_interface->connection->prepare('SELECT user.id, user.name, user.surname, user.password, role.name FROM user INNER JOIN user_role ON user.id = user_role.user_id INNER JOIN role ON user_role.role_id = role.id WHERE user.ps_number = ?')) {
    $stmt->bind_param('s', $_POST['ps_number']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $user_name, $user_surname, $password, $role);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['ps_number'] = $_POST['ps_number'];
            $_SESSION['id'] = $user_id;
            $_SESSION['name'] = $user_name;
            $_SESSION['surname'] = $user_surname;
            $_SESSION['role'] = $role;
            header('Location: home.php');
        } else {
            header('Location: login.php?wrong=true');
        }
    } else {
        header('Location: login.php?wrong=true');
    }

    $stmt->close();
}
