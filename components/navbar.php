<?php
include_once("classes/connection/app.php");
$app = new App();
// If the user is not logged in redirect to the login page...
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="./index.php"><span class="badge bg-secondary">SummaPoint</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="./index.php">Home <i class="bi bi-house-fill"></i></a>
        </li>
        <?php
        if (isset($_SESSION['loggedin'])) {
          echo '
          <li class="nav-item">
          <a class="nav-link active" href="./users.php">Mijn beoordelingen <i class="bi bi-file-bar-graph-fill"></i></a>
          </li>
          
          <li class="nav-item">
          <a class="nav-link active" href="">Feedback <i class="bi bi-megaphone-fill"></i></a>
          </li>
          
          <li class="nav-item">
          <a class="nav-link active" href="">Mijn Stage <i class="bi bi-briefcase-fill"></i></a>
          </li>';
        }
        ?>
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="./about.php">Over SummaPoint <i class="bi bi-info-circle-fill"></i></a>
          </li>
        </ul>
        <?php
        if (!isset($_SESSION['loggedin'])) {
          echo '
          <a class="btn btn-outline-primary" href="./login.php">Log in <i class="bi bi-box-arrow-in-right"></i></a>';
        } else {
          echo '
            <div class="btn-group" role="group">
              <a class="btn btn-outline-primary" href="./profile.php">' . $_SESSION["ps_number"] . ' <i class="bi bi-file-person"></i></a>
              <a class="btn btn-outline-primary" href="./logout.php">Log uit <i class="bi bi-box-arrow-left"></i></a>
            </div>';
        }
        ?>
      </div>
    </div>
  </div>
</nav>