<?php
include("../include/connection.php");

$query = "insert into composition set cid='" . $_POST['cid'] . "', mid='" . $_POST['mid'] . "', c_qty='" . $_POST['c_qty'] . "'";
$result = mysqli_query($con, $query);

header("location:../composition.php?med=" . $_POST['mid'] . "");
