<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $con = mysqli_connect($server,$username,$password);

    if(!$con){
        die("Connection failed <br>".mysqli_connect_error());
    }
    echo "Established connection to database successfully <br>";
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