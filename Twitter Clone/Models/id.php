<?php

class id {

    static function select_id($user_name) {

        global $database;

        $new_query = "SELECT id FROM users WHERE user_name = :user_name";

        $new_statement = $database->prepare($new_query);
        $new_statement->bindValue(":user_name", $user_name);
        $new_statement->execute();
        $user = $new_statement->fetch();
        $id = $user['id'];

        $new_statement->closeCursor();

        return $id;
    }

}
