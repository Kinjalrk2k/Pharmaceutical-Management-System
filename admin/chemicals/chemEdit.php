<?php
include("../include/connection.php");
echo $_POST['name'];

$query = "update chemicals set name='" . $_POST['name'] . "', rate='" . $_POST['rate'] . "' where id='" . $_POST['id'] . "'";
$result = mysqli_query($con, $query);
header("location:./index.php");
