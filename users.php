<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
} else {
    if (($_SESSION['role'] == "Student")) {
        header('Location: forms.php?userid=' . $_SESSION['id']);
        exit;
    }
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
    <?php include_once("components/navbar.php"); ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <form class="form-inline" method="POST">
                <div class="row g-3">
                    <div class="col">
                        <input class="form-control mr-sm-2" type="search" placeholder="Zoek naar student(en)" name="searchTextBox">
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" name="search" type="submit">Zoek</button>
                    </div>
                </div>
            </form>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">PS Nummer</th>
                        <th scope="col">Voornaam</th>
                        <th scope="col">Achternaam</th>
                        <th scope="col">Niveau</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users;
                    if (isset($_POST["searchTextBox"])) {
                        $users = $app->get_all_students_search($_POST["searchTextBox"]);
                    } else {
                        $users = $app->get_all_students();
                    }

                    $i = 0;
                    if (count($users) > 0) {
                        foreach ($users as $user) {
                            $i++;
                            echo '
                            <tr>
                                <th scope="row">' . $i . '</th>
                                <td>' . $user->ps_number . '</td>
                                <td>' . $user->name . '</td>
                                <td>' . $user->surname . '</td>
                                <td>' . $user->level . '</td>
                                <td><a class="btn btn-primary btn-sm" href="forms.php?userid=' . $user->id . '" role="button">Kies</a></td>
                            </tr></td>';
                        }
                    } else {
                        echo '<span class="badge bg-danger">Geen zoekresultaten gevonden...</span>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <br>
</body>

</html>