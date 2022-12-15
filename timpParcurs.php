<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro-RO">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Drumetii montane, trasee montane cu descrieri, harta trasee montane, hiking">
    <title> Trasee montane Romania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php

        date_default_timezone_set('Europe/Bucharest');
        include("connection.php");
        include("functions.php"); 


        echo "
            <nav class='navbar'>
                <div class='logoImg'>
                    <a href='index.php'>
                        <img src='img/logo.svg' alt='logo'>
                    </a>
                </div>

                <a href='#' class='toggleButton'>
                    <span class='bar'></span>
                    <span class='bar'></span>
                    <span class='bar'></span>
                </a>

                <div class='navbarLinks'>
                    <ul>
                        <li><a href='index.php'> Acasa </a></li>
                        <li><a href='trasee.php'> Trasee </a></li>
                    </ul>
                </div>
            </nav>";


        $trailsMethods = new Trails(); 
        $trail =$trailsMethods->getTrail(["traseuId"=>$_SESSION['traseuId']]);

        if ($trail->num_rows > 0) {
            while($row = $trail->fetch_assoc()) {

                $sql1 = "SELECT nume FROM users WHERE id = '".$_SESSION['userID']."' ";
                $res1 = $conn->query($sql1);
                $row1 = $res1->fetch_assoc();
            
                $sql2 = "SELECT nume FROM trasee WHERE id = '".$_SESSION['traseuId']."'";
                $res2 = $conn->query($sql2);
                $row2 = $res2->fetch_assoc();
            
                $sql3 = "SELECT diferenta FROM rezultate WHERE id='".$_SESSION['idInregCurenta']."' ";
                $res3 = $conn->query($sql3);
                $row3 = $res3->fetch_assoc();

                echo "
                    <div class='mainContainer'>
                        <div class='congratsContainer'>
                            <h2><center> Felicitari <span class='blueText'>".$row1['nume']."</span> !</center><center> Ai parcurs traseul </center> <center><span class='blueText'>".$row2['nume']."</center></span> <center> in </center><span class='blueText'> <center> ".$row3['diferenta']." min</center></span> </h2>
                        </div>
                    </div>";
            }
        }

    ?>

    <script src="app.js"></script>

</body>
</html>


