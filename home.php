<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
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
                <h1 class="display-4 text-light">SummaPoint <span class="badge bg-light text-dark">/ Home</span></h1>
                <br>
                <br><br>
                <h1 class="display-6 text-light">Welkom, <?= $_SESSION["name"] . " " . $_SESSION["surname"] ?></h1>
            </center>
        </div>
    </div>
    <?php include_once("components/navbar.php"); ?>
    <br>
    <br>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100 shadow">
                    <img src="images/lukas-blazek-mcSDtbWXUZU-unsplash.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mijn beoordelingen</h5>                     
                    </div>
                    <div class="card-footer"><a class="btn btn-outline-primary stretched-link" href="users.php">Bekijk</a></div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow">
                    <img src="images/scott-graham-5fNmWej4tAA-unsplash.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Feedback</h5>
                    </div>
                    <div class="card-footer"><a class="btn btn-outline-primary stretched-link" href="">Bekijk</a></div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow">
                    <img src="images/luke-chesser-JKUTrJ4vK00-unsplash.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mijn Stage</h5>
                    </div>
                    <div class="card-footer"><a class="btn btn-outline-primary stretched-link" href="">Bekijk</a></div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</body>

</html>