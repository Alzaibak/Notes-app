<?php

//start session and connect
session_start();
include ('connection.php');


//Get username sent through Ajax
$missingemail = '<p><strong>Please enter your new email!</strong></p>';
$usedemail = '<p><strong>This email is already used!</strong></p>';

if(empty($_POST["editemail"])){
    $errors .= $missingemail; 
}

if(!empty($_POST["editemail"])){
    $currentemail = $_POST['editemail'];
    $email = mysqli_real_escape_string($link, $currentemail);
    $sql = "SELECT email FROM Users WHERE email = '".$email."'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1){
    $errors .= $usedemail; 
    };

};
if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;   
}else {
    $currentemail = $_POST['editemail'];
    $email = mysqli_real_escape_string($link, $currentemail);
    $id = $_SESSION['id'];
    $sql = "UPDATE Users SET email='$email' WHERE id='$id'";
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