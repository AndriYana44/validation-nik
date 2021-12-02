<?php
$_server = 'localhost';
$_username = 'user';
$_password = 'user';
$_dbname = 'districts-db';

$conn = new mysqli($_server, $_username, $_password, $_dbname);
if($conn->connect_error) {
    die('Connection failed!' . $conn->connect_error);
}