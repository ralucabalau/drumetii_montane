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
    <title>Informatii traseu</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/5467eeebc0.js" crossorigin="anonymous"></script>
</head>
<body>

  <?php

    date_default_timezone_set('Europe/Bucharest');
    include("connection.php");
    include("functions.php"); 
    $_SESSION['traseuId']= $_REQUEST['id'];
    $_SESSION['lastPage']='http://localhost/drumetii/traseu.php?id='.$_REQUEST['id'];
    $loggedInUser = array_key_exists('userID', $_SESSION) ? $_SESSION['userID'] : "";

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
    $trail =$trailsMethods->getTrail(["traseuId"=>$_REQUEST['id']]);  

    

    if ($trail->num_rows > 0) {
      while($row = $trail->fetch_assoc()) {

        echo "
          <div class='trailContainer'>

            <div class='mapContainer'>
                <iframe src='".$row['harta']."'></iframe>
            </div>

            <div class='trailContainerWithoutMap'>
                  <div class='nameContainerTrail'>
                    <h2>".$row["nume"]. "</h2>
                  </div>
                  <div class='rowsAndImageInTrail'>
                    <div class='rowsInTrail'>
                        <h3> &nbsp <i class='fas fa-mountain' style='font-size:24px'></i> Detalii traseu </h3>    
                      
                        <div class='cardContainerRow trail'>
                            <div class='cardIcon'>
                              <i class='fa fa-bar-chart' aria-hidden='true'></i>
                            </div> 
                            <div class='cardInfoDetails'>
                              &nbsp Dificultate: <span class='spanDetails'> ". $row["dificultate"]. "</span>
                            </div>
                        </div>

                        <div class='cardContainerRow trail'>
                          <div class='cardIcon'>
                            <i class='fa fa-hourglass-end' aria-hidden='true'></i>
                          </div> 
                          <div class='cardInfoDetails'>
                            &nbsp Durata traseu: <span class='spanDetails'> ". $row["durata"]." </span>
                          </div>
                        </div>

                        <div class='cardContainerRow trail'>
                          <div class='cardIcon'>
                            <i class='fa fa-arrows-h' aria-hidden='true'></i>
                          </div> 
                          <div class='cardInfoDetails'>
                            &nbsp Lungime traseu: <span class='spanDetails'> ". $row["lungime"]." km</span>
                          </div>
                        </div>

                        
                        <div class='cardContainerRow trail'>
                          <div class='cardIcon'>
                            <i class='fa fa-arrows-v' aria-hidden='true'></i>
                          </div> 
                          <div class='cardInfoDetails'>
                            &nbsp Altitudine maxima: <span class='spanDetails'> ". $row["altmax"]." m</span>
                          </div>
                        </div>

                        <div class='cardContainerRow trail'>
                          <div class='cardIcon'>
                            <i class='fa fa-map-marker' aria-hidden='true'></i>
                          </div> 
                          <div class='cardInfoDetails'>
                            &nbsp Grupa montana: <span class='spanDetails'> ". $row["grupaMontana"]." </span>
                        </div>
                        </div>
                    </div>
                    <div class='imgInTrail'>
                      <img src='".$row["imagine"]."' alt='traseu' id='imgInTrail'>
                    </div>
                  </div>
                

            ";
          

        if( $loggedInUser !== "" ) {
          echo ($row["existaStartPeTraseu"] == 0                                        
              ? "<div class='cronFormContainer'>
                 <form class='cronForm' id='startForm' method='POST' action ='handleTime.php'>
                    <label for='start'></label><br>
                    <input type='hidden' name='startTime' value='".date("Y-m-d H:i:s")."' >
                    <input type='hidden' name='traseuId' value='".$_SESSION["traseuId"]."' >
                    <div class='buttonContainer'>
                      <input type='submit' id='start' class='button' value='Porneste la drum'>
                    </div> 
                  </form>
                  </div> "
              : 
              "   <div class='cronFormContainer'>
                  <form class='cronForm' id='stopForm' method='POST' action ='handleTime.php'>
                    <label for='stop'></label><br>  
                    <input type='hidden' name='stopTime' value='".date("Y-m-d H:i:s")."' >
                    <input type='hidden' name='traseuId' value='".$_SESSION["traseuId"]."' >
                    <div class='buttonContainer'>
                      <input type='submit' id='stop' class='button' value='Am terminat traseul!!!'>
                    </div> 
                  </form>
                  </div>"
                  );
        }

        else{
            echo"
                    <p>  &nbsp Logheaza-te sau creaza un cont pentru a cronometra parcurgerea fiecarui traseu </p> 
                    <div class='twoButtons'>
                      <button type='button' class='button simple'><a href='login.php'> Logare </a></button>
                      <button type='button' class='button simple'><a href='register.php'> Inregistrare </a></button>
                    </div>
                ";
        }

          echo "
              </div>
          </div>
         </div>";
      }
    } else {
      echo "0 results";
      }

    $conn->close();

    include('loggedIn.php');

  ?>

  <script src="app.js"></script>

</body>
</html>
