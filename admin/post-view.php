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
                    <h4>Posts Ansicht
                        <a href="post-add.php" class="btn btn-primary float-end">Post erstellen</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripe">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Kategorie</th>
                                    <th>Bild</th>
                                    <th>Status</th>
                                    <th>Bearbeiten</th>
                                    <th>Löschen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$posts = "SELECT * FROM posts WHERE status != '2' ";
                                $posts = "SELECT p.*, c.name AS cname FROM posts p, categories c WHERE c.id = p.category_id";
                                $posts_run = mysqli_query($con, $posts);

                                if (mysqli_num_rows($posts_run) > 0) {
                                    foreach ($posts_run as $post) {
                                ?>
                                        <tr>
                                            <td><?= $post['id'] ?></td>
                                            <td><?= $post['name'] ?></td>
                                            <td><?= $post['cname'] ?></td>
                                            <td><img src="../uploads/posts/<?= $post['image'] ?>" width="60px" height="60px"></td>
                                            <td>
                                                <?= $post['status'] == '1' ? 'Verborgen' : 'Verfügbar' ?>
                                            </td>
                                            <td>
                                                <a href="post-edit.php?id=<?= $post['id'] ?>" class="btn btn-primary">Bearbeiten</a>
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <button type="submit" name="post_delete_btn" value="<?= $post['id'] ?>" class="btn btn-danger">Löschen</button>
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
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>