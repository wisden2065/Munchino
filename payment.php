<?php
    session_start();
    include('connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pay.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
</head>
<body>
    <div class="munchino">
        <img src="pictures/munchino-logo-3.png" alt="">
    </div>
    <div class="order-container-wrapper">
        <div class="order-container">
            <div class="order-wrapper">
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <p>Upgrade Workspace</p>
                    <hr>
                    <div class="bill-plan-container">
                        <div class="bill monthly">
                            <div class="round"></div>
                            <p>Billed Monthly</p>
                            <sup>$</super><sub>5</sub>
                            <h5 style="color: #b8b6b6;">MEMEBER PER MONTH</h5>
                        </div>
                        <div class="bill annual">
                            <div class="round-container">
                                <div class="round-default"></div>
                            </div>
                             <p>Billed Yearly</p>
                            <sup>$</super><sub>9</sub>
                            <h5 style="color: #a7a6a6;">MEMEBER PER YEAR</h5>
                        </div>
                    </div>
                    <div class="get-promo">
                        <p style="color: #2e8500;"><i class="fa-solid fa-rectangle-ad" style="color: #2e8500;"></i> Got a Promo code?</p>
                    </div>
                    <div class="bill-today">
                        <strong>Billed Today</strong> <h3>$ 60</h3>
                        <hr>
                        <p>Renews for $60 every year</p>
                    </div>
                    <hr>
                    <h3>Payment details <i class="fa-solid fa-lock"></i></h3>
                    <form action="logic.php" method="post">
                        <div class="input">
                            <i class="fa-regular fa-credit-card" style="color: #e0e0e1;"></i>
                            <input type="text" class="card" placeholder="Credit Card Number">
                        </div><br>
                        <div class="card-details">
                            <div class="card1">
                                <input type="date" value="Expiring">
                            </div>
                            <div class="card2">
                                <i class="fa-solid fa-lock" style="color: #ebebeb;"></i>
                                <input type="text" name="cvv" placeholder="CVV">
                            </div>
                        </div><br>
                        <input type="text" placeholder="Postal code" class="card1"><br>
                        <input class="btn" type="submit" value="Pay Now">
        
        
                    </form>
                  
        
        
                </div>
            </div>
            <div class="package-summary">
                <div class="package-wrapper">
                    <h3>Unlimited</h3>
                    <p><i class="fa-solid fa-circle-check" style="color: #20fc03;"></i> Complete Rider access</p>
                    <p><i class="fa-solid fa-circle-check" style="color: #20fc03;"></i> Return on delivery</p>
                    <p><i class="fa-solid fa-circle-check" style="color: #20fc03;"></i> Extra customer support</p>
    
    
                    <p>Trusted by more than 200,000 Teams Nationally</p>
                    <p>Certified by SON</p>
                    <div class="cards">
                        <p>We accept the following cards</p>
                        <div class="card-div">
                            <div class="cards"><img src="pictures/cards1.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
    
         

        </div>
    </div>
</body>
</html>