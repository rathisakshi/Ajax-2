<?php

$servername = 'localhost';
$username = 'admin';
$password = 'admin';
$dbname = 'myDB';

$conn = new mysqli( $servername, $username, $password, );
if ( $conn->connect_error ) {
    die( 'Connection failed: ' . $conn->connect_error );
}
$createdb = "CREATE DATABASE IF NOT EXISTS $dbname";

if ( $conn->query( $createdb ) !== TRUE ) {
    echo 'Error creating database: ' . $conn->error;
}

$conn->select_db( $dbname );
$createtb = "CREATE TABLE IF NOT EXISTS Registrations (
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(15) NOT NULL,
    lastname VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)";

if ( $conn->query( $createtb ) !== TRUE ) {
echo 'Error creating table: ' . $conn->error;
}
?>
