<?php
session_start();
include('admin/config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3 class="text-dark">Kategorie</h3>
            </div>

            <?php
            $homeCategory = "SELECT * FROM categories WHERE navbar_status='0' AND status='0' LIMIT 12";
            $homeCategory_run = mysqli_query($con, $homeCategory);

            if (mysqli_num_rows($homeCategory_run) > 0) {
                foreach ($homeCategory_run  as $homeCatItem) {
            ?>
                    <div class="col-md-3 mb-4">
                        <a class="text-decoration-none" href="category.php?title=<?= $homeCatItem['slug']; ?>">
                            <div class="card card-body">
                                <?= $homeCatItem['name']; ?>
                            </div>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3 class="text-dark">Neusten Posts</h3>
            </div>

            <?php
            $homePosts = "SELECT * FROM posts WHERE status='0' ORDER BY id DESC LIMIT 12";
            $homePosts_run = mysqli_query($con, $homePosts);

            if (mysqli_num_rows($homePosts_run) > 0) {
                foreach ($homePosts_run  as $homePostItem) {
            ?>
                    <div class="col-md-3 mb-4">
                        <a class="text-decoration-none" href="post.php?title=<?= $homePostItem['slug']; ?>">
                            <div class="card card-body">
                                <?= $homePostItem['name']; ?>
                            </div>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3 class="text-dark mb-3">PHP Projekte machen Spaß</h3>
                <p>
                    Dies ist mein erstes PHP-Projekt, welches mir sehr viel spaß gemacht hat und ich vieles lernen konnte. Hauptsächlich habe ich mich mit diesem Projekt für den Backendbereich konzentriert.

                    Registrieren Sie sich als Administrator, um den vollen Umfang meines Projektes zu erleben.
                </p>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>