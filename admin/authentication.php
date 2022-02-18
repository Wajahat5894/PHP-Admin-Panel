<?php
session_start();
include('config/dbcon.php');

if (!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Log-in als Administrator";
    header("Location: ../login.php");
    exit(0);
} else {
    if ($_SESSION['auth_role'] != 1) {
        $_SESSION['message'] = "Sie haben keinen Zugriff zum Administrator.";
        header("Location: ../login.php");
        exit(0);
    }
}
