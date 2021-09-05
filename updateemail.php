<?php

//start session and connect
session_start();
include ('connection.php');


//Get username sent through Ajax
$currentemail = $_POST['useremail2'];
$missingCurrentemail = '<p><strong>Please enter your Current username!</strong></p>';
$missingnewusername = '<p><strong>Please enter your new username!</strong></p>';
$usedusername = '<p><strong>This Username is already used!</strong></p>';

if(empty($_POST["useremail2"])){
    $errors .= $missingCurrentemail; 
};

if (empty($_POST["editusername"])){
    $errors .= $missingnewusername; 

}else {
    $currentusername = $_POST['currentusername'];
    $username = mysqli_real_escape_string($link, $currentusername);
//$password = hash('sha256', $password);
        //Run query: Check combinaton of email & password exists
    $sql = "SELECT * FROM Users WHERE username = '$username'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if ($count !== 1) {
        echo '<div class="alert alert-danger">This username is not found</div>';
    }
};


//Run query and update username

if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;   
}else {  
    //else: No errors
    //Prepare variables for the query
    $currusername = $_POST["currentusername"];
    $currentusername = mysqli_real_escape_string($link, $currusername);
    $username = $_POST["editusername"];
    $usernamechange = mysqli_real_escape_string($link, $username);
    $sql = "SELECT username FROM Users WHERE username = '$currentusername'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $sql = "UPDATE Users SET username='$usernamechange' WHERE username='$currentusername'";
        $result = mysqli_query($link, $sql);
        echo '<div class="alert alert-info">your username is updated</div>';
        echo "<script> window.location.assign('account.php'); </script>";
    };
    
};



?>