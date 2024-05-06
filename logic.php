<?php

    include('connect.php');
    // print_r($_POST['$firstName']);

    //for signup
    if(isset($_POST['signup'])){
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // $password = md5($password);
        $pictureName = $_FILES['picture']['name'];    
        $picture_uploaded = 0;
    // images/videos/files are 2x2 matrix/array

        if(move_uploaded_file($_FILES['picture']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/e-commerce/pic/'.$pictureName)){
            $target_file = $_SERVER['DOCUMENT_ROOT'].'/e-commerce/pic/'.$pictureName;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $pictureName = basename($_FILES['picture']['name']);
            $photo = time().$pictureName;

            if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png'){
                ?>
                    <script>
                        alert("Please upload a photo having an extension .jpg/ .jpeg/ .png");
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


// sign in
if(isset($_POST['continue-as-user'])){
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
                header('Location: load.php');
            }
            else if($userType == 1){
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
        echo "No user exist in database";
}




//Sign in as Admin
if(isset($_POST['continue-as-admin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlQuery = "SELECT * FROM admin WHERE email = '$email'";
    $sqlResult = mysqli_query($connection, $sqlQuery) or die("Error");

    $rows = mysqli_fetch_row($sqlResult);

    if($rows > 0){


        $admin = $rows[2];
        // echo $admin;
        session_start();
        $_SESSION['admin-id'] = $admin;
        header('Location: admin-edit.php');
    }
    else{
        echo "Incorrect email or password";
    }



}

// Admin edit Product in database
if(isset($_POST['admin-edit-product'])){
    $productName = $_POST['pname'];
    $productPrice = $_POST['pprice'];
    $productQty = $_POST['pqty'];
    $productRating = $_POST['rating'];


    $PopProdSqlQuery = "SELECT * FROM popular_dishes";
    $result = mysqli_query($connection, $PopProdSqlQuery) or die("Error");
    print_r($result);

    $rowPop_dishes = mysqli_fetch_row($result);

    if($rowPop_dishes > 2){
        echo "Rows gotten";
        print_r($rowPop_dishes);
        print_r($rowPop_dishes[2]);

        
    }
    else{
        echo "No rows gotten";
    }

    if($productName == $rowPop_dishes[2]){
        $query = "UPDATE `popular_dishes` SET `rating` = '$productRating', `name` = '$productName', `price` = '$productPrice', `quantity` = '$productQty' WHERE `name` = '$productName'";
        $result = mysqli_query($connection, $query) or die("Error establishing connection with database");

        if($result){
            echo "Changes made to"." ".$productName." "."complete!";
        }
        else{
            echo "Error in completing changes to ".$productName;
            // echo $productName." product may not exist in database";
        }
    }
    else{
        $query = "INSERT INTO `popular_dishes`(`rating`, `name`, `price`, `quantity`) VALUES('$productRating', '$productName', '$productPrice', '$productQty')";
        $result = mysqli_query($connection, $query) or die('Error');
        
        echo '<br>';
        echo "Product ".$productName." added to database";
    }
    



}




?>


