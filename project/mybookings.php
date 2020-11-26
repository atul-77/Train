
<?php
    include('php/config.php');
    session_start();

    if($_SESSION['sid'] != session_id()){
        header("Location: bookingAgentLogin.php");
    }

    include('php/bookingspage.php');
?>

<html>
    <head><title>My Bookings</title></head>
    <body>
        <h1>Hello <?php echo $_SESSION['booking_agent_login'] ?></h1>
        <br>
        <a href="afterBookingAgentLogin.php">Book another Ticket</a>
        <br><br>
        <h2>Previously Scheduled Trains</h2>
        <br>
        <div class="bookings" style="margin-left: 25%">
            <?php bookedTrains($con);?>
        </div>
    </body>
</html>