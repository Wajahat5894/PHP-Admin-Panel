<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
if (isset($_SESSION['auth'])) {
    if (!isset($_SESSION['message'])) {
        $_SESSION['message'] = "Sie sind bereits eingeloggt.";
    }
    header("Location: index.php");
    exit(0);
}
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="POST">
                            <div class="form-group mb-3">
                                <label>E-Mail</label>
                                <input type="email" name="email" placeholder="Geben Sie Ihre E-Mail Adresse ein:" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Passwort</label>
                                <input type="password" name="password" placeholder="Geben Sie Ihre Passwort ein:" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" name="login_btn" type="submit">Einloggen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>