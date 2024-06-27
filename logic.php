<?php

    include('connect.php');
    // print_r($_POST['$firstName']);

    //when the user submits with the signup button
    if(isset($_POST['signup'])){
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // $password = md5($password);
        $pictureName = $_FILES['picture']['name'];    

        
        $picture_uploaded = 0;   //this variable would account for if the the user picture is successfully uploaded. Without it we wouldn't proceed to upload his other info
    // images/videos/files are 2x2 matrix/array

        // move uploaded file to server
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/e-commerce/pic/'.$pictureName)){
            $target_file = $_SERVER['DOCUMENT_ROOT'].'/e-commerce/pic/'.$pictureName;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $pictureName = basename($_FILES['picture']['name']);
            $photo = time().$pictureName;

            if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'jif'){
                ?>
                    <script>
                        alert("Please upload a photo having an extension .jpg/ .jpeg/ .png/ .jif");
                    </script>
                <?php
            }
            else if($_FILES['picture']['size'] > 2000000){
                ?>
                    <script>
                        alert("Your photo exceeds the min of 2 MB")
                    </script>
                <?php
            }
            else{
                $picture_uploaded = 1;
            }
        }
        
        $sqlQuery = "SELECT * FROM users WHERE email = '$email'";
        $sqlResult = mysqli_query($connection, $sqlQuery) or die("Error in reaching database");

        // check if unique id(email) already exist in database
        if(mysqli_num_rows($sqlResult) > 0){
            echo "A user already exist with this email.";
        }     
        else if(mysqli_num_rows($sqlResult) <= 0 && $picture_uploaded == 1){
            echo "No user exist with the id";
            echo "Redirecting...";
            $query = "INSERT INTO users(firstName, lastName, email, password, username, picture) 
            VALUES('$firstName', '$lastName','$email', '$password', '$username', '$pictureName')";
            $result = mysqli_query($connection, $query);
            echo $result;
        
            // redirects to login page after successful signup
            if($result){
                header('Location: signin.php');
            }
            else{
                echo "Error in completing signup";
            }
        }
        else{
            echo "Image field cannot be empty. Please add a photo to continue";

        }
        
    }


// sign in as Admin or User
if(isset($_POST['sign-in'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $password = md5($password);
    $query = "SELECT * FROM users WHERE email = '$email' AND password = $password";

    $result = mysqli_query($connection, $query) or die("Error in establishing connection");
 

    $row = mysqli_fetch_row($result);
    var_dump($row);
    if($row > 0){
        echo "User exist in database";
        // if($password == $row[5]){
         
            $user = $row;
            $userType = $user[0];
            session_start();
            $_SESSION['session-id'] = $user[5];
            if($userType == 0){
                // if the user is an USER, redirect to product page
                header('Location: load.php');
            }
            else if($userType == 1){
                // else redirect to admin panel
                header('Location: admin-page.php');
            }
            else{
                echo "No other type stated";
            }
            
        }
        // else{
        //     echo "Incorrect Password";
        // }
     
    }
    else{
        // echo "No user exist in database";
}



// Allow Admin to edit Product in database
if(isset($_POST['admin-edit-product'])){
    $productName = $_POST['pName'];
    $productPrice = $_POST['pPrice'];
    $productQty = $_POST['pQty'];
    $productRating = $_POST['pRating'];
    $productImage = $_POST['pImage'];

//after the admin has made a submission to edit a product we query the db to fetch all the products and see if the product name already exist in db
    $sqlQuery = "SELECT * FROM products";
    // result is the variable that stores all the products fetched from db
    $result = mysqli_query($connection, $sqlQuery) or die("Error");
    // print_r($result);

    // when we fetch all products, we get the number of all the products we have fetched in the variable rowResult.Each product is an associative array
    $rowResult= mysqli_fetch_row($result);

    // confirm if we have fetched more than one product we check if the product the admin wants to add is already in the db or not by its product name
    if($rowResult > 2){

        mysqli_data_seek($result, 0);
        // we create an empty list were we will extract and store all the products in the db in. This will help us check the new product name if it already in the db 
        $list = [];

        // mysqli_fetch_assoc($result) should return each product row one after the other.
        // hence the expression in the while loop will continue to evaluate to true while there is still a row in the variable result of total products in the db
        // while there a product in the result variable, we get the name of the product and push it into the list 
        while($row = mysqli_fetch_assoc($result)){

            array_push($list, $row['name']);
        }
       
        // update the product if its name already exist in the db and/ or push the product as a new product into the db if the name is not found in the db
        if(in_array($productName, $list)){
            echo $productName." found in the array";
            echo "<br>";
            $query = "UPDATE `products` SET `name`='$productName', `price`='$productPrice',`quantity`='$productQty', `rating`='$productRating', `image` = '$productImage' WHERE `name` = '$productName'";
            $result = mysqli_query($connection, $query) or die("Error in updating ".$productName);
            if($result){
              echo "Successfully updated ".$productName." to database!";
            }
            else{
                echo "Could complete update to".$productName;
               
            }
        }
        else{
            // echo $productName." Not found in the array";
            $query = "INSERT into `products`(`name`,`price`, `quantity`, `rating`, `image`) VALUES ('$productName','$productPrice', '$productQty', '$productRating','$productImage')";
            $result = mysqli_query($connection, $query) or die("Error in inserting new product ".$productName." to database");
            if($result){
                ?>
                    <?php
                        header('Location: admin-page.php');
                    ?>
                <?php
            }else{
                echo "Failed to insert new product ".$productName." to database";
                
            }

        }
        
    }
    else{
        echo "No products gotten in the database";
    }
    



}




?>


