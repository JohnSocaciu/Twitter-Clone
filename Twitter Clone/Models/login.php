<?php

function login($user_name, $password) {

    global $database;

    $new_query = "SELECT user_name, password_hash FROM users WHERE user_name = :user_name";

    $new_statement = $database->prepare($new_query);
    $new_statement->bindValue(":user_name", $user_name);
    $new_statement->execute();
    $user = $new_statement->fetch();

    $new_statement->closeCursor();

    if ($user == NULL) {
        return false;
    }

    $password_hash = $user['password_hash'];

    return password_verify($password, $password_hash);
}
