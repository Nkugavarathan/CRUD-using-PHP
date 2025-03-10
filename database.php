<?php
// Define database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "phpmysql";

$connection = new mysqli($servername, $username, $password, $db_name);

if ($connection) {
    echo "db connected successfully";
} else {
    echo "Error occured : " . $connection->connect_error;
}


    /*
    *****************
    INSERT VALUES
    **************
    $query = "INSERT INTO clients(name,email,phone,address)
    VALUES ('varathan','kugan@gmail.com','0775019192','no 168yogaputarm')";

    // Execute the query
    if ($connection->query($query) === TRUE) {
    echo "Insert successfully";
    } else {
    echo "Error: " . $connection->connect_error;
    }*/