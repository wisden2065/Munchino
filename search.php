<?php
include('connect.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === "GET"){
    // $json_data = file_get_contents('php://input');
    $json_data = $_GET['food'];
    // $decoded_json_data =json_decode($json_data, true);
    if(isset($json_data)){
        // this searchedFood holds the current value of the product searched in the input 
        $searchedFood = $json_data;

        // make a query to dg to fetch all products that contains the searchedFod value
        $prodSearchQuery = "SELECT name FROM products WHERE name LIKE '%$searchedFood%'";
        $prodSearchResult = mysqli_query($connection, $prodSearchQuery);
        
        if($rows = mysqli_fetch_array($prodSearchResult) > 0){

            // initialize an empty array that will hold values of all the product names
            $foodNames = [];
            mysqli_data_seek($prodSearchResult, 0);
            // loop through the array[This array is an associative array i.e holds it value ref by index number and name] and push each name to $foodNames
            while($rows = mysqli_fetch_array($prodSearchResult)){
                // print_r($rows[0]);
                array_push($foodNames, $rows[0]);
                
            }
           
            $response = [
                'status' => 'success',
                'message' => 'search query successful',
                'foundProducts' => $foodNames
            ];
            // if the query does not return any data we show an errr
            if($row = mysqli_num_rows($prodSearchQuery) <= 0){
                $response = null;
            }
            
        }
        else{
            $failure = "The query was not successful";
        
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

