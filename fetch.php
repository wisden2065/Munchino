<?php

// include the connection to the server - PHP Admin
include('connect.php');
// start the session to make the cartList in the sgv available on this page
session_start();
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
        if (isset($data['cartList'])) {
            // store the updated cartList in the cartList which is in the session sgv
            // This will update the state of the cartList in the session sgv
            $_SESSION['cartList'] = $data['cartList'];
            // Process the response object that the client can see how the request went
            $response = [
                'status' => 'success',
                'message' => 'Cart updated successfully',
                'cartList' => $_SESSION['cartList']
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No cartList found in the request'
            ];
        }
        echo json_encode($response); // Return the response as JSON
      
        exit; // Ensure no further output is sent
    }

// THE SERVER RESPONSE TO A DELETE REQUEST
if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    header("Content-Type : application/json");

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);
    if(isset($data['cartList'])){
        // update the deleted cartItem from the cartList
        $_SESSION['cartList'] = $data['cartList'];
        // prepare the response object for the client
        $response = [
            'status' => 'success',
            'message' => 'CartItem deleted successfully',
            'cartList' => $_SESSION['cartList']
        ];
    }

}