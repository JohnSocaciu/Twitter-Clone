<?php

try {
    require_once 'Models/database.php';
    require_once 'Models/tweets.php';
    require_once 'utility/ensure_logged_in.php';

    $likes = htmlspecialchars(filter_input(INPUT_POST, "likes"));
    $action = htmlspecialchars(filter_input(INPUT_POST, "action")); // all files
    $user_name = htmlspecialchars(filter_input(INPUT_POST, "user_name"));
    $search = htmlspecialchars(filter_input(INPUT_POST, "search"));

    $tweets = list_tweets(); // function to list all tweets submitted by all users on my version of twitter

    if ($action == "search") {
        include("Views/searchFunction.php");
    }
    
    include "Views/search.php";
} catch (Exception $ex) {
    $error_message = $ex->getMessage();
    include('Views/error.php');
}
