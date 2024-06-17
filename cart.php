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

    // $cart = json_encode(cartList);
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
                }

                foreach($_SESSION['cartList'] as $key => $eachProduct){
                    $index = $key;
                }
                // when he wants to add an item to his list we want to get the item clicked details from the database
            if(isset($_GET['add_to_cart'])){
                    $clickedProductId = $_GET['add_to_cart'];
                    
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

                                $product =  array(
                                    "id" => $productId,
                                    "name" => $productName,
                                    "price" => $productPrice,
                                    "image" => $productUrl,
                                    "qty" => 1
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
                                            "qty" => 1
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
          <H1 style="color: #fff;">Your Shopping Basket </H1> <a href=""><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 1 1-2 0V7H6a1 1 0 0 0-1 1L4 19.7A2 2 0 0 0 6 22h12c1 0 2-1 2-2.2L19 8c0-.5-.5-.9-1-.9h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 1 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
          </svg>
          </a>
      </div>  

<!-- Container for cartItems and cart summary -->
      <div class="cartBox" id ="cartBox">
            <div id="cart-container-wrapper">
        <!-- cartItems starts here -->
           
<?php
    if(empty($_SESSION['cartList'])){
        echo "<img src='pic/emptycart.png'; style='display: flex; justify-contents: center; align-items:center'>";
    }
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
                                    <span><?php echo $_SESSION['cartList'][$key]['price'] ?></span>
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

    // use json_encode to access the cartList in the php script as a JSON in js
    let cartList = <?php echo json_encode($_SESSION['cartList']); ?>;
    console.log(cartList);
    let productCount = document.querySelectorAll("#count");
    console.log(productCount);
        let cartContainer = document.getElementById("cart-container-wrapper");
        console.log("Hello ", cartContainer);

        // using event bubbling, target parent to capture and add an event listener to the children
        cartContainer.addEventListener("click", (eventObj)=>{
           console.log(eventObj);
           console.log(eventObj.target.id);
           console.log(eventObj.target.tagName);

            // target the addButton and make product increment
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

                    // loop through the cartList to find product whose id == clickedItem Id and increment
                    cartList.forEach((product, pIndex)=>{
                        // check which element was clicked in the list
                        if(clickedProd_id == product.id){
                            // loop through the nodeList and increment its innerHTML. The nodeList serves as the array of all our span Element which hold the value fpr the product quantity
                            productCount.forEach((node, nIndex)=>{
                                if(pIndex == nIndex){
                                    // increase the product by its nideIndex to reflect innerHTML
                                    node.innerHTML ++;
                                    // increase the product count in js script so i can get it in the cartList array 
                                    cartList[pIndex].qty ++;
                                    // call the function to save this local change in the cartList
                                    updateProductQty();

                                }
                            })
                        }
                       
                        // this should log the cartList array with the new product count 
                        console.log(cartList);
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
                                    // call the function to save this local change in the cartList
                                    updateProductQty();
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
                let clickedProd;
                if(eventObj.target.tagName == 'svg'){
                    clickedProd = eventObj.target.parentElement.parentElement.parentElement;
                    console.log(clickedProd);
                }
                else if(eventObj.target.tagName == 'DIV'){
                    clickedProd = eventObj.target.parentElement.parentElement;
                    console.log(clickedProd);
                }
                // get the id of the clickedItem
                let clickedProd_id = clickedProd.id;
                console.log(clickedProd_id);
                
                // loop through the carList and delete cartItem where the button was clicked
                cartList.forEach((product, index)=>{
                    // console.log(index, "=>", product);
                    if(product.id == clickedProd_id){
                        //delete product where its Id matches that of the clickedProd_id matches
                        console.log(product); 
                        console.log(index);
                        cartList.splice(1, index);
                        console.log("Product at index ", index, "deleted from cartList");
                        updateProductQty();

                    }
                })
                // after deleting the product in the cartList, check to see available products in the cartList
                cartList.forEach((product, index)=>{
                    console.log(product);
                })
                
           }
           else{
                console.log("this is not an button");
           }
        })


// define a function that will UPDATE the cartList when the add or sub button of any product is clicked
function updateProductQty(){

    // This fetch call makes an update to the cartList in the sgv
    fetch("fetch.php", {
        method : "PUT",
        headers : {
            "Content-Type" : "application/json",
        },
        body : JSON.stringify({cartList})  //converts the cartList array to one long string-JSON
    })  //after we call the fetch api it returns with a response which is a promise object
    .then((res)=>{
        if(!res.ok){
            console.log("Error");
        }
        else{  // if the reolved data from the promise is successful we want to do something with that data
            console.log(res);  //This res is the response object
            return res.json();   // in our case, we want to convert it to a json format. This also returns a promise
        }
    })
    .then((data)=>{  //data here is the response that is sent back by the server
        console.log("The response data : ", data);
        return data
    })
    .then((cartList)=>{
        console.log(cartList['cartList']);
    })
}
  </script>

</body>
</html> 