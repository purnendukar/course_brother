<?php 
function connect_mysql(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="admin";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
}

function connect_mysql_page(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="test";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
}

?>