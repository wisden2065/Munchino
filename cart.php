<?php

    session_start();
    include('connect.php');

    // echo "i have clicked on a button whose id is ".$_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add to cart</title>
    <!--font awesome cdn-------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="cart.css">
    <link rel="shortcut icon" href="pictures/munchino-logo-3.png" type="image/x-icon">
    <link rel="import" href="index.html">
</head>
<body>

<?php
    if(isset($_SESSION['session-id'])){
        $session = $_SESSION['session-id'];
        $productId = $_GET['add_to_cart'];


    // Query to get user info from database with his session id
        $query = "SELECT * FROM users WHERE email = '$session'";
        $result = mysqli_query($connection, $query) or die("Error in getting user info");

        if($row = mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_array($result);
            $name = $user['firstName'];
            $profilePicture = $user['picture'];

                // create the cartList array
                if(!isset($_SESSION['cartList'])){
                    $_SESSION['cartList'] = [];
                }
            // check product clicked by the current user in session
                if(isset($_GET['add_to_cart'])){
                      
                    $query2 = "SELECT * FROM products WHERE id = $productId";
                    $result2 = mysqli_query($connection, $query2) or die("Error in getting products");
                    if($result2){
                        $product = mysqli_fetch_array($result2);
                        $productId = $product['id'];
                        $productName = $product['name'];
                        $productPrice = $product['price'];
                        $productPic = $product['image'];
                        $productUrl = "pic/".$productPic;
                        $availableQty = $product['quantity'];

                       
                        // function to push product to cartList
                        function addItemToCartList($productName, $productPrice, $productUrl, $productId){
                            // echo "The id of the clicked item is ".$productId;
                            // Add a product if cartList is empty
                            if(empty($_SESSION['cartList'])){
                                // echo "This cart is empty";
                                $_SESSION['cartList'] = array(
                                    array(
                                                "id" => $productId,
                                                "name" => $productName,
                                                "price" => $productPrice,
                                                "image" => $productUrl,
                                                "qty" => 1
                                    )    
                                   );
                            }
                            else{
                                // echo "The cart is not empty";
                                // That means the clicked product is either in the cartList or not

                                // make a query to get the index of the clicked item, if it is false, then it is not in the cart
                                foreach($_SESSION['cartList'] as $key => $product){
                                    if(is_array($product)){
                                        $index = $key;
                                        // print_r($index);
                                    }
                                }
                                if($_SESSION['cartList'][$index]['id'] == $productId){
                                    $_SESSION['cartList'][$index]['qty'] += 1;
                                }
                                else{
                                    echo "add...";
                                        $newProduct = array(
                                            "id" => $productId,
                                            "name" => $productName,
                                            "price" => $productPrice,
                                            "image" => $productUrl,
                                            "qty" => 1
                                        );
                                        array_push($_SESSION['cartList'], $newProduct);
    
                                    
                                }
                                
                                // print_r($_SESSION['cartList']);
                            }
                                
                                
                }
                // addItemToCartList function ends here

                addItemToCartList($productName, $productPrice, $productUrl, $productId);
            }

                    
        }
        else{
            // echo "Product query not successful";
        }
    }
    else{
        echo "Mysqli_num_rows() < 0";
    }
?>
        
<header>
    <a href="#" class="logo"><img src="pictures/munchino-logo-3.png" alt=""><p id="logo">Munchino</p></a>
        
    <nav class="navbar">
                <a class="bar" id="active" href="index.php">home</a> 
                <a class="bar" href="index.html#dishes">dishes</a> 
                <a class="bar" href="index.html#about">about</a> 
                <a class="bar" href="index.html#menu">menu</a> 
                <a class="bar" href="index.html#review">review</a> 
                <a class="bar" href="#">order</a> 
    </nav>
    
<div class="icons">
            <i class="fa-solid fa-list" id="menu-list-icon"></i>
            <i class="fas fa-search" id="search-icon"></i>
            <a href="cart.html" class="fas fa-shopping-cart" id="cart-icon"></a>
            <span id="cartTotal"><?php 
                if(count($_SESSION['cartList']) > 0){
                    echo count($_SESSION['cartList']);
                }else{
                    echo 0;
                }
            ?></span>
            <a href="signin.php" class=""><div class="profile"><img src="<?php echo "pic/$profilePicture"; ?>" alt=""></div></a>
            <a href="logout.php" class="fa-solid fa-right-from-bracket"></a>
            
</div>
        <form action="" id="search-form">
          <input type="search" placeholder="search here..." name="input" id="search-box">
          <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
          <label for="search-box"  class="fas fa-search" id="icon-searchProduct"></label>
          <i class="fas fa-times" id="close"></i>
      </form>
</header>

    <!--header section ends-->
        
    <!--Ad-to-cart section starts-->

    <section id="cart-section">
      
      <div class="cart-advert">
          <div class="signIn">
              <div id="cartTotal"> <h1></h1></div>
              <div class="user-signin"> <i class="fas fa-star"></i><span style="text-decoration: underline; cursor: pointer;" > <a href="signin.php">sign-in</a></span> to easily redeem Rewards and for faster checkout</div>
          </div>
          <div class="earnBack">
              <img  class="atm-image" src="images/card.png" alt="" style="height: 50px;">
              <div class="earn-text" style="width: 62%; font-size: smaller;">
                  <h3>Earn <span style="color: red;">$13.00</span> back</h3>
                  <p>in reward dollars on this purchase and 10% back in reward dollars on purchases at <b>Pay Pass credit card.</b> <span style="text-decoration: underline;">Learn more</span> or <span style="text-decoration: underline;">Apply now</span> <span style="text-decoration: underline;">See if you qualify</span></p>
              </div>
          </div>
          <div class="free"><p style="color: red;">All items in your cart marked Ships Free will ship FREE</p></div>
      </div>
      <div class="cart-head">
          <div>
              <p style = "color: #fff">Hello, <?php echo $name;?></p>
          </div>
          <H1 style="color: #fff;">Your Shopping Basket </H1> <a href=""><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 1 1-2 0V7H6a1 1 0 0 0-1 1L4 19.7A2 2 0 0 0 6 22h12c1 0 2-1 2-2.2L19 8c0-.5-.5-.9-1-.9h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 1 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
          </svg>
          </a>
      </div>  

<!-- Container for cartItems and cart summary -->
      <div class="cartBox" id ="cartBox">
            <div class="class-container-wrapper">
        <!-- cartItems starts here -->
           
<?php
        // display cartList to UI
        
    foreach($_SESSION['cartList'] as $key => $cart){
        global $index;
    
            ?>
                    <div class="cart-container">  
                        <div class="productImg"><img src="<?php echo $cart['image']?>" alt=""></div>
                            <div class="product-div">
                                <h3><?php echo $cart['name'] ?></h3>
                            </div>
                            <div class="price-per-qty">
                                <div class="price-wrapper">
                                    <p>Price/Qty</p>
                                    <span><i class="fas fa-naira-sign"><?php echo $cart['price'] ?></i></span>
                                </div>
                            </div>
                            <div class="remove-item">
                                <div class="del-wrapper">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="shop-cart">
                                <div class="cart-wrapper">
                                    <span class="add" >
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/></svg>  
                                    </span>
                                    <span id="amount"><?php echo $cart['qty'] ?></span>
                                    <span class="minus">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="sum">
                                <div class="sum-wrapper">
                                    <span><?php echo $productPrice ?></span>
                                </div>
                            </div>
                        </div>
           
     
            <?php
            echo "<br>";
            }
?>          </div>
                 
            
                
                
           
            <!-- cartItems ends here -->
            <!-- cart summary starts here -->
            <div class="cart-summary-wrapper">
                <div class="cart-summary">
                    <div class="summary-head">
                        <h3><i class="fa-solid fa-lock"></i> Cart Summary</h3>
                        <div class="summary-body">
                            <p>Merchandise:</p>
                            <span>$125.00</span>
                            <p>Est. Shipping & Handling: <i class="fa-solid fa-circle-info"></i> </p>
                            <span>$17.89</span>
                            <p style="color: red;"">Shipping Discount:</p>
                            <span style="color: red;">-$23.98</span>
                            <p>Est. Tax: <i class="fa-solid fa-circle-info"></i></p>
                            <span>$10.07</span>
                            <p style="text-decoration: underline; cursor: pointer;;">Estimated for 60540 <i class="fa-solid fa-angle-down"></i></p>
                        </div> <br>
                        <hr>
                        <div class="summary-body">
                            <h3>Est. Order Total:</h3> 
                            <span><h3>$304.08</h3></span>
                        </div>
                        <br>
                        <hr>
                        <h4>Apply a Promo Code</h4>
                        <p>Remove any spaces or dishes before hitting apply</p>
                        <input type="text" style="outline: solid 1.5px;"> <button style="border: solid 1px grey; padding: 4px 10px;">APPLY</button>
                        <br><br><br><hr>
                            <button href="logout.php" class="btn" style="display: block;">CHECKOUT NOW</button> <br>
                            <p>By continuing to Checkout, you are agreeing to our <span style="text-decoration: underline;">Terms of Use</span> and <span style="text-decoration: underline;">Privacy Policy</span></p>
                            <br><br>
                            <hr>
                            <br><br>
                        <div class="payPal">
                                <p>Or use other checkout methods:</p>
                            <div class="payPal-btn">
                                <button class="btn2"><img src="images/payPal.png" alt="" width="50px" height="30px"></button>
                                <button class="btn2"><img src="images/zelle.png" alt="" width="50px"></button>
                                <button class="btn2"><img src="images/shopify.png" alt="" width="50px" height="30px"></button>
                            </div>
                        </div>
                    </div>
                </div>
 
                
                <!-- car summary ends here -->
            </div>
            <!-- paper cutting div starts here -->
            <div class="to-cut">
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div>
                <div class="cut"></div> 
            </div>
          
          <!-- paper cutting div ends here -->
    </section>
    <hr>
    <div class="box" style="height: 300px;"></div>
    <section id="bottom-section">
      
    </section>
<?php
    }
    else{
        // echo "not found";
        header('location: logout.php');
    }

?>
     <!--header section starts-->
 


  <!------- script tag ==index.js  ---------------------->
  <script>
     function setStorage(){
        let cartBox = document.getElementById("cartBox");
        localStorage.setItem('container', cartBox);
     }
     setStorage();

    //  will this function be in the index.js script?
     function getStorage(){

     }

  </script>

</body>
</html>