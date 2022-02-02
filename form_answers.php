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
    $formid = $_GET["formid"];
    if (($_SESSION['role'] == "Student")) {
        if ($_SESSION['ps_number'] != $user->ps_number) {
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
                        <th scope="col">Datum</th>
                        <th scope="col">CREBO</th>
                        <th scope="col">Werkproces</th>
                        <th scope="col">Omschrijving</th>
                        <th scope="col">Resultaat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $questions = $app->get_form_answers($_GET['formid'], $user->id);
                    $i = 0;
                    if (count($questions) > 0) {
                        foreach ($questions as $question) {
                            $i++;
                            echo '
                                <tr>
                                    <th scope="row">' . $i . '</th>
                                    <td>' . $question->date_of_save . '</td>
                                    <td>' . $question->crebo . '</td>
                                    <td>' . $question->work_process . '</td>
                                    <td>' . $question->text . '</td>
                                    <td>' . $question->value . '</td>
                                </tr></td>';
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