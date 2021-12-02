<?php
//define parameters
$host = 'localhost';
$login = 'phpuser';
$password = 'phpuser';
$database = 'nft_warehouse';

//connect the database
$conn = @new mysqli($host, $login, $password, $database);

//handle connection errors
if ($conn->connect_errno){
    $errno = $conn->connect_errno;
    $errmsg = $conn->connect_error;
    die ("Connection to database failed: ($errno) $errmsg."); //displays message and exits php code
}
