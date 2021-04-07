<?php
include("../include/connection.php");
$error_modal = "<script type='text/javascript'>
window.addEventListener('load', () => openModal())
</script>";

if (isset($_POST["login"])) {
  $query = "select * from users where email='" . $_POST["email"] . "' and type='" . $_POST["type"] . "'";
  $result = mysqli_query($con, $query);
  $count = mysqli_num_rows($result);

  if ($count > 0) {
    $fetch = mysqli_fetch_object($result);
    $hash = $fetch->password;
    if (password_verify($_POST["password"], $hash)) {
      session_start();
      $_SESSION['NAME'] = $fetch->name;
      $_SESSION['EMAIL'] = $fetch->email;
      $_SESSION['USER'] = $fetch->type;

      if ($_POST["type"] == "customer") {
        header("location:index.php");
      } else if ($_POST["type"] == "admin") {
        header("location:../admin");
      } else {
        header("location:../vendor");
      }
    } else {
      echo $error_modal;
    }
  } else {
    echo $error_modal;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <title>Login</title>

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
      <h3>Login</h3>
      <form class="col s12" method="post">
        <div class='row'>
          <div class='col s12'>
          </div>
        </div>

        <div class='row'>
          <div class='input-field col s12'>
            <input class='validate' type='email' name='email' id='email' />
            <label for='email'>Enter your email</label>
          </div>
        </div>

        <div class='row'>
          <div class='input-field col s12'>
            <input class='validate' type='password' name='password' id='password' />
            <label for='password'>Enter your password</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <select name="type">
              <option value="" disabled selected>Choose your option</option>
              <option value="customer">Customer</option>
              <option value="vendor">Vendor</option>
              <option value="admin">Administrator</option>
            </select>
            <label>User Type</label>
          </div>
        </div>

        <br />
        <center>
          <div class='row'>
            <button type='submit' name='login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
          </div>
        </center>
      </form>
    </div>
  </div>

  <div id="err-modal" class="modal">
    <div class="modal-content">
      <h4>Incorrect Credentials</h4>
      <h5>Make sure you type in your correct Email ID and password!</h5>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Okay</a>
    </div>
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