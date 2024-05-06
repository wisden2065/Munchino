<?php


$host = 'localhost';
$user = 'root';
$password = '';
$db = 'munchino-ecommerce';
// $mysqli = new $mysqli('localhost', 'root', '', 'munchino');
$connection = mysqli_connect($host, $user, $password, $db) or die("Fatal Erroer");
// echo "Succesful";

if(!$connection){
    echo 'Connection to munchino database not established';
}
else{
    // echo "Connection established";
    // echo '<br>';
    // echo $_SERVER['DOCUMENT_ROOT'];
    // echo '<br>';
    // print_r($_SERVER);

}





?>