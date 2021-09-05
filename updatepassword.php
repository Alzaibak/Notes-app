<?php
//start session and connect
session_start();
include ('connection.php');

//define error messages
$missingCurrentPassword = '<p><strong>Please enter your Current Password!</strong></p>';
$incorrectCurrentPassword = '<p><strong>The password entered is incorrect!</strong></p>';
$missingPassword = '<p><strong>Please enter a new Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
$missingEmail = '<p><stong>Please enter your email address!</strong></p>';

//check for errors

if(empty($_POST["useremail"])){
    $errors .= $missingEmail;   
}else{
    $email = filter_var($_POST["useremail"], FILTER_SANITIZE_EMAIL);
}

if(empty($_POST["oldpassword"])){
    $errors .= $missingCurrentPassword;
}else{
    $oldpassword = filter_var($_POST["oldpassword"], FILTER_SANITIZE_STRING);
    $useremail = $_POST["useremail"];
    $email = mysqli_real_escape_string($link, $useremail);
    $currentpassword = $_POST["oldpassword"];
    $currentpassword2 = mysqli_real_escape_string($link, $currentpassword);
//$password = hash('sha256', $password);
        //Run query: Check combinaton of email & password exists
    $sql = "SELECT * FROM Users WHERE email = '$email' && password = '$currentpassword2'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if ($count !== 1) {
        echo '<div class="alert alert-danger">Wrong email or password</div>';
    }
    
}


if(empty($_POST["newpassword"])){
    $errors .= $missingPassword; 
}elseif(!(strlen($_POST["newpassword"])>6
         and preg_match('/[A-Z]/',$_POST["newpassword"])
         and preg_match('/[0-9]/',$_POST["newpassword"])
        )
       ){
    $errors .= $invalidPassword; 
}else{
    $password = filter_var($_POST["newpassword"], FILTER_SANITIZE_STRING); 
    if(empty($_POST["confirmpassword"])){
        $errors .= $missingPassword2;
    }else{
        $password2 = filter_var($_POST["confirmpassword"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
}

//if there is an error print error message
if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;   
}else {
    
    //else: No errors
    //Prepare variables for the query
    $useremail = $_POST["useremail"];
    $email = mysqli_real_escape_string($link, $useremail);
    $newpassword = $_POST["newpassword"];
    $updatedpassword = mysqli_real_escape_string($link, $newpassword);
//$password = hash('sha256', $password);
        //Run query: Check combinaton of email & password exists
    $sql = "SELECT email FROM Users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query!</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $sql = "UPDATE Users SET password='$updatedpassword' WHERE email='$email'";
        $result = mysqli_query($link, $sql);
        echo '<div class="alert alert-info">your password is updated</div>';
        echo "<script> window.location.assign('account.php'); </script>";
    } else {
        echo '<div class="alert alert-danger">Your email is not found</div>';
    }
    
};


?>