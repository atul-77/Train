<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets\css\afterBookingAgentLogin.css">
</head>
<script src="bookingAgentLogin.js"></script>
<body>
    <div class="container">
        <h1>Railway Reservation System</h1>
        <h2>Trains Between Stations</h2>
        <form action="php\afterBookingAgent.php" method="post">
            <p>You can either enter <b>only the Date</b> and click submit to see all trains running on that date<br>
                or you can enter the <b>Start and End stations only</b> and see all trains running between those stations regardless of the date<br>
                or you can enter <b>all the details</b> i.e Date, Start, and End Stations.
            </p>
            <p><b>Enter the date for which you want to view trains:</b></p>
            <input type="date" name="date" id="date" placeholder="Enter the date for which you want to book the ticket">
            <p><b>Enter the start station of your journey:</b></p>
            <input type="startstn" name="startstn" id="startstn" placeholder="Enter departure station name">
            <p><b>Enter the end station of your journey:</b></p>
            <input type="endstn" name="endstn" id="endstn" placeholder="Enter arrival station name">
            <br>
            <button class="btn" name="Submit">Submit</button>
        </form>
    </div>
</body>
</html>

