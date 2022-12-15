<?php
    include("connection.php");

    if(isset($_SESSION['userID'])) {
        $sql = "SELECT nume FROM users WHERE id = '".$_SESSION['userID']."'";
        $res = $conn->query($sql);
        $row = mysqli_fetch_assoc($res);
        echo "<div> &nbsp User ".$row['nume']." logat</div>";
        }


?>