<?php
session_start();

if (isset($_POST['logout_btn'])) {
    // session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);

    $_SESSION['message'] = "Sie haben sich ausgeloggt.";
    header("Location: login.php");
    exit(0);
}
