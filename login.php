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
            <h1 class="display-4">SummaPoint <span class="badge bg-secondary">/ Login</span></h1>
            <br>
            <form action="authenticate.php" method="post" class="login_form shadow" accept-charset="utf-8">
                <label for="ps_number" class="form-label">Gebruiker</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="PS-nummer" name="ps_number" required>
                    <span class="input-group-text" id="emailHelp">@edu.summacollege.nl</span>
                </div>
                <br>
                <label for="password" class="form-label">Wachtwoord</label>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Log in <i class="bi bi-box-arrow-in-right"></i></button>
                <br>
                <br>
                <?php
                if (isset($_GET["wrong"]) && $_GET["wrong"] == "true") {
                    echo '<p class="text-danger">Het PS-nummer of wachtwoord was verkeerd</p>';
                }
                ?>
            </form>
        </center>
    </div>
    <br>
</body>

</html>