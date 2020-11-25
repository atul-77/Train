<?php
    // if (isset($_POST['Submit'])) {
        echo "Booking portal php tag here<br>";
        include('php/config.php');

        session_start();

        $trainnum = 0;
        $coachType =  0;
        $numPassengers = 0;
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['trainnum'])){
                $trainnum = $_POST['trainnum'];
            }
            if(isset($_POST['coachType'])){
                $coachType =  $_POST["coachType"];
            }
            if(isset($_POST['numPassengers'])){
                $numPassengers = $_POST["numPassengers"];
            }
        
            $checkAvailable;
            $rType;
            $rNum;
            echo $trainnum;
            echo "<br>";
            if($coachType=="AC" || $coachType=="ac"){
                $rType = "#ofACRemaining";
                $rNum = 18;
            }
            else{
                $rType = "#ofSleeperRemaining";
                $rNum = 24;
            }

            $checkAvailable = "SELECT `$rType` 
                            FROM  `Train`.`scheduledtrains` 
                            WHERE `TrainNo.` = $trainnum;";
            $numAvailable = mysqli_query($con, $checkAvailable);
            // echo ;

            $available = $numAvailable->fetch_row()[0];
            // echo $available;

            if($numAvailable->num_rows==0 or $available < $numPassengers){
                echo "Regret, tickets can't be booked for this many people <br>";
            }
            else{
                $_SESSION["rNum"] = $rNum;
                $_SESSION["trainNum"] = $trainnum;
                $_SESSION["availableNum"] = $available;
                $_SESSION["passengersNum"] = $numPassengers;

                $updated_seats = $available - $numPassengers;
                $update = "UPDATE `Train`.`scheduledtrains` 
                        SET `$rType` = $updated_seats  
                        WHERE `TrainNo.` = $trainnum;";
                mysqli_query($con, $update);

                // echo $update;

                echo '<form action="php/booked.php" method = "POST">';

                for($i=0;$i<$numPassengers;++$i){
                    echo '<input type="text" name="name[]" id="name" placeholder="Enter the passenger ('.$i.') name here">
                    <input type="text" name="age[]" id="age" placeholder="Enter the passenger ('.$i.') age here">
                    <input type="text" name="gender[]" id="gender" placeholder="Enter the passenger ('.$i.') gender here">'; 
                    echo "<br><br>";
                }
                
                echo '<button class="btn">';
                echo 'Submit button';
                echo '</button>';
                echo "</form>";

            }
        }
        
    
        //1: to see if ticket can be booked (T)
        //2: to deduct the number of tickets booked from #remainseats.. (T) 
        //3: to generate the PNR number
        //4: 
        // $con->close();
    // }
    
?>