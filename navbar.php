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
        $userLogat = array_key_exists('userID', $_SESSION) ? $_SESSION['userID'] : "";
        echo "
        <nav class='navbar'>
            <div class='logoImg'>
                
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
    
                if($userLogat === "") {
                echo "
                            <li><a href='login.php'> Login </a></li>  
                        </ul>
                    </div>
                </nav>";
                }

                if(isset($_REQUEST['logout'])){
                    unset($_SESSION['userID']);
                    echo"<script>window.location.href=".$_SESSION['lastPage']."</script>";
                }
    
                else { echo "<li>
                        <form  action='' method='POST'>
                        <input type='submit' name='logout' value='LOGOUT'>
                        </li>
                        </ul>
                    </div>
                </nav>";
                }
    
       
    ?>


    <script src='app.js'></script>
</body>
</html>