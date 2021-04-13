<?php
$con = mysqli_connect("localhost", "root", "", "pharma");

@session_start();
$isAdmin = isset($_SESSION['NAME']) && isset($_SESSION['EMAIL']) && $_SESSION['USER'] == "admin";
if (!$isAdmin) {
  header("location:../auth/login.php");
}
