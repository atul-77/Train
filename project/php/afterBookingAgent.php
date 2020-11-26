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
$login_validation_query="";
$bookingButton="<a href='..\bookingportal.php'>Book this train</a>";
$one_hop="";

$sp=0;
if($d!="" And $ss!="" And $es!="")
{
    // $login_validation_query="SELECT `totaltrain`.`TrainNo.`, `totaltrain`.`Source`, `totaltrain`.`Destination`, `totaltrain`.`ArrivalTime`, `totaltrain`.`DepartureTime`
    // FROM `totaltrain`,`scheduledtrains` 
    // WHERE `totaltrain`.`TrainNo.` = `scheduledtrains`.`TrainNo.` 
    // AND `scheduledtrains`.`Date`='$d' 
    // AND `totaltrain`.`Source`='$ss' 
    // AND `totaltrain`.`Destination`='$es'";
    $login_validation_query="CALL return_train();";
    $sp=1;
}
else if($d=="" And $ss!="" And $es!="")
{
    $login_validation_query="SELECT `totaltrain`.`TrainNo.`, `totaltrain`.`Source`, `totaltrain`.`Destination`, `totaltrain`.`ArrivalTime`, `totaltrain`.`DepartureTime`, `scheduledtrains`.`Date`
    FROM `totaltrain`,`scheduledtrains` 
    WHERE `totaltrain`.`TrainNo.` = `scheduledtrains`.`TrainNo.` 
    AND `totaltrain`.`Source`='$ss' 
    AND `totaltrain`.`Destination`='$es'";
}
else if($d!="" And $ss=="" And $es=="")
{
    $login_validation_query="SELECT `totaltrain`.`TrainNo.`, `totaltrain`.`Source`, `totaltrain`.`Destination`, `totaltrain`.`ArrivalTime`, `totaltrain`.`DepartureTime`, `scheduledtrains`.`Date`
    FROM `totaltrain`,`scheduledtrains`
    WHERE `totaltrain`.`TrainNo.` = `scheduledtrains`.`TrainNo.` 
    AND `scheduledtrains`.`Date`='$d'"; 
}

$check=0;
$cnt=0;
$results=mysqli_query($connection,$login_validation_query);
if ($results->num_rows > 0) 
    {
        if($sp==0)
        {
            echo "<div class='msg'><b>We found the following direct trains for your query:</b></div>";
            echo "<br>";
            echo "<table> <tr> <th>Train Number</th> <th>Date</th> <th>Source</th> <th>Destination</th> <th>Arrival Time</th> <th>Departure Time</th> <th>Booking</th> </tr>";
        }
        while($row = $results->fetch_assoc()) 
        {
            $trainnum = $row["TrainNo."];
            $date = $row["Date"];
            $bookingButton = "<a href='..\bookingportal.php?trainnum=$trainnum&date=$date'>Book this train</a>";
            if($sp===1)
            {
                if($row["Source"]===$ss And $row["Destination"]===$es And $row["Date"]===$d)
                {
                    if($cnt==0)
                    {
                        echo "<div class='msg'><b>We found the following direct trains for your query:</b></div>";
                        echo "<br>";
                        echo "<table> <tr> <th>Train Number</th> <th>Date</th> <th>Source</th> <th>Destination</th> <th>Arrival Time</th> <th>Departure Time</th> <th>Booking</th> </tr>";
                        $cnt=1;
                    }
                    echo "<tr> <td>".$row["TrainNo."]."</td><td>".$row["Date"]."</td><td>".$row["Source"]."</td><td>".$row["Destination"]."</td><td>".$row["ArrivalTime"]."</td><td>".$row["DepartureTime"]."</td><td>".$bookingButton."</td></tr>";
                    $check=1;
                }
            }
            else
            {
                echo "<tr> <td>".$row["TrainNo."]."</td><td>".$row["Date"]."<td>".$row["Source"]."</td><td>".$row["Destination"]."</td><td>".$row["ArrivalTime"]."</td><td>".$row["DepartureTime"]."</td><td>".$bookingButton."</td></tr>";
                $check=1;
            }
        }
        echo "</table>";
        echo "<br>";
    }
if($check==0)
    {
        echo "<div class='sorry'> Sorry!<br>We don't have any direct trains matching your query, try changing the date or start, end stations!";
        echo "<br>";
        echo "<p>Press <a href='..\afterBookingAgentLogin.php'>here</a> to go back to the search page.</p> </div>";
        echo "<br>";
    }
$connection->next_result();
if($d!="" And $ss!="" And $es!="")
{
    $one_hop=
    "SELECT t1.`TrainNo.` AS t1_tn, t1.`Source` AS t1_s, t1.`Destination` AS t1_d, t1.`ArrivalTime` AS t1_AT, t1.`DepartureTime` AS t1_DT,
    t2.`TrainNo.` AS t2_tn, t2.`Source` AS t2_s, t2.`Destination` AS t2_d, t2.`ArrivalTime` AS t2_AT, t2.`DepartureTime` AS t2_DT, st1.`Date`
    FROM `totaltrain` t1, `totaltrain` t2, `scheduledtrains` st1, `scheduledtrains` st2 
    WHERE t1.`TrainNo.`=st1.`TrainNo.` AND t2.`TrainNo.`=st2.`TrainNo.` 
    AND st1.`Date`=st2.`Date`
    AND st1.`Date`='$d'
    AND t1.`Source`='$ss' AND t1.`Destination`=t2.`Source` AND t2.`Destination`='$es'
    AND t1.`ArrivalTime` < t2.`DepartureTime`";
}
else if($d=="" And $ss!="" And $es!="")
{
    $one_hop=
    "SELECT t1.`TrainNo.` AS t1_tn, t1.`Source` AS t1_s, t1.`Destination` AS t1_d, t1.`ArrivalTime` AS t1_AT, t1.`DepartureTime` AS t1_DT,
    t2.`TrainNo.` AS t2_tn, t2.`Source` AS t2_s, t2.`Destination` AS t2_d, t2.`ArrivalTime` AS t2_AT, t2.`DepartureTime` AS t2_DT, st1.`Date`
    FROM `totaltrain` t1, `totaltrain` t2, `scheduledtrains` st1, `scheduledtrains` st2 
    WHERE t1.`TrainNo.`=st1.`TrainNo.` AND t2.`TrainNo.`=st2.`TrainNo.` 
    AND st1.`Date`=st2.`Date`
    AND t1.`Source`='$ss' AND t1.`Destination`=t2.`Source` AND t2.`Destination`='$es'
    AND t1.`ArrivalTime`<t2.`DepartureTime`";
}
else if($d!="" And $ss=="" And $es=="")
{
    $one_hop=
    "SELECT t1.`TrainNo.` AS t1_tn, t1.`Source` AS t1_s, t1.`Destination` AS t1_d, t1.`ArrivalTime` AS t1_AT, t1.`DepartureTime` AS t1_DT,
    t2.`TrainNo.` AS t2_tn, t2.`Source` AS t2_s, t2.`Destination` AS t2_d, t2.`ArrivalTime` AS t2_AT, t2.`DepartureTime` AS t2_DT, st1.`Date`
    FROM `totaltrain` t1, `totaltrain` t2, `scheduledtrains` st1, `scheduledtrains` st2 
    WHERE t1.`TrainNo.`=st1.`TrainNo.` AND t2.`TrainNo.`=st2.`TrainNo.` 
    AND st1.`Date`=st2.`Date`
    AND t1.`Destination`=t2.`Source`
    AND t1.`ArrivalTime`<t2.`DepartureTime`";
}

$results=mysqli_query($connection,$one_hop);
    if ($results->num_rows > 0) 
    {
        echo "<div class='msg'><b>We found the following one-hop trains for your query:</b></div>";
        echo "<br>";
        echo "<table> <tr> <th>Train Number</th> <th>Date</th> <th>Source</th> <th>Destination</th> <th>Arrival Time</th> <th>Departure Time</th> <th>Train Number</th> <th>Source</th> <th>Destination</th> <th>Arrival Time</th> <th>Departure Time</th> <th>Booking first train</th> <th>Booking second train</th> </tr>";
        while($row = $results->fetch_assoc()) 
        {
            $trainnum = $row["t1_tn"];
            $trainnum2 = $row["t2_tn"];
            $date = $row["Date"];
            $bookingButton = "<a href='..\bookingportal.php?trainnum=$trainnum&date=$date'>Book first train</a>";
            $bookingButton2 = "<a href='..\bookingportal.php?trainnum=$trainnum2&date=$date'>Book second train</a>";
            echo "<tr> <td>".$row["Date"]."</td><td>".$row["t1_tn"]."</td><td>".$row["t1_s"]."</td><td>".$row["t1_d"]."</td><td>".$row["t1_AT"]."</td><td>".$row["t1_DT"]."</td><td>".$row["t2_tn"]."</td><td>".$row["t2_s"]."</td><td>".$row["t2_d"]."</td><td>".$row["t2_AT"]."</td><td>".$row["t2_DT"]."</td><td>".$bookingButton."</td><td>".$bookingButton2."</td></tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "<div class='sorry'> Sorry!<br>We don't have any one-hop trains matching your query, try changing the date or start, end stations!";
        echo "<br>";
        echo "<p>Press <a href='..\afterBookingAgentLogin.php'>here</a> to go back to the search page.</p> </div>";
    }
}
?> 





