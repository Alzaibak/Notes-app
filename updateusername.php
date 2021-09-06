<?php

//start session and connect
session_start();
include ('connection.php');


//Get username sent through Ajax
$missingusername = '<p><strong>Please enter your Current username!</strong></p>';
$missingnewusername = '<p><strong>Please enter your new username!</strong></p>';
$usedusername = '<p><strong>This Username is already used!</strong></p>';

if(empty($_POST["editusername"])){
    $errors .= $missingusername; 
};

if(!empty($_POST["editusername"])){
    $currentusername = $_POST['editusername'];
    $username = mysqli_real_escape_string($link, $currentusername);
    $sql = "SELECT username FROM Users WHERE username = '".$username."'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1){
    $errors .= $usedusername; 
    };

};
if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;   
}else {
    $currentusername = $_POST['editusername'];
    $username = mysqli_real_escape_string($link, $currentusername);
    $id = $_SESSION['id'];
    $sql = "UPDATE Users SET username='$username' WHERE id='$id'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }else {
        echo '<div class="alert alert-info">your username is updated</div>';
        session_destroy();
        echo "<script> window.location.assign('index.php'); </script>";
    }
};


?>