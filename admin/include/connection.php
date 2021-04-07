<?php
$con = mysqli_connect("localhost", "root", "", "pharma");

@session_start();
if (!isset($_SESSION['NAME']) && $_SESSION['USER'] != "admin") {
    header("location:../auth/login.php");
}
