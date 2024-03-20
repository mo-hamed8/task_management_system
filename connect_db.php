<?php 

$config=require "config.php";

$config=$config["database"];

// Create connection
$conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }




?>