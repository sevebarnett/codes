<?php
$servername = "localhost";
$username = 'xztsesjun_admin4'; //demo username
$password = 'xvY9j4u#X8R#C!57'; //demo password
$dbname = "xztsesjun_app8"; //demo databasename

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
