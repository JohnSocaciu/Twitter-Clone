<?php

class profile {

    public static function profile_query($new_query, $array = array()) {

        global $database;

        $statement = $database->prepare($new_query);
        $statement->execute($array);

        if (explode(' ', $new_query)[0] == 'SELECT') { // explode into substrings and put the keywork select into first array element
            $fetch_profile = $statement->fetchAll();
            return $fetch_profile;
        }
    }

}
