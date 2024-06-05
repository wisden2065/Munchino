<?php
if($_SESSION['cartList'][$index]['id'] == $productId){
    $_SESSION['cartList'][$index]['qty'] += 1;
}
else{

   
        $newProduct = array(
            "id" => $productId,
            "name" => $productName,
            "price" => $productPrice,
            "image" => $productUrl,
            "qty" => 1
        );
        array_push($_SESSION['cartList'], $newProduct);

    echo $index;
}