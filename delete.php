<?php
include("connect.php");
session_start();

// when the delete button is clicked in the cartList we want to get that product and remove it from the list
if(isset($_GET['prod_id'])){ //get the clicked item by its id
    $clickedProd_id = $_GET['prod_id'];
    echo "The item i want to delete is " .$clickedProd_id . "<br>"; 
    print_r($_SESSION['cartList']);
    
    // since we have the product id and the whole list in the session sgv, we can get the product by its id 
    // we can loop through the session sgv to find the item whose id matches the clickedProd_id
    
    
}
