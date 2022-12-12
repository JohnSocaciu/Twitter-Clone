<?php

class tweets {

    private $id, $photo_path, $message, $likes, $user_name;

    public function __construct($photo_path, $message, $likes, $user_name, $id = 0) {
        $this->set_id($id);
        $this->set_message($message);
        $this->set_likes($likes);
        $this->set_photo_path($photo_path);
        $this->set_user_name($user_name);
    }

    public function get_id() {
        return $this->id;
    }

    public function get_photo_path() {
        return $this->photo_path;
    }

    public function set_photo_path($photo_path): void {
        $this->photo_path = $photo_path;
    }

    public function get_message() {
        return $this->message;
    }

    public function get_likes() {
        return $this->likes;
    }

    public function get_user_name() {
        return $this->user_name;
    }

    public function set_id($id): void {
        $this->id = $id;
    }

    public function set_message($message): void {
        $this->message = $message;
    }

    public function set_likes($likes): void {
        $this->likes = $likes;
    }

    public function set_user_name($user_name): void {
        $this->user_name = $user_name;
    }

}

function list_tweets() { // returns tweets
    global $database;

    $new_query = "SELECT id, message, likes, user_name, photo_path FROM tweets"; // where the user logged in follows the user who made the tweet
    $new_statement = $database->prepare($new_query);
    $new_statement->execute();
    $tweets = $new_statement->fetchAll();
    $new_statement->closeCursor();

    $tweets_array = array();

    foreach ($tweets as $tweet) {
        $tweets_array[] = new tweets($tweet['id'], $tweet['message'], $tweet['likes'], $tweet['user_name'], $tweet['photo_path']);
    }

    return $tweets_array;
}

function list_tweets_profile() { // subject to change 
    global $database;
    
    $query = 'SELECT id, message, likes, user_name, photo_path FROM tweets WHERE id = :id';
    $new_statement = $database->prepare($query);
    $new_statement->bindValue(":id", $_GET['id']);
    $new_statement->execute();
    $tweets = $new_statement->fetchAll();
    
    $tweets_array = array();

    foreach ($tweets as $tweet) {
        $tweets_array[] = new tweets($tweet['id'], $tweet['message'], $tweet['likes'], $tweet['user_name'], $tweet['photo_path']);
    }

    return $tweets_array;
}

function list_tweets_from_follows() {

    require_once ('Models/id.php');
    global $database;

    $current_user_id = id::select_id($_SESSION["user_identity"]); //function call to find the current user id

    $new_query = 'SELECT user_id FROM follows WHERE follower_id = :follower_id';
    $new_statement = $database->prepare($new_query);
    $new_statement->bindValue(":follower_id", $current_user_id);
    $new_statement->execute();
    $tweet = $new_statement->fetch();
    $tweets_from_follows = $tweet['user_id'];

    $new_statement->closeCursor();

    $even_better_query = "SELECT user_name FROM users WHERE id = :id";
    $even_better_statement = $database->prepare($even_better_query);
    $even_better_statement->bindValue(":id", $tweets_from_follows);
    $even_better_statement->execute();
    $name = $even_better_statement->fetch();
    $name_from_follows = $name['user_name'];
    
    $even_better_statement->closeCursor();

    $query = "SELECT id, message, likes, user_name, photo_path FROM tweets WHERE user_name = :user_name";
    $statement = $database->prepare($query);
    $statement->bindValue(":user_name", $name_from_follows);
    $statement->execute();
    $tweets = $statement->fetchAll();

    $statement->closeCursor();

    $tweets_array = array();

    foreach ($tweets as $tweet) {
        $tweets_array[] = new tweets($tweet['id'], $tweet['message'], $tweet['likes'], $tweet['user_name'], $tweet['photo_path']);
    }

    return $tweets_array;
}

function insert_tweet($tweet) { // keep this function if needed (not currently used) 
    global $database;

    $query = "INSERT INTO tweets (photo_path, message, likes, user_name) VALUES (:photo_path, :message, :likes, :user_name)";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":message", $tweet->get_message());
    $statement->bindValue(":user_name", $tweet->get_user_name());
    $statement->bindValue(":photo_path", $tweet->get_photo_path());
    $statement->bindValue(":likes", 0);

    $statement->execute();

    $statement->closeCursor();
}

function like_tweet() { 

    global $database;
    
    $query = "UPDATE tweets SET likes = likes + 1 WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":id", $_GET['id']);

    $statement->execute();

    $statement->closeCursor();
}
