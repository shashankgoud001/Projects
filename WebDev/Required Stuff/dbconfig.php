<?php 
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "password";
    $dbName = "project";

    $con = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    if($con->connect_error){
        die("Connection failed : ". $con->connect_error);
    }
?>