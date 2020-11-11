<?php
    include('config.php');

    $name  = $_POST['name'];
    $credit  = $_POST['credit'];
    $address = $_POST['address'];
    // $datacheck = "select CreditCardNo. from BookingAgent";
    // echo $con->query($datacheck); 
    $sql = "INSERT INTO `Train`.`BookingAgent` (`CreditCardNo.`, `Name`, `Adress`) VALUES ('$credit', '$name', '$address');";
    if($con->query($sql)==true){
        echo "Successfully updated database";
    }
    else{
        // echo "You are already signed up dumbass";
        header("Location: /project/bookingAgentLogin.php");
        exit();
    }
    $con->close();
?>