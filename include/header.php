<?php
@session_start();
$isAuth = isset($_SESSION['NAME']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <title>Pharma</title>
</head>

<body>

  <nav class="indigo darken-1">
    <div class="nav-wrapper" style="padding-left: 50px; padding-right: 50px">
      <a href="#" data-target="slide-out" class="sidenav-trigger" style="display: inline;"><i class="material-icons">menu</i></a>
      <a href="./" class="brand-logo">Pharma</a>

      <?php if ($isAuth) { ?>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="./auth/logout.php">Logout</a></li>
        </ul>
      <?php } else { ?>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="./auth/register.php">Register</a></li>
          <li><a href="./auth/login.php">Login</a></li>
        </ul>
      <?php } ?>
    </div>
  </nav>

  <ul id="slide-out" class="sidenav">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="https://picsum.photos/id/1042/400/600/?blur=2">
        </div>
        <!-- <a href="#user"><img class="circle" src="images/yuna.jpg"></a> -->
        <a href="#name"><span class="white-text name"><?php echo isset($_SESSION["NAME"]) ? $_SESSION["NAME"] : "You are" ?></span></a>
        <a href="#email"><span class="white-text email"><?php echo isset($_SESSION["EMAIL"]) ? $_SESSION["EMAIL"] : "not signed in" ?></span></a>
      </div>
    </li>
  </ul>



  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
    });
  </script>