<?php session_start();
if(isset($_SESSION['temp'])){
    $_SESSION['temp'] = 1;
}else{
    $_SESSION['temp']++;
}
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
    
    <?php 
        for($i=1;$i<=4;++$i){
            echo "<h$i>SUPER $i</h$i>";
        }
        $_SESSION['temp'] = 1;
    ?>
    <button onclick="fun()">Click me</button>
        <script>
            function fun(){

                var x = document.getElementsByTagName("<?php echo "h".$_SESSION['temp'] ?>");
                x[0].style.display = "none";
            }
        </script>
</body>
</html>