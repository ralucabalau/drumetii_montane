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
    
</head>

<body>


     <?php

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

        include("functions.php");

        if ($_REQUEST && $_REQUEST["formTrimis"] > 0)  {

            $newUser = new User();
            $res = $newUser->userLogin();        

            if ($res && $res['success']){
                $url = $_SESSION['lastPage'] ? $_SESSION['lastPage'] : $res['url'];
                echo '<script>window.location.replace("'.$url.'")</script>';
                unset($_SESSION['lastPage']);
            }
        }

     
    ?>


    <div class="mainContainer">
        
        <div class="formContainer blur">

            <form action="" method="POST" class="form">
                <input type="hidden" name="formTrimis" value="1">

                <div class="inputContainer">
                    <label for="email">Email</label>
                    <input type="email"  name="email" id="email">
                </div>

                <div class="inputContainer">
                    <label for="parola">Parola</label>
                    <input type="password"  name="parola" id="parolalog"><br>
                </div>

                <button type="submit" class="submitButton">Logare</button>

                <div class="registerSmallText">
                    <a href="register.php">Nu ai un cont? Inregistreaza-te aici</a>
                </div>
            </form>

        </div>

    </div>


  
  <script src = "app.js"></script>
</body>

</html>