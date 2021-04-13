<?php
include("../include/connection.php");

if (isset($_POST["register"])) {
  $query = "select count(*) as count from users where email='" . $_POST["email"] . "' and type='" . $_POST["type"] . "'";
  $result = mysqli_query($con, $query);
  $count = mysqli_fetch_object($result)->count;
  if ($count > 0) {
    echo "<script type='text/javascript'>
      window.addEventListener('load', () => openModal())
    </script>";
  } else {
    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $query1 = "insert into users set name='" . $_POST["name"] . "', email='" . $_POST["email"] . "', password='" . $hash . "', type='" . $_POST["type"] . "'";
    $result1 = mysqli_query($con, $query1);

    @session_start();
    $_SESSION['NAME'] = $_POST["name"];
    $_SESSION['EMAIL'] = $_POST["email"];
    $_SESSION['USER'] = $_POST["type"];
    $_SESSION['ID'] = $fetch->id;

    if ($_POST["type"] == "customer") {
      header("location:../index.php");
    } else if ($_POST["type"] == "admin") {
      header("location:../admin");
    } else {
      header("location:../vendor.php");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <title>Register</title>

  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .auth-card {
      display: inline-block;
      padding: 32px 48px 0px 48px;
      border: 1px solid #EEE;
      width: 400px;
    }
  </style>
</head>

<body class="indigo">
  <div class="container indigo">
    <div class="z-depth-1 grey lighten-4 row auth-card">
      <h3>Register</h3>
      <form class="col s12" method="POST" action="">
        <div class='row'>
          <div class='col s12'>
          </div>
        </div>

        <div class='row'>
          <div class='input-field col s12'>
            <input class='validate' type='text' name='name' id='name' required />
            <label for='name'>Enter your name</label>
          </div>
        </div>

        <div class='row'>
          <div class='input-field col s12'>
            <input class='validate' type='email' name='email' id='email' required />
            <label for='email'>Enter your email</label>
          </div>
        </div>

        <div class='row'>
          <div class='input-field col s12'>
            <input class='validate' type='password' name='password' id='password' required />
            <label for='password'>Enter your password</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <select name="type" required>
              <option value="customer">Customer</option>
              <option value="vendor">Vendor</option>
              <!-- <option value="admin">Administrator</option> -->
            </select>
            <label>User Type</label>
          </div>
        </div>

        <br />
        <center>
          <div class='row'>
            <button type='submit' name='register' class='col s12 btn btn-large waves-effect indigo'>Register</button>
          </div>
        </center>
      </form>
    </div>
  </div>

  <div id="err-modal" class="modal">
    <div class="modal-content">
      <h4>Can't Register</h4>
      <h5>The Email ID is already registered! Login through <a href="../auth/login.php">here</a></h5>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Okay</a>
    </div>
  </div>

  <div class="fixed-action-btn">
    <a class="btn-floating btn-large red" href="../">
      <i class="large material-icons">home</i>
    </a>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems);

      var elems = document.querySelectorAll('.modal');
      var instances = M.Modal.init(elems);
    });

    function openModal() {
      var instance = M.Modal.getInstance(document.querySelector('#err-modal'));
      instance.open();
    }
  </script>
</body>

</html>