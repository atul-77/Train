<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP coding</title>
</head>
<style>
.container{
    max-width = 80%;
    background-color: green;
    padding: 25px;
    margin: auto;
}

</style>
<body>

    <div class="container">
    <h1>Heading</h1>
    <?php
        if(1<2){
            echo "<br>the stat is true yo. <br>";
        }
        $ar = array(1,"dog","doggo");
        for($i=0;$i<count($ar);++$i){
            echo $ar[$i];
            echo "<br>";
        }
        function funct($num){
            echo "<br> The number is $num <br>";
        }
        for($i = 1 ;$i<10;++$i){
            funct($i);
        }
        sort($ar);
        foreach($ar as $val){
            echo "foreach loop prints: $val <br>";
        }
        $thistr = "atul";
        echo "the len is : ".strlen($thistr);
    ?>
    </div>
</body>
</html>