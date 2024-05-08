

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-add_product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
            *{
                margin: 0;
                padding: 0;
            }
            
            body{
                box-sizing: border-box;
                background: whitesmoke
            }
            
            .container{
                display: grid;
                place-items: center;
                height: 90vh;
            }
            
            .form-box{
                background: #fff;
                padding: 25px 30px;
                border-radius: 20px;
                width: 450px;
            }
            
            p{
                font-size: 1.5em;
                font-weight: 700;
                margin-bottom: 30px;
            }
            .form-box--input{
                display: flex;
                flex-direction: column;
            }
            input[type=text]{
                padding: 20px 20px;
                border: none;
                outline: none;
                border-radius: 5px;
                background: aliceblue;
                margin: 10px 0;
            }
            input[type=file]{
                padding: 20px 20px;
                border: none;
                outline: none;
                border-radius: 5px;
                background: aliceblue;
                margin: 10px 0;
            }
            
            input[type=submit]{
                align-self: center;
                padding: 20px;
                border: none;
                outline: none;
                border-radius: 5px;
                width: 200px;
                margin-top: 30px;
                background: #000;
                color: white;
            }
            
            label{
                font-size: 1.25rem;
            }

            /* Admin info div */
            .admin-welcome{
                background-color: #f8e559;
                height: 100px;
                width: 100px;
                border-radius: 10px;
                display: grid;
                grid-template-rows: 1fr 1fr;
                text-align: center;
                place-items: center;
                padding: 10px;
                position: sticky;
                inset: 0;
                cursor: pointer;
            }
            .admin-welcome p{
                font-size: 18px;
                color: #192a56;
            }
            .admin-welcome .icon{
                border: solid 1px;
                height: 50px; width: 50px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #b9b1b1;
            }
            .admin-welcome .icon:hover{
                background-color: #27ae60;
                cursor: pointer;
            }
           
    </style>
</head>
<body>
    
<?php

   
include('connect.php');
session_start();
// echo $session;

    if(isset($_SESSION['session-id'])){
        $session = $_SESSION['session-id'];
        

        $sqlQuery = "SELECT * FROM users WHERE email = '$session'";
        $result = mysqli_query($connection, $sqlQuery) or die("Error");

        $row = mysqli_num_rows($result);
        if($row > 0){
            $firstName = mysqli_fetch_array($result)['firstName'];
            // echo "Rows gotten";
            ?>
    <div class="admin-welcome">
        <div class="icon"><i class="fa-solid fa-user" style="color: #d8d8da;"></i></div>
        <p>Hello, <?php echo $firstName ?> </p>
    </div>
    <div class="container">
    <div class="form-box">
            <p>Edit A Product</p>
            <form action="logic.php" method="post">
                <div class="form-box--input">
                    <label for="">Product Name</label>
                    <input type="text" name="pName" id="" placeholder="Enter Product to add">
                </div>
                <div class="form-box--input">
                    <label for="">Product Price</label>
                    <input type="text" name="pPrice" id="" placeholder="Enter New Price">
                </div>
                <div class="form-box--input">
                    <label for="">Product Qty</label>
                    <input type="text" name="pQty" id="" placeholder="Enter New Quantity" >
                </div>
                <div class="form-box--input">
                    <label for="">Product Rating</label>
                    <input type="text" name="pRating" id="" placeholder="Enter New Product Rating" >
                </div>
                <div class="form-box--input">
                    <label for="">Product Image</label>
                    <input type="file" name="pImage" id="" >
                </div>

                <div class="form-box--input">
                <!-- <input type="hidden" name="id" value="echoed row[id]"> -->

                <input type="submit" value="Proceed" name="admin-edit-product">
                </div> 

            </form> 

            <?php

        }
        else{
            echo "Rows not gotten";
        }

    }
?>
        

        </div>
    </div>


</body>
</html>