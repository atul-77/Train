<?php
    include('config.php');
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // username and password sent from form

        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $sql = "SELECT * FROM `Train`.`admin` WHERE username = '$username' AND passcode = '$password'";
        $result = mysqli_query($con, $sql);
        
        $count = mysqli_num_rows($result);

        // If result matched, table row must be 1

        if($count == 1){
            $_SESSION['login_user'] = $username;
            $_SESSION["permission"] = 'admin';
            $_SESSION['sid'] = session_id();

            header("Location: ./../scheduling.php");
            echo "Logged In!";
        }
        else{
            $error = "Your login is invalid!";

            echo $error;
        }
    }

    $con->close();
?>