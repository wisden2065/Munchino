<?php
include('connect.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === "PUT"){
    $json_data = file_get_contents('php://input');

    $decoded_json_data =json_decode($json_data, true);
    
    if(isset($decoded_json_data['foodName'])){
        // this searchedFood holds the current value of the product searched in the input 
        $searchedFood = $decoded_json_data['foodName'];

        // make a query to dg to fetch all products that contains the searchedFod value
        $prodSearchQuery = "SELECT * FROM products WHERE name LIKE '%$searchedFood%'";
        $prodSearchResult = mysqli_query($connection, $prodSearchQuery);

        // it the query was successful and returned at least a row from the products table
        // create a variable tha we will pass to the failure of the response if false
        // if($row = mysqli_fetch_row($prodSearchResult) > 0){
        //     $success = "The query was successful";
        // }
        // else{
        //     $failure = "The query was not successful";
        
        // }
        

        while($product = mysqli_fetch_array($prodSearchResult)){
            $response = [
                'status' => 'success',
                'message' => 'search query successful',
                'searchedProductList' => $searchedFood
            ];
        }

    }
    else{
        $response = [
            'status' => 'error',
            'message' => 'could not complete search query'
        ];

    }
    echo json_encode($response);
    exit;
}

