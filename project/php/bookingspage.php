<?php
    function bookedTrains($con){
        $credit = $_SESSION['booking_agent_credit'];

        $sql = "SELECT `PNRNumber`
                FROM `Train`.`books`
                WHERE `CreditCardNo.` = $credit;";

        if($result = $con -> query($sql)){
            while($row = $result->fetch_assoc()){
                $pnr = $row["PNRNumber"];

                echo '<h3>PNR Number '.$pnr.'</h3><br>';
                bookedPNR($con, $pnr);

            }
        }
    }

    function bookedPNR($con, $pnr){
        echo '<table border="1" cellspacing="2" cellpadding="2">
            <tr>
                <td>Passenger Name</td>
                <td>Passenger Age</td>
                <td>Passenger Gender</td>
                <td>Passenger Coach</td>
                <td>Passenger Berth</td>
            </tr>';

        $sql = "SELECT `passenger`.`Name`, `passenger`.`Age`, `passenger`.`Gender`, `rides`.`CoachNo.`, `rides`.`BerthNo.`
                FROM `Train`.`rides`, `Train`.`passenger`
                WHERE `rides`.`SNo.` = `passenger`.`SNo.`
                AND `rides`.`PNRNumber` = $pnr;";
        //$db = mysqli_select_db($con, 'train');
        //$sql = "SELECT * FROM `Train`.`scheduledtrains`";

        if($result = $con->query($sql)){
            while($row = $result->fetch_assoc()){
                $field1 = $row["Name"];
                $field2 = $row["Age"];
                $field3 = $row["Gender"];
                $field4 = $row["CoachNo."];
                $field5 = $row["BerthNo."];

                echo '<tr>
                        <td>'.$field1.'</td>
                        <td>'.$field2.'</td>
                        <td>'.$field3.'</td>
                        <td>'.$field4.'</td>
                        <td>'.$field5.'</td>
                    </tr>';
            }

            echo '</table>';
        }

        $result -> free();
    }
?>