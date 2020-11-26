<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        yo yo mybs <br>
        <?php
            session_start();
            // Don't access without logging in!
            if($_SESSION['sid'] != session_id()){
                header("Location: bookingAgentLogin.php");
            }

            include('config.php');

            $credit = $_SESSION["booking_agent_credit"];
            $berth_num = -1;
            $coach_num = -1;
            $last_id = -1;

            $names = array();
            $ages = array();
            $genders = array();

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST['name'])){
                    $names = $_POST['name'];
                }
                if(isset($_POST['age'])){
                    $ages =  $_POST["age"];
                }
                if(isset($_POST['gender'])){
                    $genders = $_POST["gender"];
                }
            }

            $numPassengers = $_SESSION["passengersNum"];
            $numAvailable = $_SESSION["availableNum"];
            $rNum = $_SESSION["rNum"];
            $trainnum = $_SESSION["trainNum"];
            $coach = $_SESSION["coach"];

            $PNR = strval(time()).strval($trainnum);
            $ticket_add = "CALL `Train`.add_train_ticket('".$PNR."', '".$credit."', $trainnum);";

            if (!$con -> query($ticket_add)) {
                echo "CALL failed: (" . $con->errno . ") " . $con->error;
            }
            //mysqli_query($con, $ticket_add);
            
            for($i=0;$i<$numPassengers;++$i){
                $passenger_add = "INSERT INTO `Train`.`passenger` (`Name`, `Age`, `Gender`) VALUES ('".$names[$i]."', '".$ages[$i]."', '".$genders[$i]."');";
                mysqli_query($con, $passenger_add);

                $last_id = mysqli_insert_id($con);
                if($coach_num % $rNum != 0){
                    $coach_num = $coach . (ceil( $numAvailable / $rNum));
                }
                else{
                    $coach_num = $coach . (($numAvailable / $rNum) + 1); 
                }
                $berth_num = ($numAvailable % $rNum) + 1; 
                $numAvailable = $numAvailable - 1;

                $rides_add = "INSERT INTO `Train`.`rides` (`PNRNumber`,`SNo.`,`CoachNo.`,`BerthNo.`) VALUES ('".$PNR."', $last_id, $coach_num, $berth_num);";
                $result = mysqli_query($con, $rides_add);
            }

            $con->close();
            header("Location: ./../mybookings.php");
        ?>
        
    </div>
</body>
</html>