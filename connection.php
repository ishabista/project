<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "signup";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $signup);
if (!$conn) {
    die("Something went wrong;");
}
