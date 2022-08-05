<?php 
    include_once('connect.php');
    $num_per_page = 2;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $start_from = ($page-1)*$num_per_page;
    $sql="select * from services_data limit $start_from,$num_per_page";
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="commanContainer">

        <?php 
        $pagename = basename($_SERVER['PHP_SELF']);
            while($rows=mysqli_fetch_assoc($result)){
                echo "id : ".$rows['id']." ";
            echo "count : ".$rows['count']." ";
            echo "title : ".$rows['title']." ";
            echo "stars : ".$rows['stars']." ";
            echo "location : ".$rows['location']." ";
            echo "venueType : ".$rows['venueType']." ";
            echo "people_range : ".$rows['people_range']." ";
            echo "cost : ".$rows['cost']." ";
            echo "buy : ".$rows['buy']." ";
        ?>
        <br>
        <?php
            }
            
        ?>
    </div>

    <?php
        echo "<button onclick=\"location.href = '$pagename?page=";
        if($page==1){
            echo $page;
        }else{
            echo ($page-1);
        }
        echo "'\">Left</button>";
        echo "<button onclick=\"location.href = '$pagename?page=";
        $sql = "select * from services_data";
        $result = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($result);
        if($page==ceil($rows/$num_per_page)){
            echo $page;
        }else{
            echo ($page+1);
        }
        echo "'\">Right</button><br>";
    ?>



</body>
</html>
