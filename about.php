<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
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
    include_once("classes/connection/app.php");
    $app = new App();
    ?>
    <br>
    <div class="container">
        <center>
            <h1 class="display-6">SummaPoint <span class="badge bg-secondary">/ Over</span></h1>
        </center>
        <br><br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae rem ipsum quasi placeat, inventore ipsa
        illum eos, numquam, aliquam recusandae iste at iure pariatur provident! Modi reprehenderit distinctio minus
        assumenda provident impedit, quas velit dolores sit ea quaerat incidunt, dolore est eius deserunt aut
        voluptatum. Accusamus ex cum perferendis minima quasi, earum, quia eos incidunt tenetur mollitia suscipit,
        inventore doloribus!
    </div>
</body>

</html>