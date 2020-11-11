<?php
if(isset($_POST['name'])){
$server="localhost";
$username="root";
$password="";

$connection=mysqli_connect($server,$username,$password,'Train');
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
$login_validation_query="SELECT * FROM `BookingAgent` WHERE `BookingAgent`.`CreditCardNo.` = '$c'";
$results=mysqli_query($connection,$login_validation_query);
// echo var_dump($results);
// echo mysqli_num_rows($result);
if(mysqli_num_rows($results))
{
    echo "Welcome";
    header("Location:mainpage.php");
}
else
{
    echo "You don't have an account,please sign up";
    header("Location:signup.php");
}
}
?> 