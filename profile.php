<?php
include_once("classes/connection/app.php");
$app = new App();
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = $app->get_user_levels($_SESSION["id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("components/head.php") ?>
    <title>Document</title>
</head>

<body>
    <?php
    include_once("components/navbar.php");
    ?>
    <br>
    <div class="container">
        <center>
            <h1 class="display-6">SummaPoint <span class="badge bg-secondary">/ Profiel</span></h1>
        </center>
        <br>
        <ul class="list-group">
            <li class="list-group-item"><b>Naam:</b> <?= $_SESSION['name'] ?> <?= $_SESSION['surname'] ?></li>
            <li class="list-group-item"><b>Email:</b> <?= $_SESSION['ps_number'] ?>@edu.summacollege.nl</li>
            <li class="list-group-item"><b>Rol:</b> <?= $_SESSION['role'] ?></li>
            <li class="list-group-item"><b>Level:</b>
                <?php foreach ($user as $level) {
                    echo $level . ", ";
                } ?>
            </li>
        </ul>
        <br><br>
        <center>
            <a class="btn btn-outline-primary" href="home.php"><i class="bi bi-chevron-left"></i> Terug naar home</a>
        </center>
    </div>
</body>

</html>