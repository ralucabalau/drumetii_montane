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
      <title>Trasee Montane Romania</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://kit.fontawesome.com/5467eeebc0.js" crossorigin="anonymous"></script>
  </head>


  <body>
    <?php

      $loggedInUser = array_key_exists('userID', $_SESSION) ? $_SESSION['userID'] : "";

      echo "
        <nav class='navbar'>
            <div class='logoImg'>
                <img src='img/logo.svg'>
            </div>

            <a href='#' class='toggleButton'>
                <span class='bar'></span>
                <span class='bar'></span>
                <span class='bar'></span>
            </a>

            <div class='navbarLinks'>
                <ul>
                    <li><a href='index.php'> Acasa </a></li>
                    <li><a href='trasee.php'> Trasee </a></li>";

            if($loggedInUser === "") {
              echo "
                        <li><a href='login.php'> Logare</a></li>  
                      </ul>
                  </div>
              </nav>";
            }

            else { echo "
                        <li>
                          <form  action='' method='POST'>
                          <input type='submit' name='logout' class='logout' value='Log out'>
                        </li>
                </ul>
            </div>
        </nav>";
            }


      if(isset($_REQUEST['logout'])){
          unset($_SESSION['userID']);
          echo"<script>window.location.href='http://localhost/drumetii/'</script>";
      }
    
      echo"<div class='upperContainer'></div>";  


      $_SESSION['lastPage']='http://localhost/drumetii/';
      include("functions.php");   
                                
      $trailsMethods = new Trails();                           
      $trails = $trailsMethods->getTrails(['limit'=>4]);       
                                                              
      if ($trails->num_rows > 0) {
        echo "<div class='cardsContainer'>";
        while($row = $trails->fetch_assoc()) {                                     
            echo"
            <a class='cardContainer' href='traseu.php?id=".$row["id"]. "'>

              <div class='cardContainerUpper'>
                <div class='imgContainer'>
                  <img src='". $row['imagine']."'>
                </div>
                <div class='nameContainer'>
                  <h2>". $row["nume"]."</h2>
                </div>
              </div> 

              <div class='cardContainerInfo'>

                <div class='cardContainerRow'>
                    <div class='cardIcon'>
                      <i class='fa fa-bar-chart' aria-hidden='true'></i>
                    </div> 
                    <div class='cardInfoDetails'>
                      &nbsp Dificultate: <span class='spanDetails'> ". $row["dificultate"]. "</span>
                    </div>
                </div>

                <div class='cardContainerRow'>
                  <div class='cardIcon'>
                    <i class='fa fa-hourglass-end' aria-hidden='true'></i>
                  </div> 
                  <div class='cardInfoDetails'>
                    &nbsp Durata traseu: <span class='spanDetails'> ". $row["durata"]." </span>
                  </div>
                </div>

                <div class='cardContainerRow'>
                  <div class='cardIcon'>
                    <i class='fa fa-arrows-h' aria-hidden='true'></i>
                  </div> 
                  <div class='cardInfoDetails'>
                    &nbsp Lungime traseu: <span class='spanDetails'> ". $row["lungime"]." km</span>
                  </div>
                </div>

                <div class='cardContainerRow'>
                  <div class='cardIcon'>
                    <i class='fa fa-map-marker' aria-hidden='true'></i>
                  </div> 
                  <div class='cardInfoDetails'>
                    &nbsp Grupa montana: <span class='spanDetails'> ". $row["grupaMontana"]." </span>
                  </div>
                </div>
              </div>
              
            </a>";
        }
        echo "</div>";
      } 
      else  {
              echo "0 results";
            }

    
     
    

      echo "<div class='buttonContainer'>
          <button class='button'><a href='trasee.php'>Vezi toate traseele</a></button>
        </div>";


      include("loggedIn.php");
    ?>

    <script src="app.js"></script>
</body>
</html>