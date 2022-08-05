<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- including CSS -->
     <link rel="stylesheet" href="css/Style.css">
     <!-- including font-awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
     
     <!-- Including -->
     <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
     
     <!-- including JS -->
     <script src="js/script.js"></script>
 
     <title>Happy Wedding</title>

</head>
<body>
    <div class="front">

        <h1>Contact</h1>
        <div class="container-contact-1">
            <div class="box">
                <i class="fa-solid fa-phone"> </i> 
                <p>Phone : +91-9876543210</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-envelope"> </i> 
                <p>Email : happywedding@gmail.com</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-location-dot"> </i>
                <p> Address : Suraj Towers,<br> Miyapur, Hyderabad, India.</p>
            </div>
    
        </div>
        <div class="container-contact-2">
            <form action="./includes/connect.php" method="post">
                <div class="box-out">
                    <div class="box">
        
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name">
            
                        <label for="email" >Email</label>
                        <input type="text" id="email" name="email" placeholder="Your Email">
            
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" placeholder="Your Phone Number">
                        
                    </div>
                    <div class="box">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" placeholder="Message" ></textarea>
                    </div>
                </div>
                <input type="submit" name="Submit" value="Submit">
            </form>
        </div>
    </div> 
</body>
</html>