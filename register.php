
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

        if ($_REQUEST && $_REQUEST["formTrimis"] > 0) {

            $newUser = new User();                          
            $res = $newUser->addUser();                     
                    

            if ($res && $res['success']){
                $url = $_SESSION['lastPage'] ? $_SESSION['lastPage'] : $res['url'];
                echo '<script>window.location.replace("'.$url.'")</script>';
                unset($_SESSION['lastPage']);
            }
        }

    ?>
  
    <div class="mainContainer">

        <div class='formContainer register blur'>

            <form method="POST" action="" class="form">

                <input type="hidden" name="formTrimis" value="1">        

                <div class='inputContainer'>
                    <label for="nume">Nume:</label>
                    <input type="text" name="nume" id="nume" required>  
                </div>

                <div class='inputContainer'>
                    <label for="prenume">Prenume:</label>
                    <input type="text" name="prenume" id="prenume" required >
                </div>

                <div class='radioContainer'> 
                    <p> Sex: </p>
                    <div class="radioButton">
                        <input type="radio" name="sex" id="F" value="F" required >
                        <label for="F" > Feminin </label>
                    </div>
                    <div class="radioButton">
                        <input type="radio" name="sex" id="M" value="M">
                        <label for="M"> Masculin </label>
                    </div>
                </div>

                <div class="inputContainer">
                    <label for="varsta">Varsta:</label>
                    <input type="number" name="varsta" id="varsta" min="1" required>
                </div>

                <div class="inputContainer">
                    <label for="greutate"> Greutate: </label>
                    <input type="number" name="greutate" id="greutate" min="1" required>
                </div>

                <div class="radioContainer">
                    <p> Fumator: </p>
                    <input type="radio" name="fumator" id="fumator" value="1" required>
                    <label for="fumator"> Da </label>

                    <input type="radio" name="fumator" id="nefumator" value="0">
                    <label for="nefumator"> Nu </label>
                </div>

                <div class="radioContainer">
                    <p> Nivel: </p>
                    <input type="radio" name="nivel" id="inc" value="1" required>
                    <label for="inc"> Incepator</label>
                    
                    <input type="radio" name="nivel" id="med" value="2">
                    <label for="med"> Mediu </label>
                    
                    <input type="radio" name="nivel" id="av" value="3"> 
                    <label for="av"> Avansat </label>
                </div>

                <div class="inputContainer">
                    <label for="email"> Email: </label>
                    <input type="email" name="email" id="email" required>
                </div>
                
                <div class="inputContainer">
                    <label for="telefon"> Telefon: </label>
                    <input type="tel" name="telefon" id="telefon"  placeholder="07xx-xxx-xxx"  required> 
                </div>

                <div class="inputContainer">
                    <label for="parola">Introdu o parola:</label>
                    <input type="password"  name="parola" id='parola' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Parola trebuie sa contina cel putin 8 caractere, cel putin un numar si o litera mare " required>
                </div>
                

                <div class="inputContainer">
                    <label for="parola2">Repeta parola:</label>
                    <input type="password"  name="parola2" id='parola2' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Parola trebuie sa contina cel putin 8 caractere, cel putin un numar si o litera mare " required> 
                </div>

                <button type="submit" class="submitButton">Inregistreaza-te</button>

                </form>
        </div>
        
    </div>
  


</body>

</html>