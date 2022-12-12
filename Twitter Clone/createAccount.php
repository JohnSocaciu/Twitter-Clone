<?php

session_start(); 

try{
    require_once 'Models/database.php';
    require_once 'Models/users.php';  

    $action = htmlspecialchars(filter_input(INPUT_POST, "action")); // all files
    $name = htmlspecialchars(filter_input(INPUT_POST, "user_name")); // user cont
    $email_address = htmlspecialchars(filter_input(INPUT_POST, "email_address", FILTER_VALIDATE_EMAIL)); 
    $password = htmlspecialchars(filter_input(INPUT_POST, "password_hash")); 

    if($action == "insert" && $name != "" && $email_address != "" && $password != ""){
        $user = new User($name, $email_address, $password); 
        insert_user($user); 
        header("Location: createAccount.php");
    }
    else if($action == "update" && $name != "" && $email_address != "" && $password != ""){
        $user = new User($name, $email_address, $password); 
        update_users($user); 
        header("Location: createAccount.php"); 
    }
    else if($action != ""){
        $error_message = "Missing Name Or Email Address"; 
        include('Views/error.php');
    }
    
    $users = list_users(); 
    
    include('Views/users.php'); 
}
 catch (Exception $ex) {
        $error_message = $ex->getMessage(); 
            include('Views/error.php'); 
} 