<?php
$servername = "localhost";
$username = 'ztsesjxun_admin4'; //demo username
$password = 'vY9jx4u#X8R#C!57'; //demo password
$dbname = "ztsesjxun_app8"; //demo databasename

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
