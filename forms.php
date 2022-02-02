<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
} else {
    include_once("classes/connection/app.php");
    $app = new App();
    $user = $app->get_user($_GET["userid"]);
    if (($_SESSION['role'] == "Student")) {
        if ($_SESSION['ps_number'] != $user->ps_number)
        {
            header('Location: index.php');
            exit;
        }
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
    <?php include_once("components/navbar.php"); ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <p><b><?= $user->ps_number; ?></b>, <?= $user->name; ?> <?= $user->surname; ?></p>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naam</th>
                        <th scope="col">Level</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $forms = $app->get_forms($user->level_id);
                    $i = 0;
                    if (count($forms) > 0) {
                        foreach ($forms as $form) {
                            $i++;
                            echo '
                            <tr>
                                <th scope="row">' . $i . '</th>
                                <td>' . $form->name . '</td>
                                <td>' . $user->level . '</td>';
                                if (($_SESSION['role'] == "Student")) {
                                    echo '<td><a class="btn btn-primary btn-sm" href="form_answers.php?userid=' . $user->id . '&formid=' . $form->id .'" role="button">Bekijk</a></td>';
                                }
                                else
                                {
                                    echo '<td><a class="btn btn-primary btn-sm" href="form.php?userid=' . $user->id . '&formid=' . $form->id .'" role="button">Beoordeel</a>
                                    <a class="btn btn-primary btn-sm" href="form_answers.php?userid=' . $user->id . '&formid=' . $form->id .'" role="button">Bekijk beoordeelde</a></td>';
                                }
                                echo '</tr></td>';
                        }
                    } else {
                        echo '<span class="badge bg-danger">Geen formulieren gevonden...</span>';
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