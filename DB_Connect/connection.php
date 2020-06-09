<?php
// REAL LOGIN INFO
// $servername = 'soren-remboll.com.mysql';
// $username = 'soren_remboll_com';
// $password = 'KEA_webdev2020WaterBottle';
// $dbname = 'soren_remboll_com';


$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'soren_remboll_com';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};
