<?php
if(isset($_POST['name'])){
$server="localhost";
$username="root";
$password="";

$connection=mysqli_connect($server,$username,$password,'train');
if($connection)
{
    // echo "Successfully connected to Database using mySQL";
}
else
{
    // echo "Couldn't connect to Database";
}
$n=mysqli_real_escape_string($connection,$_POST['name']);
$c=mysqli_real_escape_string($connection,$_POST['cno']);
// echo $c;
// echo $n;
$col="Name";
$col2="CreditCardNo.";
$login_validation_query="SELECT * FROM `bookingagent` WHERE `bookingagent`.`CreditCardNo.` = '$c'";
$results=mysqli_query($connection,$login_validation_query);
// echo var_dump($results);
// echo mysqli_num_rows($result);
if(mysqli_num_rows($results))
{
    header("Location:project/php/mainpage.php");
}
else
{
    echo "You don't have an account";
}
}
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<script src="index.js"></script>
<body>
    <div class="container">
        <h1>Railway Reservation System</h1>
        <h3>Login Page</h3>
        <form action="index.php" method="post">
            <input type="name" name="name" id="name" placeholder="Enter your Full Name">
            <input type="cno" name="cno" id="cno" placeholder="Enter your Credit Card No">
            <br>
            <button class="btn" name="Submit">Submit</button>
            <p>Not a user already?Click <a href="signup.php">here</a> to sign up.</p>
        </form>
    </div>
</body>
</html>


