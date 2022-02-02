<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("components/head.php") ?>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <center>
            <br><br>
            <h1 class="display-4">SummaPoint <span class="badge bg-secondary">/ Hash</span></h1>
            <br>
            <form method="post" class="login_form shadow" accept-charset="utf-8">
                <label for="passwordOutput" class="form-label">Wachtwoord</label>
                <div class="mb-3">
                    <input type="text" class="form-control" name="passwordOutput" required>
                </div>
                <button type="submit" class="btn btn-primary">Hash</button>
            </form>
            <br><br>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["passwordOutput"])) {
                    $options = [
                        'cost' => 10
                    ];

                    echo '
                        <ul class="list-group">
                            <li class="list-group-item"><h6>' . $_POST["passwordOutput"] . '</h6></li>
                            <li class="list-group-item"><h5>' . password_hash($_POST["passwordOutput"], PASSWORD_BCRYPT, $options) . '</h5></li>
                        </ul>';
                }
            }
            ?>
            <br><br>
            <a class="btn btn-outline-primary" href="index.php"><i class="bi bi-chevron-left"></i> Terug naar home</a>
        </center>
    </div>
</body>

</html>