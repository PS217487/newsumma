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
            header('Location: index.php');
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
    <?php include_once("components/navbar.php"); ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <p><b><?= $user->ps_number; ?></b>, <?= $user->name; ?> <?= $user->surname; ?></p>
            <form style="width: 100%;" action="save.php?second_id=">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CREBO</th>
                            <th scope="col">Werkproces</th>
                            <th scope="col">Omschrijving</th>
                            <th scope="col">Nog niet aangetoond</th>
                            <th scope="col">Veel begeleiding nodig</th>
                            <th scope="col">Op niveau m.b.t. opleiding</th>
                            <th scope="col">Op eindniveau (klaar voor PvB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $questions = $app->get_form_questions($formid);
                        $i = 0;
                        if (count($questions) > 0) {
                            foreach ($questions as $question) {
                                $i++;
                                echo '
                                <tr>
                                    <th scope="row">' . $i . '</th>
                                    <td>' . $question->crebo . '</td>
                                    <td>' . $question->work_process . '</td>
                                    <td>' . $question->text . '</td>
                                    <td><input type="radio" class="form-check-input" name="question-' . $question->id . '-' . $user->id . '" value="Nog niet aangetoond" required></td>
                                    <td><input type="radio" class="form-check-input" name="question-' . $question->id . '-' . $user->id . '" value="Veel begeleiding nodig" required></td>
                                    <td><input type="radio" class="form-check-input" name="question-' . $question->id . '-' . $user->id . '" value="Op niveau m.b.t. opleiding" required></td>
                                    <td><input type="radio" class="form-check-input" name="question-' . $question->id . '-' . $user->id . '" value="Op eindniveau (klaar voor PvB)" required></td>
                                </tr></td>';
                            }
                        } else {
                            echo '<span class="badge bg-danger">Geen formulieren gevonden...</span>';
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <br>
    <br>
</body>

</html>