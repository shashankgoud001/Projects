<?php 
    include_once('./connect.php');
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
    <!-- including css -->
    <link rel="stylesheet" href="./css/Style.css">
     <!-- including font-awesome -->
     <link rel="stylesheet" href="./fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">


    
    <title>Cards</title>
</head>
<body>
    <br>
    <br>
    <form class="search" action="#">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <br>
    <br>
    <div class="commonContainer">

        <?php 
            $pagename = basename($_SERVER['PHP_SELF']);
            $image_name = substr($pagename,0,strlen($pagename)-4);
            $start_from++;
            while($rows=mysqli_fetch_assoc($result)){
                echo "<div class=\"commonCard\">";
                echo "<img src=\"./assets/imgs/$image_name$start_from.png\" alt=\"img\">";
                echo "<div class=\"commonContent\">";   

                if($rows['title']!=='none'){
                    
                    echo "<p class=\"commonName\">".ucfirst($rows['title'])."</p>";   //title
                }
                $stars = $rows['stars']*20;
                echo "<div class=\"stars\"><div class=\"stars-inner\" style=\"width: $stars% !important;\" ></div></div>"; //stars
                ?>
                <?php
                if($rows['location']!=='none'){
                    echo "<p class=\"location\"> <i class=\"fa-solid fa-location-dot\"></i>".ucfirst($rows['location'])."</p>"; //location
                }
                if($rows['venueType']!=='none'){
                    echo "<p class=\"type\"><i class=\"fa-solid fa-hotel\"></i>".ucfirst($rows['venueType'])."</p>";   //type
                }
                if($rows['people_range']!=='none'){
                    echo "<p class=\"range\"><i class=\"fa-solid fa-people-group\"></i>".ucfirst($rows['people_range'])."</p>"; //range
                }
                if($rows['cost']!=='none'){
                    echo "<p class=\"cost\">".$rows['cost']."</p>";   //cost
                }
                echo "</div>";
                if($rows['buy']!=0){
                    echo "<button class=\"commonBuy\">BUY</button>";
                }
                echo "</div>";
        ?>

        <?php
            $start_from++;    
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
