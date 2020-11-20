<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\assets\css\afterBookingAgentLogin.css">
</head>
<script src="bookingAgentLogin.js"></script>
<body>
    <div class="container">
        <h1>Railway Reservation System</h1>
        <h2>Trains Between Stations</h2>
        <!-- <form action="php\afterBookingAgent.php" method="post">
            <p><b>Enter the date for which you want to view trains:</b></p>
            <input type="date" name="date" id="date" placeholder="Enter the date for which you want to book the ticket">
            <p><b>Enter the start station of your jouney</b></p>
            <input type="startstn" name="startstn" id="startstn" placeholder="Enter departure station name">
            <p><b>Enter the end station of your journey</b></p>
            <input type="endstn" name="endstn" id="endstn" placeholder="Enter arrival station name">
            <br>
            <button class="btn" name="Submit">Submit</button>
        </form> -->
    </div>
</body>
</html>
<?php
if(isset($_POST['date'])){
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

$d=mysqli_real_escape_string($connection,$_POST['date']);
$ss=mysqli_real_escape_string($connection,$_POST['startstn']);
$es=mysqli_real_escape_string($connection,$_POST['endstn']);
// echo $d;
// echo $ss;
// echo $es;
$login_validation_query="";
if($d!="" And $ss!="" And $es!="")
{
    $login_validation_query="SELECT `totaltrain`.`TrainNo.`, `totaltrain`.`Source`, `totaltrain`.`Destination`, `totaltrain`.`ArrivalTime`, `totaltrain`.`DepartureTime`
    FROM `totaltrain`,`scheduledtrains` 
    WHERE `totaltrain`.`TrainNo.` = `scheduledtrains`.`TrainNo.` 
    AND `scheduledtrains`.`Date`='$d' 
    AND `totaltrain`.`Source`='$ss' 
    AND `totaltrain`.`Destination`='$es'";
}
else if($d=="" And $ss!="" And $es!="")
{
    $login_validation_query="SELECT `totaltrain`.`TrainNo.`, `totaltrain`.`Source`, `totaltrain`.`Destination`, `totaltrain`.`ArrivalTime`, `totaltrain`.`DepartureTime`
    FROM `totaltrain`,`scheduledtrains` 
    WHERE `totaltrain`.`TrainNo.` = `scheduledtrains`.`TrainNo.` 
    AND `totaltrain`.`Source`='$ss' 
    AND `totaltrain`.`Destination`='$es'";
}
else if($d!="" And $ss=="" And $es=="")
{
    $login_validation_query="SELECT `totaltrain`.`TrainNo.`, `totaltrain`.`Source`, `totaltrain`.`Destination`, `totaltrain`.`ArrivalTime`, `totaltrain`.`DepartureTime`
    FROM `totaltrain`,`scheduledtrains` 
    WHERE `totaltrain`.`TrainNo.` = `scheduledtrains`.`TrainNo.` 
    AND `scheduledtrains`.`Date`='$d'"; 
}
// $login_validation_query="SELECT * FROM `scheduledtrains` WHERE `scheduledtrains`.`Date` = $d AND ";
$results=mysqli_query($connection,$login_validation_query);
$bookingButton="<a href='mainpage.php'>Book this train</a>";
if ($results->num_rows > 0) 
    {
        echo "<table> <tr> <th>Train Number</th> <th>Source</th> <th>Destination</th> <th>Arrival Time</th> <th>Departure Time</th> <th>Booking</th> </tr>";
        // output data of each row
        while($row = $results->fetch_assoc()) 
        {
            echo "<tr> <td>".$row["TrainNo."]."</td><td>".$row["Source"]."</td><td>".$row["Destination"]."</td><td>".$row["ArrivalTime"]."</td><td>".$row["DepartureTime"]."</td><td>".$bookingButton."</td></tr>";
        }
        echo "</table>";
    }
else
    {
        echo "<div class='sorry'> Sorry!<br>We don't have any trains matching your query, try changing the date or start, end stations!";
        echo "<br>";
        echo "<p>Press <a href='..\afterBookingAgentLogin.php'>here</a> to go back to the search page.</p> </div>";
    }
// echo var_dump($results);
// echo mysqli_num_rows($result);
// if(mysqli_num_rows($results))
// {
//     echo "Welcome";
//     // header("Location:mainpage.php");
// }
// else
// {
//     echo "You don't have an account,please sign up";
//     // header("Location:mainpage.php");
// }
}
?> 





