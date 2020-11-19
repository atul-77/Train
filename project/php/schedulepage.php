<?php
    function scheduledTrains($con){
        echo '<table border="1" cellspacing="2" cellpadding="2">
            <tr>
                <td>Train Number</td>
                <td>#ofACCoaches</td>
                <td>#ofSleeperCoaches</td>
            </tr>';

        $sql = "SELECT * FROM `Train`.`scheduledtrains`";

        if($result = $con->query($sql)){
            while($row = $result->fetch_assoc()){
                $field1 = $row["TrainNo."];
                $field2 = $row["#ofACCoaches"];
                $field3 = $row["#ofSleeperCoaches"];

                echo '<tr>
                        <td>'.$field1.'</td>
                        <td>'.$field2.'</td>
                        <td>'.$field3.'</td>
                    </tr>';
            }

            echo '</table>';
        }
        $result -> free();
    }

    function totalTrains($con){
        echo '<table border="1" cellspacing="2" cellpadding="2">
            <tr>
                <td>Train Number</td>
                <td>Source</td>
                <td>Destination</td>
                <td>Departure Time</td>
                <td>Arrival Time</td>
            </tr>';

        $sql = "SELECT * FROM `Train`.`total train`";

        if($result = $con->query($sql)){
            while($row = $result->fetch_assoc()){
                $field1 = $row["TrainNo."];
                $field2 = $row["Source"];
                $field3 = $row["Destination"];
                $field4 = $row["DepartureTime"];
                $field5 = $row["ArrivalTime"];

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

    function trainNumber($con){
        $sql = "SELECT `TrainNo.` FROM `Train`.`total train`";

        if($result = $con->query($sql)){
            while($row = $result->fetch_assoc()){
                $t_number = $row["TrainNo."];
                echo '<option value='.$t_number.'>'.$t_number.'</option>';
            }
        }

        $result->free();
    }
?>