<?php
include('authentication.php');

// Posts löschen:
if (isset($_POST['post_delete_btn'])) {
    $post_id = $_POST['post_delete_btn'];
    // Bild auswählen:
    $check_img_query = "SELECT * FROM posts WHERE id='$post_id' LIMIT 1";
    $img_res = mysqli_query($con, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);
    $image = $res_data['image'];

    $query = "DELETE FROM posts WHERE id='$post_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        if (file_exists('../uploads/posts/' . $image)) {
            unlink("../uploads/posts/" . $image);
        }
        $_SESSION['message'] = "Post wurde erfolgreich gelöscht.";
        header('Location: post-view.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: post-view.php');
        exit(0);
    }
}

// Posts bearbeiten:
if (isset($_POST['post_update'])) {

    $post_id = $_POST['post_id'];

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']);
    $final_string = preg_replace('/-+/', '-', $string);
    $slug = $final_string;
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];

    $old_filename = $_POST['old_image'];
    $image = $_FILES['image']['name'];

    $update_filename = "";
    if ($image != NULL) {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_extension;

        $update_filename = $filename;
    } else {
        $update_filename = $old_filename;
    }

    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE posts SET category_id='$category_id', name='$name', slug='$slug', description='$description', image='$update_filename', meta_title='$meta_title', status='$status' WHERE id='$post_id' ";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        if ($image != NULL) {
            if (file_exists('../uploads/posts/' . $old_filename)) {
                unlink("../uploads/posts/" . $old_filename);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/' . $update_filename);
        }
        $_SESSION['message'] = "Post wurde erfolgreich geändert.";
        header('Location: post-edit.php?id=' . $post_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: post-edit.php?id=' . $post_id);
        exit(0);
    }
}

// Posts hinzufügen:
if (isset($_POST['post_add'])) {

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']);
    $final_string = preg_replace('/-+/', '-', $string);
    $slug = $final_string;
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $image = $_FILES['image']['name'];

    // Bild umbennen:
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_extension;
    $status = $_POST['status'] == true ? '1' : '0';


    $query = "INSERT INTO posts (category_id, name, slug, description, image, meta_title, status) VALUES('$category_id','$name', '$slug', '$description', '$filename', '$meta_title', '$status')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/' . $filename);
        $_SESSION['message'] = "Post wurde erfolgreich erstellt.";
        header('Location: post-add.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: post-add.php');
        exit(0);
    }
}

// Kategorie löschen:
if (isset($_POST['category_delete'])) {

    $category_id = $_POST['category_delete'];
    $query = "DELETE FROM categories WHERE id='$category_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Kategorien wurden erfolgreich gelöscht.";
        header('Location: category-view.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: category-view.php');
        exit(0);
    }
}

// Kategorie Inhalte bearbeiten:
if (isset($_POST['category_update'])) {

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']);
    $final_string = preg_replace('/-+/', '-', $string);
    $slug = $final_string;
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $navbar_status = $_POST['navbar_status'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', navbar_status='$navbar_status', status='$status' WHERE id='$category_id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Kategorien wurden erfolgreich geändert.";
        header('Location: category-edit.php?id=' . $category_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: category-edit.php?id=' . $category_id);
        exit(0);
    }
}

// Kategorien hinzufügen:
if (isset($_POST['category_add'])) {

    $name = $_POST['name'];
    $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']);
    $final_string = preg_replace('/-+/', '-', $string);
    $slug = $final_string;
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $navbar_status = $_POST['navbar_status'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "INSERT INTO categories (name, slug, description, meta_title, navbar_status, status) VALUES ('$name', '$slug', '$description', '$meta_title', '$navbar_status', '$status')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Kategorien erfolgreich hinzugefügt.";
        header('Location: category-add.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: category-add.php');
        exit(0);
    }
}

// Benutzer löschen:
if (isset($_POST['user_delete'])) {
    $user_id = $_POST['user_delete'];
    $query = "DELETE FROM users WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Benutzer erfolgreich gelöscht";
        header('Location: register-view.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: register-view.php');
        exit(0);
    }
}

// Benutzer hinzufügen:
if (isset($_POST['add_user'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "INSERT INTO users (fname, lname, email, password, role_as, status) VALUES ('$fname', '$lname', '$email', '$password', '$role_as', '$status')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Erfolgreich hinzugefügt";
        header('Location: register-view.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: register-view.php');
        exit(0);
    }
}

// Benutzer aktualisieren:
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE users SET fname='$fname', lname='$lname', email='$email', password='$password', role_as='$role_as', status='$status' WHERE id = '$user_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Erfolgreich aktualisiert";
        header('Location: register-view.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Etwas ist schiefgelaufen";
        header('Location: register-view.php');
        exit(0);
    }
}
