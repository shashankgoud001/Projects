<?php 
// Include pagination library file 
include_once 'Pagination.class.php'; 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set some useful configuration 
$baseURL = 'getData.php'; 
$limit = 2; 
$websitename = "cakes";
// Count of all records 
$query   = $conn->query("SELECT COUNT(*) as rowNum FROM cards_data WHERE typename='$websitename' "); 
$result  = $query->fetch_assoc(); 
$rowCount= $result['rowNum']; 
 
// Initialize pagination class 
$pagConfig = array( 
    'baseURL' => $baseURL, 
    'totalRows' => $rowCount, 
    'perPage' => $limit, 
    'contentDiv' => 'commonCard', 
    'link_func' => 'searchFilter' 
); 
$pagination =  new Pagination($pagConfig); 
 
// Fetch records based on the limit 
$query = $conn->query("SELECT * FROM cards_data WHERE typename='$websitename' ORDER BY id ASC LIMIT $limit"); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" integrity="sha512-R+xPS2VPCAFvLRy+I4PgbwkWjw1z5B5gNDYgJN5LfzV4gGNeRQyVrY7Uk59rX+c8tzz63j8DeZPLqmXvBxj8pA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Pagination and search</h1>
    </div>
    <div class="search-panel">
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control" id="keywords" placeholder="Type keywords..." onkeyup="searchFilter();">
        </div>
        <div class="form-group col-md-4">
            <select class="form-control" id="filterBy" onchange="searchFilter();">
                <option value="">Sort by</option>
                <option value="cost">Cost</option>
                <option value="stars">Ratings</option>
                <!-- <option value="0">Temp</option> -->
            </select>
        </div>
    </div>
    </div>


    <script>
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;
        console.log(page_num);
        var keywords = $('#keywords').val();
        var filterBy = $('#filterBy').val();
        $.ajax({
            type: 'POST',
            url: 'getData.php',
            data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy+'&service_type=<?php echo $websitename ?>',
            success: function (html) {
                $('#dataContainer').html(html);
            }
        });
    }
</script>
    
<div class="datalist-wrapper">
    
    <!-- Data list container -->
    <div id="dataContainer">

        <div class="commonContainer">
                <?php 
                if($query->num_rows > 0){ $i=0; 
                    while($row = $query->fetch_assoc()){ $i++; 
                ?>
                    <div class="commonCard">
                        <img src="./assets/imgs/<?php echo $row['typename'].$row['count']; ?>.png" alt="img">
                        <div class="commonContent">
                            <p class="commonName"><?php echo $row['title']; ?></p>
                            <div class="stars">
                            <div class="stars-inner" style="width: <?php echo $row['stars']*20 ?>%;"></div>
                            </div>
                            <?php if($row['location']!=='none'){ ?>
                            <p class="location"> <i class="fa-solid fa-location-dot"></i> <?php echo $row['location']; ?> </p>
                            <?php } ?> 
                            <?php if($row['venueType']!=='none'){ ?>
                                <p class="type"><i class="fa-solid fa-hotel"></i> <?php echo $row['venueType']; ?></p>
                            <?php } ?>
                            <?php if($row['people_range']!=='none'){ ?>
                                <p class="range"><i class="fa-solid fa-people-group"></i> <?php echo $row['people_range']; ?></p>
                            <?php } ?>
                            <?php if($row['cost']!=0){ ?>
                                <p class="cost">$ <?php echo $row['cost']; ?></p>
                            <?php } ?>
                            </div>
                            <?php if($row['buy']==1){ ?>
                                <button class="commonBuy">BUY</button>
                            <?php } ?>
                            </div>
                <?php 
                    } 
                }else{ 
                    echo '<tr><td colspan="6">No records found...</td></tr>'; 
                } 
                ?>
            <!-- Display pagination links -->
        </div>
        <?php echo $pagination->createLinks(); ?>
    </div>
</div>

</body>
</html>