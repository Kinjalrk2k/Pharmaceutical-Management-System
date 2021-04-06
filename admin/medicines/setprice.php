<?php
include("../include/connection.php");

$query = "update medicines set price='" . $_POST['price'] . "' where id='" . $_POST['id'] . "'";
$result = mysqli_query($con, $query);

header("location:../composition.php?med=" . $_POST['id'] . "");
