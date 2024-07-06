<?php

include("connect.php");
session_start();

    $prodSearchQuery = "SELECT name FROM products WHERE name LIKE '%ric%'";
    $prodSearchResult = mysqli_query($connection, $prodSearchQuery);
    // if the query returns more than on array
    if(mysqli_fetch_array($prodSearchResult) > 1){

        // initialize an empty array that will hold values of all the product names
        $foodNames = [];
        mysqli_data_seek($prodSearchResult, 0);
        // loop through the array[This array is an associative array i.e holds it value ref by index number and name] and push each name to $foodNames
        while($rows = mysqli_fetch_array($prodSearchResult)){
            // print_r($rows[0]);
            array_push($foodNames, $rows[0]);
             
        }
        print_r($foodNames);
       
    }
    else{
        echo "FAILED";
    }
