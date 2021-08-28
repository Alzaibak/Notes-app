<?php
//Start session
session_start();
//Connect to the database
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Reset</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            h1{
                color:purple;   
            }
            .contactForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style> 

    </head>
        <body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
            <h1>Reset Password:</h1>
            <div id="resultmessage"></div>

            <?php

//Check user inputs
    //Define error messages
$invalidemail =  '<p><strong>please enter your email</strong></p>';
$validationmessage = '<p><strong>Please click on the massage you recieved by email</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';


    //Get email 
    //Store errors in errors variable
if (empty($_POST["forgotpasswordemail"])) {
    $errors .= $invalidemail; 
} else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }}

    
    //If there are any errors
        //print error message
if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}


    //else: No errors
        //Prepare variables for the query
$email = mysqli_real_escape_string($link, $_POST['forgotpasswordemail']);
        //Run query to check if the email exists in the users table
$sql = "SELECT * FROM Users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>'; exit;
}
$count = mysqli_num_rows($result);


if($count == 1){
    $to = $email;
    $subject = "Reset your password on online notes";
    $msg = "please click on this to reset your password \"http://diphant.com/notes/notes/resetpassword.php";
    $msg = wordwrap($msg,70);
    $headers = "From: onlinenotes@diphant.com";
    mail($to, $subject, $msg, $headers);
    echo '<div class="alert alert-danger">We have e-mailed your password reset link!</div>';
}else {
    echo '<div class="alert alert-danger">That email does not exist on our database!</div>';  exit;
};


    ?>