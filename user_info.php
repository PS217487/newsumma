<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("components/head.php") ?>
    <title>Document</title>
</head>

<body>
    <?php
    include_once("components/navbar.php");
    include_once("classes/connection/app.php");
    $app = new App();
    $user = $app->get_user($_GET["user_id"]);
    ?>
    <br>
    <div class="container">
        <div class="list-group">
              
            <p class="fs-1"> <?= $user->name . ' ' . $user->surname ?></p>
            <a class="link-secondary"><?= $user->ps_number ?></a>
            ';
            ?>
        </div>
    </div>
</body>

</html>