<?php
    include('config.php');
    session_start();

    $connection = $con;

    $n = mysqli_real_escape_string($connection,$_POST['name']);
    $c = mysqli_real_escape_string($connection,$_POST['cno']);
    // echo $c;
    // echo $n;

    $col = "Name";
    $col2 = "CreditCardNo.";

    $login_validation_query = "SELECT * FROM `Train`.`BookingAgent` WHERE `BookingAgent`.`CreditCardNo.` = '$c'";
    $results=mysqli_query($connection,$login_validation_query);

    if(mysqli_num_rows($results))
    {
        echo "Welcome";

        $_SESSION['booking_agent_login'] = $n;
        $_SESSION['booking_agent_credit'] = $c;
        $_SESSION['sid'] = session_id();

        header("Location: ./../AfterBookingAgentLogin.php");
    }
?> 
