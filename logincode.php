<?php
session_start();
include('admin/config/dbcon.php');

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email ='$email' AND password ='$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        // For-each Schleife für das Speichern der Daten beim Log-in
        foreach ($login_query_run as $data) {
            $user_id = $data['id'];
            $user_name = $data['fname'] . ' ' . $data['lname'];
            $user_email = $data['email'];
            $role_as = $data['role_as'];
        }
        // und der Session zuweisen.
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role_as";    // Wert 1 = Admin, 2 = User:
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
        ];

        if ($_SESSION['auth_role'] == '1') {
            $_SESSION['message'] = "Willkommen zu Ihrem Admin Panel";
            header("Location: admin/index.php");
            exit(0);
        } elseif ($_SESSION['auth_role'] == '0') {
            $_SESSION['message'] = "Sie sind eingeloggt";
            header("Location: index.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Passwort oder E-Mail ist falsch, bitte versuchen Sie es noch mal.";
        header("Location: login.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Sie sind nicht als Administrator eingeloggt!";
    header("Location: login.php");
    exit(0);
}
