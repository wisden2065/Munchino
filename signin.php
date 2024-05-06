<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign-in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="user-profile-signin.css">
</head>
<body>

    <section class="user-profile">
        <!-- <div class="admin-login">
            <p><a href="admin.php"><i class="fa-solid fa-user-pen" style="color: #dedede;"></i> Admin signin</a></p>
        </div> -->
        <div class="user">
            <div class="munchino">
                <img src="pictures/munchino-logo-3.png" alt="">
            </div>
            <form action="logic.php" method="post" id="signin">
               <p class="paragraph">Welcome to Munchino</p> 
               <div class="light-text-container"><p class="light-text">Type in your email or phone number to login or create a Munchino account</p></div>
               <input class="light-input" name="email" type="text" placeholder="Enter your email*">  <br><small id="smallTag"></small><br><br>
               <input class="light-input" type="password" name="password" placeholder="Enter your password*"> <br><br>
               <input class="btn" type="submit" name="continue-as-user" value="Continue"> <br><br>
              <div class="light-text-container"><p class="light-text2">By contionuing you agree to Munchino's <span style="text-decoration: underline; cursor: pointer;">Terms and Conditions</span></p></div>
                <br>
               <div class="light-text-container"> <hr style="width: 470px;"></div> <br>
               <!-- <input class="btn2" type="button" value="Guest Checkout" id=""><br><br> -->
               <button class="btn3" type="text" > <img src="pictures/google-icon (2).png" alt="">  Continue with Google</button> 
               <br><br>
               <p>Don't have an account?  <span><a href="signup.php">Signup here</a></span></p> <br>
               <div class="light-text-container"><p class="light-text">For futher support, you may visit the Help Center or contact our customer service team</p></div>
            </form> 
            <div class="pix">
                <div class="txt">
                    <p id="logo">Munchino</p>.
                </div>
                <img style="height: 100px;" src="pictures/munchino-logo-3.png" alt="">
            </div>

        </div>
     
       
    </section>
   
    <script src="signin.js"></script>
</body>
</html>