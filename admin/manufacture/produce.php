<?php
include("../include/connection.php");

$medId = $_REQUEST["med"];
$units = $_REQUEST["units"];


$query = "select * from composition where mid='" . $medId . "'";
$compositions = mysqli_query($con, $query);

while ($fetch = mysqli_fetch_object($compositions)) {
  $chemId = $fetch->cid;
  $used = $units * $fetch->c_qty;
  echo $used;
  $query2 = "update chemicals set qty = qty-" . $used . " where id='" . $chemId . "'";
  $compositions = mysqli_query($con, $query2);
}
$query3 = "update medicines set qty = qty+" . $units . " where id='" . $medId . "'";
$compositions = mysqli_query($con, $query3);


header("location:../manufacture.php?med=" . $medId . "");
