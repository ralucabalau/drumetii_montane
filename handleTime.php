  <?php 
    session_start();

    include('navbar.php');
    include("connection.php");
    
    $start = array_key_exists("startTime", $_REQUEST)? $_REQUEST['startTime'] : "";
    $stop  = array_key_exists("stopTime", $_REQUEST) ? $_REQUEST['stopTime'] : "";


    if($start) {
 
        $sql= " INSERT INTO rezultate SET 
                `start`  = '".$start."', 
                userID   = '".$_SESSION["userID"]."',
                traseuID = '".$_REQUEST["traseuId"]."'" ;
        
        $conn->query($sql);  

        $idInregCurenta= mysqli_insert_id($conn);               
       
        $_SESSION['idInregCurenta'] = $idInregCurenta;
        $_SESSION['startTime'] = $start;  
        $_SESSION['traseuId']= $_REQUEST['traseuId'];         
        
        $url='traseu.php?id='.$_SESSION['traseuId'];
        echo'<script>window.location.replace("'.$url.'")</script>';
    }

        

    if($stop) {
        
        $sql= "UPDATE rezultate SET 
                    inchis = '1',
                    `stop` ='".$stop."',
                    diferenta = TIMEDIFF('".$stop."','".$_SESSION['startTime']."')  
                WHERE
                    userID ='".$_SESSION["userID"]."'AND
                    traseuID = '".$_SESSION["traseuId"]."' AND
                    id='".$_SESSION['idInregCurenta']."'"."
                    ORDER BY id DESC
                    LIMIT 1" ;  

        $conn->query($sql);                                    
        

        $_SESSION['traseuId']= $_REQUEST['traseuId'];

        $url ='timpParcurs.php';
        echo'<script>window.location.replace("'.$url.'")</script>';
        
    }
                
?>



