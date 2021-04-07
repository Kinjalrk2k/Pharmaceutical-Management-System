<?php
session_start();
unset($_SESSION['NAME']);
unset($_SESSION['EMAIL']);
unset($_SESSION['USER']);
header("location:../auth/login.php");
session_destroy();
