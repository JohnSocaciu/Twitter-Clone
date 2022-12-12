<?php

try {
    require_once 'Models/database.php';
    require_once 'Models/login.php';

    $message = "";

    $name = htmlspecialchars(filter_input(INPUT_POST, "user_name"));
    $password = htmlspecialchars(filter_input(INPUT_POST, "password_hash"));
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $action = htmlspecialchars(filter_input(INPUT_GET, "action")); // all files

    session_start();

    $is_logged_in = login($name, $password);
    
    if ($is_logged_in) {
        $_SESSION["user_identity"] = $name; 
        echo "logged in successfully";
    }

    if ($action == "logout") {
        $_SESSION = array();
        session_destroy();
    }

    if ($name != "" && $password != "") {
        if (login($name, $password)) {
            $_SESSION['is_logged_in'] = true;
        } else {
            $message = "login failed, please try again!";
        }
    }

    include('Views/login.php');
} catch (Exception $ex) {
    $error_message = $ex->getMessage();
    include('Views/error.php');
} 