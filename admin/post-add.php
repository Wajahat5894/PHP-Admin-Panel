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
                    <h4>Post hinzufügen
                        <a href="post-view.php" class="btn btn-danger float-end">Zurück</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Kategorie Liste</label>
                                <?php
                                $category = "SELECT * FROM categories WHERE status='0' ";
                                $category_run = mysqli_query($con, $category);

                                if (mysqli_num_rows($category_run) > 0) {
                                ?>
                                    <select name="category_id" required class="form-control">
                                        <option value="">-- Kategorie auswählen --</option>
                                        <?php
                                        foreach ($category_run as $categoryitem) {
                                        ?>
                                            <option value="<?= $categoryitem['id'] ?>"><?= $categoryitem['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                <?php
                                } else {
                                ?>
                                    <h5>Keine Kategorien verfügbar</h5>
                                <?php
                                }
                                ?>

                            </div>
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
                                <textarea name="description" id="summernote" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Bild</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Post verbergen</label>
                                <input type="checkbox" name="status" width="70px" height="70px">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="post_add" class="btn btn-primary">Speichern</button>
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