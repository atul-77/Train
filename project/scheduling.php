<?php
    include('php/config.php');
    session_start();
    // Don't access without logging in!
    if($_SESSION['sid'] != session_id() and $_SESSION['permission'] == 'admin'){
        header("Location: admin.php");
    }

    include('php/schedulepage.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Get variables from the form
        $train_number = mysqli_real_escape_string($con, $_POST['t_number']);
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $ac_coaches = mysqli_real_escape_string($con, $_POST['ac_coaches']);
        $sp_coaches = mysqli_real_escape_string($con, $_POST['sp_coaches']);
        $number_coaches = 0;

        // Add date
        $sql = "INSERT INTO `Train`.`scheduledtrains`(`TrainNo.`, `#ofACcoaches`, `#ofSleeperCoaches`, `#ofACRemaining`, `#ofSleeperRemaining`, `Date`) 
                VALUES ('$train_number', '$ac_coaches', '$sp_coaches', '$number_coaches', '$number_coaches', '$date')";

        if($result = $con -> query($sql)){
            echo "New train scheduled!";
        }
        else{
            // echo "You are already signed up dumbass";
            echo "An error occured!";
        }
    }
?>
<html>
    <head><title>Scheduling Page for Admin</title></head>
    <body>
        <h1>Hello Admin!</h1>
        <div class="management" style="float:right;">
            <div class="scheduled" style="overflow: auto; height: 200px;">
                <h3>Previously Scheduled Trains</h3>
                <?php scheduledTrains($con);?>
            </div>
            <br>
            <div class="total" style="overflow: auto; height: 200px;">
                <h3>Total Trains</h3>
                <?php totalTrains($con);?>
            </div>
        </div>
        <div class="addition" style="float:left;">
            <h3>Schedule a Train</h3>
            <form method="post">
                <label for="t_number">Select a train number</label>
                <select id="t_number" name="t_number">
                    <?php trainNumber($con);?>
                </select>
                <br><br>
                <label for="date">Select the date</label>
                <input type="date" id="date" name="date"/>
                <br><br>
                <label for="ac_coaches">Number of AC Coaches</label>
                <input type="number" id="ac_coaches" name="ac_coaches" min="0"/>
                <br><br>
                <label for="sp_coaches">Number of Sleeper Coaches</label>
                <input type="number" id="sp_coaches" name="sp_coaches" min="0"/>
                <br><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>