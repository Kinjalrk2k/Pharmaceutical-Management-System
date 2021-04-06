<?php
include("../include/connection.php");

$query = "update composition set cid='" . $_POST['cid'] . "', mid='" . $_POST['mid'] . "', c_qty='" . $_POST['c_qty'] . "' where comp_id='" . $_POST['comp_id'] . "'";
$result = mysqli_query($con, $query);

header("location:../composition.php?med=" . $_POST['mid'] . "");
