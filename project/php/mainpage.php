<?php
    include('config.php');

    $name  = $_POST['name'];
    $credit  = $_POST['credit'];
    $address = $_POST['address'];
    $sql = "INSERT INTO `Train`.`BookingAgent` (`CreditCardNo.`, `Name`, `Adress`) VALUES ('$credit', '$name', '$address');";
    if($con->query($sql)==true){
        echo "Successfully updated database";
    }
    else{
        echo "Error bish: $con->error";
    }

    $con->close();
?>