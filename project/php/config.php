<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $con = mysqli_connect($server,$username,$password);

    if(!$con){
        die("Connection failed <br>".mysqli_connect_error());
    }
    echo "Established connection to database successfully <br>";
?>