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

            if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'jfif'){
                ?>
                    <script>
                        alert("Please upload a photo having an extension .jpg/ .jpeg/ .png/ .jfif");
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
        // echo "No user exist in database";
}



// Allow Admin to edit Product in database
if(isset($_POST['admin-edit-product'])){
    $productName = $_POST['pName'];
    $productPrice = $_POST['pPrice'];
    $productQty = $_POST['pQty'];
    $productRating = $_POST['pRating'];
    $productImage = $_POST['pImage'];


    $sqlQuery = "SELECT * FROM products";
    $result = mysqli_query($connection, $sqlQuery) or die("Error");
    // print_r($result);

    $rowResult= mysqli_fetch_row($result);

    if($rowResult > 2){

        mysqli_data_seek($result, 0);
        $list = [];
        // echo  gettype($list);
        while($row = mysqli_fetch_assoc($result)){
            // print_r($row['name']);
            array_push($list, $row['name']);
            // $list = $row['name'];
        }
        // echo "<br>";
        // echo gettype($list);
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
        echo "No rows gotten";
    }
    



}




?>


