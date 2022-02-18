<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Benutzer Panel</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Benutzer</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Benutzer Übersicht
                        <a href="register-add.php" class="btn btn-primary float-end">Benutzer hinzufügen</a>
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vorname</th>
                                <th>Nachname</th>
                                <th>E-Mail</th>
                                <th>Status</th>
                                <th>Bearbeiten</th>
                                <th>Löschen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['fname']; ?></td>
                                        <td><?= $row['lname']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td> <?php
                                                if ($row['role_as'] == '1') {
                                                    echo 'Administrator';
                                                } elseif ($row['role_as'] == '0') {
                                                    echo 'Benutzer';
                                                }
                                                ?>
                                        </td>
                                        <td><a href="register-edit.php?id=<?= $row['id']; ?>" class="btn btn-primary">Bearbeiten</a></td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <button type="submit" name="user_delete" value="<?= $row['id']; ?>" class="btn btn-danger">Löschen</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {


                                ?>
                                <tr>
                                    <td colspan="6">Keine Daten gefunden</td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>