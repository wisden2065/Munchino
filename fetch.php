<?php

// include the connection to the server - PHP Admin
include('connect.php');
// start the session to make the cartList in the sgv available on this page
session_start();
// print_r($_SESSION['totalProduct_price']);
// print_r($_SESSION['cartList']);
// check to see if the value of the session sgv ($_SESSION['cartList])
// print_r($_SESSION['cartList']);  // and yes! it is available here..
// The SERVER RESPONSE TO AN UPDATE REQUEST
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        header('Content-Type: application/json'); // Set the content type to JSON
        //This line reads the raw json data from the request body and set it to a variable $json
        $json = file_get_contents('php://input');

        //this line decodes the json string stored on the POST request body into a php array b/c of the true
        $data = json_decode($json, true);
         // check if there is an array cartList in the decoded request body and its not empty
        // this array contains the updated cartList
        if (isset($data['cartList']) && isset($data['totalProduct'])) {
            // store the updated cartList in the cartList which is in the session sgv
            // This will update the state of the cartList in the session sgv
            $_SESSION['cartList'] = $data['cartList'];
            $_SESSION['totalProduct'] = $data['totalProduct'];
            // Process the response object that the client can see how the request went
            $response = [
                'status' => 'success',
                'message' => 'Cart updated successfully',
                'cartList' => $_SESSION['cartList'],
                'totalProduct' => $_SESSION['totalProduct'] 
            ];
        } 
        else {
            $response = [
                'status' => 'error',
                'message' => 'Could not update cart info'
            ];
        }
        echo json_encode($response); // Return the response as JSON
        exit; // Ensure no further output is sent
    }
    
