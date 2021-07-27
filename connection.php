<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="crud";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
if(mysqli_connect_errno()){
    echo "Fail to connect";
    exit();
}

?>