<?php
    echo "Build Main Page here";
    include('config.php');

    if(isset($_POST['name'])){
    $name  = $_POST['name'];
    $credit  = $_POST['credit'];
    $address = $_POST['address'];
    // $datacheck = "select CreditCardNo. from BookingAgent";
    // echo $con->query($datacheck); 
    $sql = "INSERT INTO `Train`.`BookingAgent` (`CreditCardNo.`, `Name`, `Address`) VALUES ('$credit', '$name', '$address');";
    if($con->query($sql)==true){
        echo "Successfully updated database";
        header("Location: ./../gate.php");
    }
    else{
        // echo "You are already signed up dumbass";
        header("Location: ./../bookingAgentLogin.php");
    }
    $con->close();
}
?>
