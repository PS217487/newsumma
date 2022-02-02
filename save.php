<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
} else {
    include_once("classes/connection/app.php");
    $app = new App();
    if (($_SESSION['role'] == "Student")) {
        if ($_SESSION['ps_number'] != $user->ps_number)
        {
            header('Location: index.php');
            exit;
        }
    }
}

$count = count($_GET);
if($count > 0) {
    foreach($_GET as $query_string_variable => $value) {
        $app->save_form(explode("-",$query_string_variable)[1], $_SESSION['id'], explode("-",$query_string_variable)[2], $value);
    }
}

header('Location: users.php');