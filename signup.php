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
        <div class="user">
            <div class="munchino">
                <img src="pictures/munchino-logo-3.png" alt="">
            </div>
            <form action="logic.php" method="post" enctype="multipart/form-data">
               <p class="paragraph">Welcome to Munchino</p> 
               <div class="light-text-container"><p class="light-text">Type in your email or phone number to login or create a Munchino account</p></div>
               <input class="light-input" name="firstname" type="text" placeholder="First Name*"> <br><br>
               <input class="light-input" name="lastname" type="text" placeholder="Last Name"> <br><br>
               <input class="light-input" name="username" type="text" placeholder="Username">  <br></BR>
                <!-- <div class="light-container"> -->
                    <input class="light-input" name="picture" type="file" value="Upload image" accept=".png, .jpg, .jpeg">
                <!-- </div> -->
               
               <br><br>
               <input class="light-input" name="email" type="text" placeholder="Enter your email*"><br><br>
               <input class="light-input" name="password" type="password" placeholder="Enter password*"> <br><br>
               <input class="btn" type="submit" name="signup" value="Sign up">
               <p><span>Already have an account? <a href="signin.php">sign in</a></span></p> <br>
              <div class="light-text-container"><p class="light-text2">By signing up you agree to Munchino's <span style="text-decoration: underline; cursor: pointer;">Terms and Conditions</span></p></div>
                <br>
            </form> 
            <div class="pix">
                <div class="txt">
                    <p id="logo">Munchino</p>
                </div>
                <img style="height: 100px;" src="pictures/munchino-logo-3.png" alt="">
            </div>

        </div>
     
       
    </section>
   
    <script src="user-profile-signin.js"></script>
</body>
</html>