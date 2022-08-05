<?php

    $server = "sql203.epizy.com";
    $username = "epiz_32217925";
    $password = "OJQ5W1mWsCV1N";
    $dbname = "epiz_32217925_database001";

    $conn = mysqli_connect($server,$username,$password,$dbname);
    
    if(!$conn){
        die("Connection Failed : ".mysqli_connect_error());
    }

?>