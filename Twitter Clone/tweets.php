<?php

try {
    require_once 'Models/database.php';
    require_once 'Models/tweets.php';
    require_once 'utility/ensure_logged_in.php';

    $id = htmlspecialchars(filter_input(INPUT_POST, "id"));
    $photo_path = htmlspecialchars(filter_input(INPUT_POST, "photo_path"));
    $message = htmlspecialchars(filter_input(INPUT_POST, "message"));
    $likes = htmlspecialchars(filter_input(INPUT_POST, "likes"));
    $action = htmlspecialchars(filter_input(INPUT_GET, "action")); // all files

    if (isset($_POST['submit']) && isset($_FILES['photo_path'])) {

        echo"<pre>";
        print_r($_FILES['photo_path']);
        echo"</pre>";

        $img_name = $_FILES['photo_path']['name'];
        $img_size = $_FILES['photo_path']['size'];
        $error = $_FILES['photo_path']['error'];
        $tmp_name = $_FILES['photo_path']['tmp_name'];

        if ($error === 0) {
            if ($img_size > 10000000) {
                echo "Your File is to large, try again";
            } else {
                $extension = pathinfo($img_name, PATHINFO_EXTENSION);
                $extension_lower = strtolower($extension);

                $allowed = array("jpg", "jpeg", "png", "pdf");

                if (in_array($extension_lower, $allowed)) {
                    $new_name = uniqid("Photo", true) . "." . $extension_lower;
                    $img_path = 'Images/' . $new_name;
                    move_uploaded_file($tmp_name, $img_path);

                    $photo_path = $new_name;

                    global $database;

                    $name_session = $_SESSION["user_identity"];

                    $query = "INSERT INTO tweets (photo_path, message, likes, user_name) "
                            . "VALUES ('$photo_path', '$message', '$likes', '$name_session')";

                    // value binding in PDO protects against sql injection
                    $statement = $database->prepare($query);

                    $statement->execute();

                    $statement->closeCursor();
                }
            }
        }
    }

    include 'Views/tweets.php';
} catch (Exception $ex) {
    $error_message = $ex->getMessage();
    include('Views/error.php');
}