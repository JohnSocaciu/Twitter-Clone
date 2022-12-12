<?php

// database server type, location, database name
$data_source_name = 'mysql:host=localhost;dbname=socialmedia';
// feels bad, but we don't have time to show a better way 

$username = 'MediaUser';
$password = 'test';
$database = new PDO($data_source_name, $username, $password); // change info to match twitter clone database 

$alternate_connection_mysqli = mysqli_connect('localhost', $username, $password, 'socialmedia');

