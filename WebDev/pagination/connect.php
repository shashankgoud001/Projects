<?php 
    $conn = mysqli_connect('localhost','root','password','project');
    if(!$conn){
        die("Connection Failed : ") . mysqli_connect_error();
    }
?>