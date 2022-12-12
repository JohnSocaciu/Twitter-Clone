<?php

require_once 'Models/database.php';
require_once 'Models/tweets.php';
require_once 'utility/ensure_logged_in.php';
require_once 'Models/profile.php';

$likes = htmlspecialchars(filter_input(INPUT_POST, "likes"));
$action = htmlspecialchars(filter_input(INPUT_POST, "action")); // all files

try {

    $id = "";

    if (isset($_GET['id'])) {

        $id = profile::profile_query('SELECT id FROM Tweets WHERE id = :id',
                        array(':id' => $_GET['id']))[0]['id'];
        $tweets = list_tweets_profile();
        include("Views/profileTweets.php");

        if (isset($_POST['like'])) {
            like_tweet();
        }
    }
} catch (Exception $ex) {
    $error_message = $ex->getMessage();
    include('Views/error.php');
}
