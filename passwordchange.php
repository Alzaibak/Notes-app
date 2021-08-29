<?php

//Start session
session_start();
//Connect to the database
include("connection.php");

$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingnewPassword = '<p><strong>Please enter your new Password!</strong></p>';
$invalidnewPassword2 = '<p><strong>Your new password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';



//    <!--Get username, email, password, password2-->
//Get email

if (empty($_POST["forgotpasswordemail"])) {
    $errors .= $missingEmail;   
} else {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;   
    };
};



//Get old passwords   $email = filter_var($_POST["forgotpasswordemail"], FILTER_SANITIZE_EMAIL);

//if(empty($_POST["old_password"])){
  //  $errors .= $missingoldPassword; 
//}elseif(!(strlen($_POST["old_password"])>6
       //  and preg_match('/[A-Z]/',$_POST["old_password"])
       //  and preg_match('/[0-9]/',$_POST["old_password"])
      //  )
     //  ){
   // $errors .= $invalidoldPassword; 
//}else{
  //  $password = filter_var($_POST["old_password"], FILTER_SANITIZE_STRING);};

//Get new passwords
if (empty($_POST["new_password"])){
    $errors .= $missingnewPassword; 

} elseif (!(strlen($_POST["new_password"])>6
and preg_match('/[A-Z]/',$_POST["new_password"])
and preg_match('/[0-9]/',$_POST["new_password"])
)
){
$errors .= $invalidnewPassword2; 
}else {
    $password = filter_var($_POST["new_password"], FILTER_SANITIZE_STRING);
    if (empty($_POST["confirm_password"])) {
        $errors .= $missingnewPassword2;
    } else {
        $password2 = filter_var($_POST["confirm_password"], FILTER_SANITIZE_STRING);
        if ($password !== $password2) {
            $errors .= $differentPassword;
        }
    }
    
}


//If there are any errors print error

if ($errors) {
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;  
} else {
    //else: No errors
    //Prepare variables for the query
    $useremail = $_POST["forgotpasswordemail"];
    $email = mysqli_real_escape_string($link, $useremail);
    $newpassword = $_POST["new_password"];
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
    } else {
        echo '<div class="alert alert-danger">Your email is not found</div>';
    }
    
}

?>
