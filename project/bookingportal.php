<?php
    session_start();
    // Don't access without logging in!
    if($_SESSION['sid'] != session_id()){
        header("Location: bookingAgentLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the booking portal</title>
    <link rel="stylesheet" href="assets/css/bas.css">
</head>
<body>
    <div class="container">
        <form action="bookingportalII.php" method="post">
            <input type="text" name="trainnum" id="trainnum" placeholder="Enter the train number">
            <input type="text" name="coachType" id="coachType" placeholder="Enter your preffered coach type, i.e AC or Sleeper">
            <input type="text" name="numPassengers" id="numPassengers" placeholder="Enter the number of total niggas travelling">
            <button class="btn">
                Submit
            </button>
        </form>
    </div>
</body>
</html>


