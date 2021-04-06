<?php
include("../include/connection.php");
$query = "insert into chemicals set name='" . $_POST['name'] . "', rate='" . $_POST['rate'] . "'";
$result = mysqli_query($con, $query);
header("location:./index.php");
