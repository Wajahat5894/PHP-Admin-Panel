<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <?php include('message.php') ?>
            <div class="card">
                <div class="card-header">
                    <h4>Kategorien bearbeiten
                        <a href="register-view.php" class="btn btn-danger float-end">Zurück</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {

                        $category_id = $_GET['id'];
                        $catogery_edit = "SELECT * FROM categories WHERE id='$category_id' ";
                        $catogery_run = mysqli_query($con, $catogery_edit);

                        if (mysqli_num_rows($catogery_run) > 0) {

                            $row = mysqli_fetch_array($catogery_run);
                    ?>
                            <form action="code.php" method="POST">
                                <input type="hidden" name="category_id" value="<?= $row['id'] ?>">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="">Titel</label>
                                        <input type="text" name="meta_title" class="form-control" max="191" value="<?= $row['meta_title'] ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">URL</label>
                                        <input type="text" name="slug" class="form-control" value="<?= $row['slug'] ?>" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="">Bezeichnung</label>
                                        <textarea name="description" class="form-control" rows="4" required><?= $row['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Navbar Status</label>
                                        <input type="checkbox" name="navbar_status" <?= $row['navbar_status'] == '1' ? 'checked' : '' ?> width="70px" height="70px">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Navigationsleiste verbergen</label>
                                        <input type="checkbox" name="status" <?= $row['status'] == '1' ? 'checked' : '' ?> width="70px" height="70px">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="category_update" class="btn btn-primary">Änderungen speichern</button>
                                    </div>
                                </div>
                            </form>
                        <?php

                        } else {
                        ?>
                            <h4>Keine Daten gefunden</h4>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>