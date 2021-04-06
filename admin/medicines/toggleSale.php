<?php
include("../include/connection.php");

if (isset($_POST["forSale"])) {
  $query3 = "update medicines set forSale = '1' where id='" . $_POST["forSale"] . "'";
} else {
  $query3 = "update medicines set forSale = '0' where id='" . $_POST["id"] . "'";
}
$result3 = mysqli_query($con, $query3);

header("location:../medicines.php");
