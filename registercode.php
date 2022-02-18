<?php
session_start();
include('authentication.php');
include('admin/config/dbcon.php');

// Postformular in Variablen speichern und SQL Injection durchführen:
if (isset($_POST['register_btn'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['cpassword']);
    $role_as = $_POST['role_as'];

    // Passwörter prüfen:
    if (($password == $confirm_password) && (strlen($password) >= 8)) {

        // Dann nach vorhandener E-Mail prüfen:
        $checkEmail = "SELECT email FROM users WHERE email='$email'";
        $checkEmail_run = mysqli_query($con, $checkEmail);

        if (mysqli_num_rows($checkEmail_run) > 0) {
            // Falls E-Mail vorhanden ist, Benutzer zurückweisen mit Meldung.
            $_SESSION['message'] = "E-Mail bereits vorhanden.";
            header("Location: register.php");
            exit(0);

            // Ansonsten Daten einpflegen:
        } else {
            $user_query = "INSERT INTO users (fname, lname, email, password, role_as) VALUES ('$fname', '$lname', '$email', '$password', '$role_as')";
            $user_query_run = mysqli_query($con, $user_query);

            // Meldung (Erfolgreich registriert):
            if ($user_query_run) {
                $_SESSION['message'] = "Sie haben sich erfolgreich registriert, loggen Sie sich jetzt ein.";
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Es tut uns leid, anscheinend ist etwas schief gelaufen, bitte versuchen Sie sich erneut zu registrieren.";
                header("Location: register.php");
                exit(0);
            }
        }
    }
    // Falls Passwort nicht übereinstimmt Fehlermeldung ausgeben:
    else {
        $_SESSION['message'] = "Passwort muss mindestens 8 Zeichen lang sein und übereinstimmen.";
        header("Location: register.php");
        exit(0);
    }
}

// Falls Daten nicht vollständig sind, zurückweisen:
else {
    header("Location: register.php");
    exit(0);
}
