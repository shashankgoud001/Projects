<?php
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];


    // $server = "sql203.epizy.com";
    // $username = "epiz_32217925";
    // $password = "OJQ5W1mWsCV1N";
    // $dbname = "epiz_32217925_database001";
    $server = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "f123";

    $conn = mysqli_connect($server,$username,$password,$dbname);
    
    if(!$conn){
        die("Connection Failed : ".mysqli_connect_error());
    }else{
        $stmt = $conn->prepare("INSERT INTO contact(name1,email,phone,message) values(?,?,?,?)");
        $stmt->bind_param("ssis",$name,$email,$phone,$message);
        $stmt->execute();
        echo "YO You did it";
        $stmt->close();
        $conn->close();
    }

?>