<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Kategorien
                        <a href="category-view.php" class="btn btn-danger float-end">Zurück</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Titel</label>
                                <input type="text" name="meta_title" class="form-control" max="191" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">URL</label>
                                <input type="text" name="slug" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Bezeichnung</label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Navigationsleiste verbergen</label>
                                <input type="checkbox" name="navbar_status" width="70px" height="70px">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Kategorie verbergen</label>
                                <input type="checkbox" name="status" width="70px" height="70px">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="category_add" class="btn btn-primary">Speichern</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>