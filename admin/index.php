<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">PHP Admin Panel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Anzahl der Kategorien
                    <?php
                    $dash_category_query = "SELECT * FROM categories";
                    $dash_category_query_run = mysqli_query($con, $dash_category_query);

                    if ($category_total = mysqli_num_rows($dash_category_query_run)) {
                        echo '<h4 class="mb-0">' . $category_total . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">Keine Daten vorhanden</h4>';
                    }
                    ?>
                    <h4 class="mb-0"></h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Anzahl der Posts
                    <?php
                    $dash_posts_query = "SELECT * FROM posts";
                    $dash_posts_query_run = mysqli_query($con, $dash_posts_query);

                    if ($posts_total = mysqli_num_rows($dash_posts_query_run)) {
                        echo '<h4 class="mb-0">' . $posts_total . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">Keine Daten vorhanden</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Anzahl der Benutzer
                    <?php
                    $dash_users_query = "SELECT * FROM users WHERE role_as = 0";
                    $dash_users_query_run = mysqli_query($con, $dash_users_query);

                    if ($users_total = mysqli_num_rows($dash_users_query_run)) {
                        echo '<h4 class="mb-0">' . $users_total . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">Keine Daten vorhanden</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Anzahl der Administratoren
                    <?php
                    $dash_admin_query = "SELECT * FROM users WHERE role_as ='1' ";
                    $dash_admin_query_run = mysqli_query($con, $dash_admin_query);

                    if ($admin_total = mysqli_num_rows($dash_admin_query_run)) {
                        echo '<h4 class="mb-0">' . $admin_total . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">Keine Daten vorhanden</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>