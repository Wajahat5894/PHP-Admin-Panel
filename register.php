<?php
session_start();
include('includes/header.php');

if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Sie sind bereits registriert.";
    header("Location: index.php");
    exit(0);
}

include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Registrieren</h4>
                    </div>
                    <div class="card-body">
                        <form action="registercode.php" method="POST">
                            <div class="form-group mb-3">
                                <label>Vorname</label>
                                <input required type="text" placeholder="Vornamen eingeben:" name="fname" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Nachnamen</label>
                                <input required type="text" placeholder="Nachnamen eingeben:" name="lname" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>E-Mail</label>
                                <input required type="email" placeholder="E-Mail Adresse eingeben:" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Passwort</label>
                                <input required type="password" placeholder="Passwort eingeben:" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Passwort bestätigen:</label>
                                <input required type="password" placeholder="Passwort Wiederholen:" name="cpassword" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label>
                                <select name="role_as" required class="form-control">
                                    <option value="">--Status wählen--</option>
                                    <option value="1">Administrator</option>
                                    <option value="0">Benutzer</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit" name="register_btn">Registrieren</button>
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