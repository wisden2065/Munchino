<?php
    session_start();
    include('connect.php');
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
<!-- testing the new cartList received from the fetch function -->
<?php

    // $dhdcart = json_encode(cartList);
    // print_r($cart);
?>
<?php
// if a user is in a session then we proceed to display the cart page
if(isset($_SESSION['session-id'])){
        $session = $_SESSION['session-id'];
        // print_r($cartList);
    // Query database to get all user info from the database with his session id
        $query = "SELECT * FROM users WHERE email = '$session'";
        $result = mysqli_query($connection, $query) or die("Error in getting user info");

        if($row = mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_array($result);
            $name = $user['firstName'];
            $profilePicture = $user['picture'];


                // create an empty List for all his cartItems if not exist
                if(!isset($_SESSION['cartList'])){
                    $_SESSION['cartList'] = [];
                    // $_SESSION['cartList']['totalPrice'] = 0;
                    
                }
                // sets the variable the will hold the totalProduct amount in the session sgv so we can access it anywhere and in the js script 
                // when we access it in the js script, we can update it to the server after there has been an increment on a particular product 
                if(!isset($_SESSION['totalProduct_price'])){
                    $_SESSION['totalProduct_price'] = 0;
                }
                // initialize an empty element for the totalPrice
                foreach($_SESSION['cartList'] as $key => $eachProduct){
                    $index = $key;
                }
                // when he wants to add an item to his list we want to get the item clicked details from the database
            if(isset($_GET['add_to_cart'])){
                    $clickedProductId = $_GET['add_to_cart'];
                    // make a query to fetch product from database
                    $query2 = "SELECT * FROM products WHERE id = $clickedProductId";
                    $result2 = mysqli_query($connection, $query2) or die("Error in getting products");
                    if($result2){
                        $product = mysqli_fetch_array($result2);
                        $productId = $product['id'];
                        $productName = $product['name'];
                        $productPrice = $product['price'];
                        $productPic = $product['image'];
                        $productUrl = "pic/".$productPic;
                        $availableQty = $product['quantity'];
                       
                        // after getting the item, we add it to his list
                function addItemToCartList($productName, $productPrice, $productUrl, $productId){
                            global $index;

                            // we check if this item is the first product or he already has an item to the cart
                            if(empty($_SESSION['cartList'])){
                                echo "This cart is empty";
                                echo "The product id is".$productId;
                                // echo "The totalProduct is :". $_SESSION['totalProduct_price']. "<br>";
                                $product =  array(
                                    "id" => $productId,
                                    "name" => $productName,
                                    "price" => $productPrice,
                                    "image" => $productUrl,
                                    "qty" => 1,
                                    // add a variable that will account for totalPrice of the products in the cart
                                    // "totalPrice" => 0
                                    // this totalPrice will be updated with Js with user addition of productsQty with the totalAmount
                                );
                                array_push($_SESSION['cartList'], $product);
                                print_r($_SESSION['cartList']);

                            }
                            else{  //if the list is not empty, then the item he wants might be in his list or not
                                echo "The cart is not empty";
                                echo "The product id is".$productId;
                                // we create a list of the id_s of all the items in his list to know if the new item is there or not
                                    $array_ids = array_column($_SESSION['cartList'], "id");
                                    print_r($array_ids);
                                    // check if the new item he wants to add is in the list by checking if the id is in the id list of all items in his list
                                    if(in_array($productId, $array_ids)){
                                        // if the item is there, we increase the item quantity
                                        foreach($_SESSION['cartList'] as $key => $eachProduct){
                                            $index = $key;
                                            if($eachProduct['id'] == $productId){
                                                $_SESSION['cartList'][$index]['qty'] += 1;
                                            }
                                        }
                                        echo "The product is in the cart";
                                        // print_r($_SESSION['cartList'][$index]);
                                    }
                                    else{ //if not we add the new item to his list with a quantity of 1
                                        echo "In the else block";
                                        // the clicked item is not in the cart so we push it into cartList
                                        print_r($_SESSION['cartList'][$index]);
                                        $newProduct = array(
                                            "id" => $productId,
                                            "name" => $productName,
                                            "price" => $productPrice,
                                            "image" => $productUrl,
                                            "qty" => 1,
                                        );
                                        array_push($_SESSION['cartList'], $newProduct);
                                    }
                                print_r($_SESSION['cartList']);
                            }
                }
                // addItemToCartList function ends here

                addItemToCartList($productName, $productPrice, $productUrl, $productId);
            }
            // use adding an item ends here
                    
        }
        else{
            // echo "Product query not successful";
        }
    }
    else{
        echo "Mysqli_num_rows() < 0";
    }
?>
<?php
//fetch.php
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
          <H1 style="color: #fff;"><?php if(empty($_SESSION['cartList'])){echo "Oops! nothing in your Basket";}else{echo "Your Shopping Basket";}  ?> </H1> <a href=""><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 1 1-2 0V7H6a1 1 0 0 0-1 1L4 19.7A2 2 0 0 0 6 22h12c1 0 2-1 2-2.2L19 8c0-.5-.5-.9-1-.9h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 1 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
          </svg>
          </a>
      </div>  

<!-- Container for cart-container-wrapper which contains cart-container/cartItems and cart summary -->
      <div class="cartBox" id ="cartBox">
            <?php
                    if(empty($_SESSION['cartList'])){ //we do not want to show anything in the cartBox except the 
                    echo "<div style='display: flex; justify-contents: center; align-items:center; height: 200px; width: 200px' ><img src='pic/emptycart.png'; ></div>";
                    }
                    else{  //display the cartItems and the summary
                        ?>
                            <div id="cart-container-wrapper">
                            <!-- cartItems starts here -->
                                <?php
                                    foreach($_SESSION['cartList'] as $key => $cart){
                                        global $index;
                                            ?>
                                            <div class="cart-container"  id="<?php echo $_SESSION['cartList'][$key]['id']?>">  
                                                <div class="productImg"><img src="<?php echo $cart['image']?>" alt=""></div>
                                                    <div class="product-div">
                                                        <h3><?php echo $_SESSION['cartList'][$key]['name'] ?></h3>
                                                    </div>
                                                    <div class="price-per-qty">
                                                        <div class="price-wrapper">
                                                            <p>Price/Qty</p>
                                                            <span><i class="fas fa-naira-sign"><?php echo $_SESSION['cartList'][$key]['price'] ?></i></span>
                                                        </div>
                                                    </div>      
                                                    <!-- pass the id of the cartItem to the delBtn -->
                                                    <div class="remove-item" id="">
                                                        <!-- wrapping the del btn in an a tag to link it with delete.php -->
                                                        <a href="delete.php?prod_id=<?php echo $_SESSION['cartList'][$key]['id']; ?>">
                                                            <div class="del-wrapper delBtn" id="">
                                                                <svg  id="" class="w-6 h-6 text-gray-800 dark:text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <path id="" stroke="currentColor" class="del" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="shop-cart">
                                                        <div class="cart-wrapper">
                                                            <span id="subBtn" class="minus" >
                                                                <svg id="sub" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <path id="sub" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/></svg>  
                                                            </span>
                                                            <!-- pass each button unique id from the productId when clicked -->
                                                            <span id="count" style=" font-weight: 1000; font-size:large;">
                                                                <?php echo $_SESSION['cartList'][$key]['qty'] ?>
                                                            </span>
                                                            <span id="addBtn" class="add">
                                                                <svg id="add" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <path id= "add" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="sum">
                                                        <div class="sum-wrapper">
                                                            <span id="productAmount"><?php echo ($_SESSION['cartList'][$key]['price'] * $_SESSION['cartList'][$key]['qty']); ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            echo "<br>";
                                            }
                                    ?>    
                            <!-- cartItems ends here -->
                            </div>
                            <!-- cart summary starts here -->
                            <div class="cart-summary-wrapper">
                                <div class="cart-summary">
                                    <div class="summary-head">
                                        <h3><i class="fa-solid fa-lock"></i> Cart Summary</h3>
                                        <div class="summary-body">
                                            <p>Merchandise:</p>
                                            <span id="merchandise">$<?php echo $_SESSION['totalProduct_price']; ?></span>
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
                                
                            <!-- cart summary ends here -->
                        </div>
                        <?php  
                    }

            ?>

           
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
 
   

  <!------- script tag == cart.js  ---------------------->
  <script src="cart.js"></script>
  <script>
        //check for Navigation Timing API support
        if (window.performance) {
        console.info("window.performance works fine on this browser");
            
        }
        console.info(performance.navigation.type);
        if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        console.info( "This page is reloaded" );
        } else {
        console.info( "This page is not reloaded");
}

    // use json_encode to get the cartList array in the php script as a JSON in js
    // we will need to modify the product quantity whwn a user clicks an add or sub button on any of the products in the cartList
    let cartList = <?php echo json_encode($_SESSION['cartList']); ?>;

    // initialize a variable that would hold the value of all the products in the cartList and store it in the the session sgv available in the this script
    // so it will reflect in the php script
    let totalProdPrice = <?php echo json_encode($_SESSION['totalProduct_price']) ?>;

    // initialize a variable that would hold the value, which is an array of the HTMLspanElements that holds each products quantity
    // the essence is to loop through it so we can modify the innerHTML of each HTMLspanElement for each product as the add/sub btn is clicked
    let productCount = document.querySelectorAll("#count");
    console.log(productCount);  //contains a NodeList of HTMLspanElements depending on the number of products in the cartList.
    
    // get the container that would hold all the items in the cart. 
    // we can then perform operations like looping through it, since it would serve as our array of products
    let cartContainer = document.getElementById("cart-container-wrapper");
        console.log("Hello ", cartContainer);

        // Target the add, sub, del btn, make a function that handles each of their functionalities
        // using event bubbling, target parent which is the main container, then the children subsequently
        cartContainer.addEventListener("click", (eventObj)=>{
           console.log(eventObj);
           console.log(eventObj.target.id);
           console.log(eventObj.target.tagName);

            // if the area clicked within the cart container is an addButton, we make a product increment
           if(eventObj.target.tagName == 'SPAN' && eventObj.target.id == "addBtn"|| eventObj.target.tagName == 'svg' && eventObj.target.id =="add" || eventObj.target.tagName == 'path' && eventObj.target.id =="add"){

                    console.log("Increase Product count");
                    console.log(eventObj.target);  //span Element
                    let clickedElement = eventObj.target;
                    let parent_id;
 
                    // using an if statement because the clicked initial target element might be the svg and not the span element
                    if(clickedElement.tagName == 'SPAN'){
                        parent = clickedElement.parentElement.parentElement.parentElement;
                        console.log("The clicked Element is a span tag");
                    }
                    else if(clickedElement.tagName == 'svg'){
                        parent = clickedElement.parentElement.parentElement.parentElement.parentElement;
                        console.log("The clicked Element is an svg tag");
                    }
                    else if(clickedElement.tagName == 'path'){
                        parent = clickedElement.parentElement.parentElement.parentElement.parentElement.parentElement;
                        console.log("The clicked Element is a path tag");
                    }
                    else{
                        console.log("undefined tag name clicked");
                    }
                    // log out the parent id
                    clickedProd_id = parent.id;  //here we have gotten the id of the clicked element

                    // at this point we only know the product id. So with this id we can know which of the exact product that its add btn was clicked
                    // loop through the cartList to find product whose id == clickedItem Id and increment
                    cartList.forEach((product, pIndex)=>{
                        // check which particular product in our cartList where its id matches the id of the product that was clicked
                        if(clickedProd_id == product.id){
                            // when we get that product, we increase its own quantity by targeting its own HTMLspanElement in the NodeList 
                            // loop through the nodeList and increment its innerHTML. The nodeList serves as the array of all our span Element which hold the value for the product quantity
                            productCount.forEach((node, nIndex)=>{
                                if(pIndex == nIndex){
                                    // increase the product by its nideIndex to reflect innerHTML
                                    node.innerHTML ++;
                                    // increase the product count in js script so i can get it in the cartList array 
                                    cartList[pIndex].qty ++;
                                    // call the function to update cart summary
                                    updateTotalProdPrice(); 
                                    // call the function to save this local change in the cartList
                                    updateProductSession();

                                }
                            })
                        }
                       
                        // this should log the cartList array with the new product count made by clicking the add btn
                        // console.log(cartList);
                    })
                   
           }
        //    Target the subButton and made a decrement
           else if(eventObj.target.tagName == 'SPAN'  && eventObj.target.id == "subBtn"  || eventObj.target.tagName == 'svg' && eventObj.target.id == "sub" || eventObj.target.tagName == 'path' && eventObj.target.id == "sub" ){
                console.log("Decrease Product count");
                // productCount.innerHTML --;
                let clickedElement = eventObj.target;
                    let parent;
                    let parent_id;
 
                    // using an if statement because the clicked initial target element might be the svg and not the span element
                    if(clickedElement.tagName == 'SPAN'){
                        parent = clickedElement.parentElement.parentElement.parentElement;
                        console.log("The clicked Element is a span tag");
                    }
                    else if(clickedElement.tagName == 'svg'){
                        parent = clickedElement.parentElement.parentElement.parentElement.parentElement;
                        console.log("The clicked Element is an svg tag");
                    }
                    else if(clickedElement.tagName == 'path'){
                        parent = clickedElement.parentElement.parentElement.parentElement.parentElement.parentElement;
                        console.log("The clicked Element is a path tag");
                    }
                    else{
                        console.log("undefined tag name clicked");
                    }
                    // log out the parent id
                    clickedProd_id = parent.id;  //here we have gotten the id of the clicked element

                    // loop through the cartList to find product whose id == clickedItem Id and increment
                    cartList.forEach((product, pIndex)=>{
                        // check which element was clicked in the list
                        if(clickedProd_id == product.id){
                            // loop through the nodeList and increment its innerHTML. The nodeList serves as the array of all our span Element which hold the value fpr the product quantity
                            productCount.forEach((node, nIndex)=>{
                                if(pIndex == nIndex){
                                     // increase the product by its nideIndex to reflect innerHTML
                                    node.innerHTML --;
                                    // increase the product count in js script so i can get it in the cartList array 
                                    cartList[pIndex].qty --;
                                    // call the function that will update the individual product amountTotal in the HTMLspanELement
                                    updateProductAmount();
                                    // call the function to update cart summary
                                    updateTotalProdPrice();
                                    // call the function to save this local change in the cartList
                                    updateProductSession();
                                }
                            })
                        }
                    })
                    console.log(cartList);
           }
        //    target the delete button and remove productItem from cartList
           else if(eventObj.target.tagName == 'DIV' && event.target.classList.contains("delBtn") || eventObj.target.tagName == 'svg' && event.target.classList.contains("del") || event.target.tagName == 'path' && event.classList.contains("del")){
                console.log("delete button");
                // get the clickedItem
           }
           else{
                console.log("this is not a button");
           }
        })

        

// define a function that will UPDATE the cartList when the add or sub button of any product is clicked
function updateProductSession(){
    // This fetch call makes an update to the cartList in the Session sgv
    fetch("fetch.php", 
    {
        method : "PUT",
        headers : {
            "Content-Type" : "application/json",
        },
        body : JSON.stringify({cartList}), //in this request body, we converts the cartList array to one long string-JSON
    })  //after we call the fetch api it returns with a response which is a promise object
    .then((response)=>{
        if(!response.ok){
            console.log("Error");
        }
        else{  // if the reolved data from the promise is successful we want to do something with that data
            console.log("The raw response is :", response);  //This res is the response object
            return response.json();   // in our case, we want to convert it to a json format. This also returns a promise
        }
    })
    .then((data)=>{  //data here is the response that is sent back by the server
        console.log("The response data : ", data);
        return data;
    })
  
    
}

// define a function to update cartSummary


// make a function that would calculate the accumulated cost of all items in the cartList
    function updateTotalProdPrice(){
        // the total value of the items in the cart would be stored in a variable called total
        let total = cartList.reduce((currentTotal, product)=>{
                return ((product.price * product.qty) + currentTotal);
        }, 0)

     //   After we get this total value, we would want to update the value by calling this function whenever a new item is added/deleted from the cartList
        console.log("This total ", total);
    //   then call the function fetch to update this local change to the session sgv
        console.log(totalProdPrice); //the totalProdPrice holds the value of the total product amount but was initialized to zero and initialized at top of script
        // set the session sgv holding the total to the current total
        totalProdPrice = total;
        console.log("The new total in session sgv :", totalProdPrice);
        // updateProductSession();

    }


// get a nodeList of all th HTMLspanElement that holds the value of the total of each product.
    let total_product_amount = document.querySelectorAll("#productAmount");
    console.log("The total product amount is ", total_product_amount);

    // function definition to update product amount
    function updateProductAmount(){
        // loop through the cartList to know the product we want to update its amount
        cartList.forEach((product, pIndex)=>{
            //loop through the nodeList of spn elements conatining the total for each product
            // make total logic where nodeList index matches the product index
            total_product_amount.forEach((node, nIndex) => {
                if(nIdex == pIndex){
                    console.log("asdf");
                    console.log(product.index.price);
                }
            })

        })
    }
    // add an event listener to the cart_head to see cart-summary
    let cartHead = document.querySelector(".cart-head");
    cartHead.addEventListener("click", ()=>{
        console.log("I want to see the cart_summary");
        console.log("The total product price is ", totalProdPrice);
        updateCartSummary()
    })
  </script>

</body>
</html>