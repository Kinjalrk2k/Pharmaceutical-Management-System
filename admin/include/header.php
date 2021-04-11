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

  <title>Admin Panel</title>
</head>

<body>

  <nav class="indigo darken-1">
    <div class="nav-wrapper" style="padding-left: 50px; padding-right: 50px">
      <a href="#" data-target="slide-out" class="sidenav-trigger" style="display: inline;"><i class="material-icons">menu</i></a>
      <a href="../admin" class="brand-logo">Pharma - Admin Panel</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="../auth/logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>

  <ul id="slide-out" class="sidenav">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="https://picsum.photos/id/1042/400/600/?blur=2">
        </div>
        <!-- <a href="#user"><img class="circle" src="images/yuna.jpg"></a> -->
        <a href="#name"><span class="white-text name"><?php echo $_SESSION["NAME"] ?></span></a>
        <a href="#email"><span class="white-text email"><?php echo $_SESSION["EMAIL"] ?></span></a>
      </div>
    </li>
    <li><a class="subheader">Inventory</a></li>
    <li><a class="waves-effect" href="./chemicals.php"><i class="material-icons">science</i>Chemicals</a></li>
    <li><a class="waves-effect" href="./medicines.php"><i class="material-icons">medication</i>Medicines</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a class="subheader">Production</a></li>
    <li><a class="waves-effect" href="./composition.php"><i class="material-icons">pie_chart</i>Composition</a></li>
    <li><a class="waves-effect" href="./manufacture.php"><i class="material-icons">precision_manufacturing</i>Manufacture</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a class="subheader">Transactions</a></li>
    <li><a class="waves-effect" href="./vendors.php"><i class="material-icons">local_shipping</i>Vendors</a></li>
    <li><a class="waves-effect" href="./customers.php"><i class="material-icons">person</i>Customers</a></li>
  </ul>



  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
    });
  </script>