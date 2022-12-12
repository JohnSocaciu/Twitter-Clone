<?php

require_once 'Models/database.php';
require_once 'Models/profile.php';
require_once "Models/id.php";
require_once 'Models/tweets.php';
require_once 'utility/ensure_logged_in.php';

try {

    $user_name = ""; // isset checks if variable "user_name" has been set equal to something or "initialization" 

    if (isset($_GET['user_name'])) {

        if (profile::profile_query('SELECT user_name FROM users WHERE user_name = :user_name',
                        array(':user_name' => $_GET['user_name']))) {

            $user_name = profile::profile_query('SELECT user_name FROM users WHERE user_name = :user_name',
                            array(':user_name' => $_GET['user_name']))[0]['user_name'];

            if (isset($_POST['unfollow'])) {

                $followed_id = profile::profile_query('SELECT id FROM users WHERE user_name = :user_name',
                                array(':user_name' => $_GET['user_name']))[0]['id'];

                $current_user_id = id::select_id($_SESSION["user_identity"]); //function call to find the current user id

                    if (profile::profile_query('SELECT follower_id FROM follows WHERE user_id = :user_id',
                                    array(':user_id' => $followed_id))) {
                        profile::profile_query('DELETE FROM follows WHERE user_id = :user_id AND follower_id = :follower_id',
                                array(':user_id' => $followed_id, ':follower_id' => $current_user_id));
                    } else {
                        echo 'You are not following this user!';
                    }
            }

            if (isset($_POST['follow'])) {

                $followed_id = profile::profile_query('SELECT id FROM users WHERE user_name=:user_name',
                                array(':user_name' => $_GET['user_name']))[0]['id'];

                $current_user_id = id::select_id($_SESSION["user_identity"]); //function call to find the current user id

                if (profile::profile_query('SELECT follower_id FROM follows WHERE follower_id = :follower_id',
                                array(':follower_id' => $followed_id))) { // check to see if the user is being followed by current user
                    profile::profile_query('INSERT INTO follows VALUES (\'\', :follower_id, :current_user_id)',
                            array(':follower_id' => $followed_id, ':current_user_id' => $current_user_id));
                } else {
                    echo 'You Are Already Following This User!';
                }
            }
        } else {
            echo('The Profile Of The User You Wish To See Does Not Exist!');
        }
       
    }
     include 'Views/profile.php';
} catch (Exception $ex) {
    $error_message = $ex->getMessage();
    include('Views/error.php');
} 