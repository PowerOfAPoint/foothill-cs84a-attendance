<?php
include_once "session.php";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendance - <?php echo $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <link href="css/site.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">IT Conference</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            <a class="nav-link" href="viewrecords.php">View Attendees</a>
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </div>
          <div class="navbar-nav ms-auto">
            <?php if (!isset($_SESSION["id"])) { ?>
              <a class="nav-link active" aria-current="page" href="login.php">Login</a>
            <?php } else { ?>
              <a class="nav-link active" aria-current="page" href="logout.php">
                <span>
                  Hello <?php echo $_SESSION["username"] ?>! (Logout)
                </span>
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </nav>
    <br>