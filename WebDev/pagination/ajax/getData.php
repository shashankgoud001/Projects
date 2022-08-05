<?php
if(isset($_POST['service_type'])){
    if(isset($_POST['page'])){ 
        include_once 'Pagination.class.php'; 
        require_once 'dbConfig.php'; 
        $baseURL = 'getData.php'; 
        $offset = !empty($_POST['page'])?$_POST['page']:0; 
        $limit = 2; 
        $temp = "SELECT * FROM cards_data WHERE typename='".$_POST['service_type']."'";
        $temp_query = $conn->query($temp);
        $temp_row = $temp_query->fetch_assoc();
        $whereSQL = " WHERE typename='".$_POST['service_type']."'";
        if(!empty($_POST['keywords'])){ 
            $temp_count = 0;

            if($temp_row['title']!=='none'){
                $whereSQL .= " AND ( title LIKE '%".$_POST['keywords']."%' ";
                $temp_count = 1;
            }

            if($temp_row['location']!=='none'){
                if($temp_count==0){
                    $whereSQL .= " AND ( ";
                }else{
                    $whereSQL .= " OR ";
                }
                $whereSQL .= " location LIKE '%".$_POST['keywords']."%' ";
                $temp_count = 1;
            }
            if($temp_row['venueType']!=='none'){
                if($temp_count==0){
                    $whereSQL .= " AND ( ";
                }
                else{
                    $whereSQL .= " OR ";
                }
                $whereSQL .= " venueType LIKE '%".$_POST['keywords']."%' ";
                $temp_count = 1;
            }
            if($temp_count==1)
                $whereSQL .= ") "; 
        } 
        // $whereSQL .= " ORDER BY id ASC LIMIT $offset,$limit ";
        if(isset($_POST['filterBy']) && $_POST['filterBy'] != ''){ 
            $whereSQL .= " ORDER BY  ".$_POST['filterBy'];
            if($_POST['filterBy']==='cost'){
                $whereSQL .= " ASC ";
            }else{
                $whereSQL .= " DESC ";
            }
        }

        // Count of all records 
        $query   = $conn->query("SELECT COUNT(*) as rowNum FROM cards_data ".$whereSQL); 
        $result  = $query->fetch_assoc(); 
        $rowCount= $result['rowNum']; 
        
        // Initialize pagination class 
        $pagConfig = array( 
            'baseURL' => $baseURL, 
            'totalRows' => $rowCount, 
            'perPage' => $limit, 
            'currentPage' => $offset, 
            'contentDiv' => 'dataContainer', 
            'link_func' => 'searchFilter' 
        ); 
        $pagination =  new Pagination($pagConfig); 
    
        // Fetch records based on the offset and limit
        echo  "SELECT * FROM cards_data $whereSQL LIMIT $offset,$limit" ;
        $query = $conn->query("SELECT * FROM cards_data $whereSQL LIMIT $offset,$limit "); 
?> 
        <div class="commonContainer">
            <?php 
            if($query->num_rows > 0){ 
                while($row = $query->fetch_assoc()){ 
                    $offset++ 
            ?> 
            <div class="commonCard">
                <img src="./assets/imgs/<?php echo $row['typename'].$row['count']; ?>.png" alt="img">
                <div class="commonContent">
                    <p class="commonName"><?php echo $row['title']; ?></p>
                    <div class="stars">
                    <div class="stars-inner" style="width: <?php echo $row['stars']*20 ?>%;" ></div>
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
            } 
            ?> 

        </div>

        
        <!-- Display pagination links --> 
        <?php echo $pagination->createLinks(); ?> 
<?php 
    } 
}
?>