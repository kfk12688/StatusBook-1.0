<?php
include "conn.php";
session_start();
$regno=$_SESSION['regno'];
mysql_query("update admin set lilostatus='Offline' where regno='$regno'");

unset($_SESSION['regno']);
 
header('location:../index.html');
?>