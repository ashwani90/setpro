<?php
//var_dump(new Mongo());die;
//work on connecting mongodb client to the php and then using it to connect to the mongodb server
$servername = "172.17.0.1";
$username = "root";
$password = "12345";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";