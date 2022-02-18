<?php
$host = "localhost";
$username = "root";
$password = "root";
$databases = "blog";

$con = mysqli_connect("$host", "$username", "$password", "$databases");

if (!$con) {
    header("Location: ../errors/dberror.php");
}
