<?php

$conn = new mysqli("localhost", "root", "", "demo1");

if ($conn->connect_errno){
    echo "connection failed";
}

$servername = "localhost";
$username = "username";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>