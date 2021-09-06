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

//check for errors

if(empty($_POST["oldpassword"])){
    $errors .= $missingCurrentPassword;
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


if(!empty($_POST["oldpassword"])){
    $currentpassword = $_POST["oldpassword"];
    $currentpassword2 = mysqli_real_escape_string($link, $currentpassword);
    $id = $_SESSION['id'];
    //$password = hash('sha256', $password);
    $sql = "SELECT * FROM Users WHERE id = '".$id."' && password = '".$currentpassword2."'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if($count !== 1){
    $errors .= $incorrectCurrentPassword; 
    };
    
}
//if there is an error print error message
if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;   
}else {
    
    //else: No errors
    //Prepare variables for the query
    $newpassword = $_POST["newpassword"];
    $updatedpassword = mysqli_real_escape_string($link, $newpassword);
    $id = $_SESSION['id'];
    //$password = hash('sha256', $password);
        //Run query: Check combinaton of email & password exists
        $sql = "UPDATE Users SET password='$updatedpassword' WHERE id='$id'";
        $result = mysqli_query($link, $sql);
        if ($result) {
            echo '<div class="alert alert-info">your password is updated</div>';
            session_destroy();
            echo "<script> window.location.assign('index.php'); </script>";
        }else {
            echo '<div class="alert alert-danger">Somthing went wrong please try again</div>';

        }
   
} 



?>