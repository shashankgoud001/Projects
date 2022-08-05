<?php 
// Database configuration 
$dbHost     = "sql6.freemysqlhosting.net"; 
$dbUsername = "sql6510058"; 
$dbPassword = "ldzZjGcMxl"; 
$dbName     = "sql6510058"; 
 
// Create database connection 
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

$sql = "SELECT * FROM users_data";
$query = $conn->query($sql);
if($query->num_rows > 0){ $i=0; 
    while($row = $query->fetch_assoc()){ $i++; 
        echo $row['username'];
    }
}
?>