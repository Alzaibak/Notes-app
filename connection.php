<?php
$link = new mysqli("localhost", "database-user", "database-password", "database-name");
if(mysqli_connect_error()){
    die('ERROR: Unable to connect:' . mysqli_connect_error()); 
    echo "<script>window.alert('Hi!')</script>";
}
    ?>