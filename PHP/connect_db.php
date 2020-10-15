<?php

$conn = new mysqli("localhost", "root", "", "demo1");

if ($conn->connect_errno){
    echo "connection failed";
}
?>