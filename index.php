<?php
session_start();

include('connect.php');



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Munchino</title>

<!--swiper cdn link-->    
<link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<!--font awsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--custom css file link--> 
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="pictures/munchino-logo-3.png" type="image/x-icon">
</head>

<body>

<?php
    if(isset($_SESSION['session-id'])){
        $session = $_SESSION['session-id'];

        $query = "SELECT * FROM users WHERE email = '$session'";
        $result = mysqli_query($connection, $query) or die("Error");
        if($row = mysqli_num_rows($result) > 0){
            $userField = mysqli_fetch_array($result);
            $name = $userField['firstName'];
            $profilePicture = $userField['picture'];

            
        }
        else{
            // echo "Else block";
        }

        $productQuery = "SELECT * FROM products";   //order by rand() limit 0,8 to fetch products at random
        $productResult = mysqli_query($connection, $productQuery) or die('Error in completing query');
            
        // echo mysqli_num_rows($productResult);
        $arr = mysqli_fetch_array($productResult);
        // print_r($arr);


?>
   
    <!--header section starts-->
    <header>
        <a href="#" class="logo"><img src="pictures/munchino-logo-3.png" alt=""><p id="logo">Munchino</p></a>
        
        <nav class="navbar">
                <a  class="active" href="index.php">home</a> 
                <a  href="#dishes">dishes</a> 
                <a  href="#about">about</a> 
                <a  href="#menu">menu</a> 
                <a  href="#review">review</a> 
                <a  href="#order">order</a> 
        </nav>
    
        <div class="icons">
            <i class="fa-solid fa-list" id="menu-list-icon"></i>
            <i class="fas fa-search" id="search-icon"></i>
            <span>0</span>
            <a href="cart.php" target="blank" class="fas fa-shopping-cart" id="cart-icon"></a>
            <a href="signin.php" class=""><div class="profile dropdown"><img src="<?php echo "pic/$profilePicture"; ?>" alt=""></div></a>
            <a href="logout.php" class="fa-solid fa-right-from-bracket"></a>
        </div>

    </header>

    <!--header section ends-->

<!---------- Search form--------------------------------------------- -->

<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="input" id="search-box">
    <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
    <label for="search-box"  class="fas fa-search" id="icon-searchProduct"></label>
    <i class="fas fa-times" id="close"></i>
</form>
<!--------search form ends here---------------------------------------------------->

<!---------cart form ends here------------------------------------------------->
<!--Ref @ cart.html-->

<!--cart form ends here-->

<!--Home section starts here-->
<section class="home" id="home" >
    <div class="hero-section"></div>
    
    <div class="home-carousel swiper">
        <div class="wrapper swiper-wrapper">
            <div class="slide swiper-slide">
                <div class="content">
                    <span>Our special dish</span>
                    <h3>Noodles</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo minus beatae perferendis.</p>
                    <a href="#"  class="btn food">order now</a>
                </div>
                <div class="image">
                    <img src="pictures/home-img-2.png" loading="lazy" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Our special dish</span>
                    <h3>Grilled Turkey</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, quod?</p>
                    <a href="#"  class="btn food">order now</a>
                </div>
                <div class="image">
                    <img src="pictures/home-img-4.png" loading="lazy " alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Our special dish</span>
                    <h3>Rasp Salad</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, alias.</p>
                    <a href="#"  class="btn food">order now</a>
                </div>
                <div class="image">
                    <img src="pictures/home-img-8.png" alt="" >
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Our special dish</span>
                    <h3>Spiced Chicken</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, facere!</p>
                    <a href="#"  class="btn food">order now</a>
                </div>
                <div class="image">
                    <img src="pictures/home-img-7.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Our special dish</span>
                    <h3>Tasty Burger</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, tempora!</p>
                    <a href="#"  class="btn food">order now</a>
                </div>
                <div class="image">
                    <img src="pictures/home-img-5.png" alt="">
                </div>
            </div>
            
        </div>
        <!-- swiper pagination -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <!-- swiper buttons -->
    </div>
    
   
    
</section>

<!--Home section ends here-->
<!--Dishes section starts here-->
<section class="dishes" id="dishes">
    <h3 class="sub-heading">our dishes</h3>
    <h1 class="heading">popular dishes</h1>
    <div class="box-container" id="dishes-container">

<?php
        mysqli_data_seek($productResult, 0);
        while($array = mysqli_fetch_array($productResult)){
            $image = $array["image"];
            $path = "pic/";
            $pathUrl = $path.$image;

?>
    
        <!-- items formerly populated with dishes.json @ index.js -->
        <div class="box" id="<?php echo $array['id'] ?>">
            <img src="<?php echo $pathUrl; ?>" alt="Image not available">
                    <div class="content">
                        <h3><?php echo $array['name'] ?></h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    <div>
            <span><i class="fas fa-naira-sign"><?php echo $array['price'] ?></i></span> 
            <a href="cart.php?add_to_cart=<?php echo $array['id'] ?>" class="btn" id="<?php echo $array['id']; ?>" target ="blank">Add to cart</a>
            </div>
        </div>
    </div>
   
<?php
}
?>
</div>

        
</section>
<!--Dishes section ends here-->

<!--About section starts here-->

<section class="about" id="about">
    <h3 class="sub-heading">Munchino</h3>
    <h1 class="heading">About us</h1>

    <div class="row">

        <div class="image">
            <img src="pictures/about2.avif" alt="">
        </div>

        <div class="content">
            <h3>tasty foods delivered to your doorstep</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe praesentium, placeat fugit amet explicabo repudiandae suscipit dicta aspernatur laudantium ut velit omnis quo culpa quidem rerum quibusdam commodi enim dolor.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, minus tempora corrupti fugiat atque sunt magnam tempore delectus hic, earum molestias rem veritatis!</p>

            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>free delivery</span>
                </div>
                <div class="icons">
                    <i class="fas fa-naira-sign"></i>
                    <span>easy payment</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 service</span>
                </div>
                
            </div>
            <a href="#" class="btn">learn more</a>
        </div>
    </div>
</section>

<!--About section ends here-->


<!------------------------Menu section starts here----------------------------------------------------------------------------------------------------------->

<section class="menu"  id="menu">
    <div class="head">
        <h3 class="sub-heading">Our menu</h3>
        <h1 class="heading">Today's Delicay</h1>
    </div>

    <div id="box-container">
        <!-- Populated with menu.json @ index.js  -->
    </div>

</section>

<!--Menu section ends here-->


<!--review section ends here-->
<section  class="review"  id="review">

    <h3 class="sub-heading">Customer's review</h3>
    <h1 class="heading">what they say about us</h1>

    <div class="review-container swiper">

        <div class="review-wrapper swiper-wrapper">
            <div class="review-slide swiper-slide">
                <div class="user">
                    <img src="pictures/testimonial-1.jpg" class="review-image">
                    <div class="user-info">
                        <h1>Olu Johnson</h3>
                        <p>4 reviews</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                        <p>2 months ago</p>
                        <div class="comment">
                            <h3>Verified customer</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="review-slide swiper-slide">
                <div class="user">
                    <img src="pictures/testimonial-2.jpg" class="review-image">
                    <div class="user-info">
                        <h1>Olu Johnson</h3>
                        <p>4 reviews</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                        <p>2 months ago</p>
                        <div class="comment">
                            <h3>Verified customer</h3>
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="review-slide swiper-slide">
                <div class="user">
                    <img src="pictures/testimonial-3.jpeg" class="review-image">
                    <div class="user-info">
                        <h1>Olu Johnson</h3>
                        <p>4 reviews</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                        <p>2 months ago</p>
                        <div class="comment">
                            <h3>Verified customer</h3>
                            <p>Lorem, ipsum dolor.</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="review-slide swiper-slide">
                <div class="user">
                    <img src="pictures/testimonial-4.jpg" class="review-image">
                    <div class="user-info">
                        <h1>Akaeruo Becca</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                        <p>2 months ago</p>
                        <div class="comment">
                            <h3>Verified customer</h3>
                            <p>Lorem ipsum, dolor sit amet consectetur.</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="review-slide swiper-slide">
                <div class="user">
                    <img src="pictures/testimonial-5.jpeg" class="review-image">
                    <div class="user-info">
                        <h1>Olu Johnson</h3>
                        <p>4 reviews</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                        <p>2 months ago</p>
                        <div class="comment">
                            <h3>Verified customer</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            
    

        </div>
    </div>

</section>

<!--review section ends here-->

<!--order section starts here-->

<section class="order" id="order">
    <div class="order-content">
        <h3 class="sub-heading">Delivered to your doorstep</h3>
        <h1 class="heading">free and fast</h1>
    </div>
    <form action="" class="myForm">

        <div class="inputBox">
            <div class="input">
                <span>your name</span>
                <input placeholder="enter your name" type="text" name="inputBox" id="">
            </div>
            <div class="input">
                <span>your phone number</span>
                <input placeholder="enter your phone number" type="number" name="inputBox" id="">
            </div>
        </div>

        <div class="inputBox">
            <div class="input">
                <span>Add an order description</span>
                <input placeholder="enter your order" type="text" name="inputBox" id="">
            </div>
           
        </div>

       <div class="inputBox">
            <div class="input">
                <span>your name</span>
                <input placeholder="enter quantity of order" type="number" name="inputBox" id="">
            </div>
            <div class="input">
                <span>date and time</span>
                <input placeholder="enter your phone number" type="datetime-local" name="inputBox" id="">
            </div>
        </div>

       <div class="inputBox">
        <div class="input">
            <span>your address</span>
           <textarea name="address" id="" rows="4"></textarea>
        </div>
        <div class="input">
            <span>Additional information</span>
            <textarea name="extra-info" id=""  rows="4"></textarea>
            
        </div>
        </div>
        <div class="btnWrapper">
            <input type="submit" value="order now" class="btn">
        </div>
    
    </form>


</section>

<!--order section ends here-->


<!--footer section starts here-->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>locations</h3>
            <a href="#">Portharcourt</a>
            <a href="#">Abujart</a>
            <a href="#">Lagos</a>
            <a href="#">Asaba</a>
            <a href="#">Awka</a>
            <a href="#">Benin</a>
            <a href="#">Owerri</a>
            <a href="#">Abeokuta</a>
        </div>

        <div class="box">
            <h3>Quick links</h3>
            <a href="#">home</a>
            <a href="#">dishes</a>
            <a href="#">about</a>
            <a href="#">menu</a>
            <a href="#">review</a>
            <a href="#">order</a>
        </div>
        <div class="box">
            <h3>contact info</h3>
            <a href="#">+123-456-7890</a>
            <a href="#">+123-456-7890</a>
            <a href="#">abc@email.com</a>
            <a href="#">+123-456-7890</a>
        </div>
        <div class="box">
            <h3>follow us</h3>
            <a href="#">facebook</a>
            <a href="#">twitter</a>
            <a href="#">instagra</a>
        </div>
    </div>
    <div class="credit"> copyright @ 2024 by <span> Nnanyereugo</span></div>
</section>
<!--footer section ends here-->
<div class="cartDiv"></div>

<!--swiper script link-->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- custom js file link -->
<script src="index.js" ></script>

<!-----Add-to-cart script link-->

<!-- <script src="cart.js"></script> -->
<?php
    }
    else{
        // echo "not found";
        header('location: logout.php');
    }

?>
    
</body>
</html>