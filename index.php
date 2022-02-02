<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("components/head.php") ?>
    <title>Document</title>
</head>

<body>
    <?php
    include_once("classes/connection/app.php");
    $app = new App();
    ?>
    <div class="homescreen_banner shadow">
        <br>
        <div class="container">
            <center>
                <h1 class="display-4 text-light">Welkom bij <span class="badge bg-light text-dark">/ SummaPoint</span></h1>
                <br>
                <br>
                <a class="btn btn-lg btn-outline-light" href="./login.php">Log in <i class="bi bi-box-arrow-in-right"></i></a>
            </center>
        </div>
    </div>
    <?php include_once("components/navbar.php"); ?>
</body>

</html>