
<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            border: 0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--yellow);       
        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
           
        }
        .container::after{
            content: '';
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: solid 10px transparent;
            border-top: solid 10px green;
            animation: loading 1s linear infinite; 
        }
        @keyframes loading{
            to{
                transform: rotate(1turn);
            }
        }
    </style>
</head>
<body>
    
    <div style= "position:relative;"class="container" id="cont">
        <img style="width: 100px; height: 100px; position: absolute;" src="pictures/munchino-logo-3.png" alt="">
    </div>

    <script>
        // loading script
        console.log("Hello");
        setTimeout(()=>{
            window.location.href='index.php';
        }, 3000)
    </script>

</body>
</html>