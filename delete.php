<?php
include("connect.php");
session_start();

// when the delete button is clicked in the cartList we want to get that product and remove it from the list
if(isset($_GET['prod_id'])){ //get the clicked item by its id
    $clickedProd_id = $_GET['prod_id'];
    echo "The item i want to delete is " .$clickedProd_id . "<br>"; 
    // print_r($_SESSION['cartList']);
    
    // make a variable that we will use in the cart.php to display pop up
    $_SESSION['product_deleted'] = false;
    // since we have the product id and the whole list in the session sgv, we can get the product by its id 
    // we can loop through the session sgv to find the item whose id matches the clickedProd_id
    foreach($_SESSION['cartList'] as $key => $product){
        // when we find the product
        if($product['id'] == $clickedProd_id){
            print_r($product);
            // we delete it
            $_SESSION['cartList'] = array_filter($_SESSION['cartList'], function($item) use ($product) {
                return $item !== $product;
            });
            // if successful, we make it true so we can use this value to show pop-up in cart.php
            $_SESSION['product_deleted'] = true;
            
        }
        
    }

    // then redirect page back to the cart.php
    header("Location: cart.php");
    
    
}
