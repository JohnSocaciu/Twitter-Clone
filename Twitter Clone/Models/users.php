<?php

class User {

    private $email_address, $user_name, $id, $password;

    public function __construct($user_name, $email_address, $password, $id = 0) {
        $this->set_user_name($user_name);
        $this->set_email_address($email_address);
        $this->set_id($id);
        $this->set_password($password);
    }

    public function get_email_address() {
        return $this->email_address;
    }

    public function get_Password() {
        return $this->password;
    }

    public function set_Password($password): void {
        $this->password = $password;
    }

    public function get_user_name() {
        return $this->user_name;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_email_address($email_address): void {
        $this->email_address = $email_address;
    }

    public function set_user_name($user_name): void {
        $this->user_name = $user_name;
    }

    public function set_id($id): void {
        $this->id = $id;
    }

}

function list_users() {

    global $database;

    $new_query = "SELECT user_name, email_address, id, password_hash FROM users";
    $new_statement = $database->prepare($new_query);
    $new_statement->execute();
    $users = $new_statement->fetchAll();
    $new_statement->closeCursor();

    $users_array = array();

    foreach ($users as $user) {
        $users_array[] = new User($user['email_address'], $user['user_name'], $user['id'], $user['password_hash']);
    }

    return $users_array;
}

function insert_user($user) {

    global $database;

    $query = "INSERT INTO users (user_name, email_address, password_hash) VALUES (:user_name, :email_address, :password_hash)";

    $pass = $user->get_password();

    $password_hash = password_hash($pass, PASSWORD_DEFAULT);

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":user_name", $user->get_user_name());
    $statement->bindValue(":email_address", $user->get_email_address());
    $statement->bindValue(":password_hash", $password_hash);

    $statement->execute();

    $statement->closeCursor();
}

function update_users($user) {

    global $database;

    $query = "UPDATE users SET email_address = :email_address "
            . " WHERE user_name = :user_name";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":user_name", $user->get_user_name());
    $statement->bindValue(":email_address", $user->get_email_address());

    $statement->execute();

    $statement->closeCursor();
}

function delete_users($user) {

    global $database;

    $query = "delete from users "
            . " where user_name = :user_name";

    // value binding in PDO protects against sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":user_name", $user->get_user_name());

    $statement->execute();

    $statement->closeCursor();
}
