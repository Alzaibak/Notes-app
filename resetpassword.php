<!--This file receives the user_id and key generated to create the new password-->
<!--This file displays a form to input new password-->

<?php
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Reset</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@1&display=swap" rel="stylesheet">
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

    <form action = "resetpassword.php" method="post" id="forgotpasswordform">
            <div id="forgotpasswordModal">
            <div>
                <div>
                    <div>   
                    <div>

                        <!--Sign up message from PHP file-->
                        <div id="forgotpasswordmessage"></div>

                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="email" name="forgotpasswordemail" id="forgotpasswordemail" placeholder="Please enter your email address" maxlength="50">
                            <input class="form-control" type="password" name="old_password" id="old_password" placeholder="Please enter your old password" maxlength="50">
                            <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Please enter your new password" maxlength="50">
                            <input class="form-control" type="password" name="new_password2" id="new_password2" placeholder="Please confirm your new password" maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                       </button>
                        <input id='forgotpasswordbuttom' class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="submit">
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="jscode.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php

$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingoldPassword = '<p><strong>Please enter your old Password!</strong></p>';
$missingnewPassword = '<p><strong>Please enter your new Password!</strong></p>';
$invalidoldPassword = '<p><strong>Your old password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$invalidnewPassword2 = '<p><strong>Your new password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';



//    <!--Get username, email, password, password2-->
//Get email

if(empty($_POST["forgotpasswordemail"])){
    $errors .= $missingEmail;   
}else{
    $email = filter_var($_POST["forgotpasswordemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;   
    }
}
//Get old passwords
if(empty($_POST["old_password"])){
    $errors .= $missingoldPassword; 
}elseif(!(strlen($_POST["old_password"])>6
         and preg_match('/[A-Z]/',$_POST["old_password"])
         and preg_match('/[0-9]/',$_POST["old_password"])
        )
       ){
    $errors .= $invalidoldPassword; 
}else{
    $password = filter_var($_POST["old_password"], FILTER_SANITIZE_STRING);}

//Get new passwords
if(empty($_POST["new_password"])){
    $errors .= $missingnewPassword; 
}elseif(!(strlen($_POST["new_password"])>6
         and preg_match('/[A-Z]/',$_POST["new_password"])
         and preg_match('/[0-9]/',$_POST["new_password"])
        )
       ){
    $errors .= $invalidPassword2; 
}else{
    $password = filter_var($_POST["new_password"], FILTER_SANITIZE_STRING); 
    if(empty($_POST["new_password2"])){
        $errors .= $missingPassword2;
    }else{
        $password2 = filter_var($_POST["new_password2"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
}
//If there are any errors print error
if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
};





    //Store them in two variables
$user_id = $_GET['user_id'];
$key = $_GET['rkey'];
$time = time() - 86400;
    //Prepare variables for the query
$user_id = mysqli_real_escape_string($link, $user_id);
$key = mysqli_real_escape_string($link, $key);
    //Run Query: Check combination of user_id & key exists and less than 24h old
$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>'; exit;
}
//If combination does not exist
//show an error message
$count = mysqli_num_rows($result);
//if($count !== 1){
   // echo '<div class="alert alert-danger">Please try again.</div>';
  //  exit;
//}
//print reset password form with hidden user_id and key fields


?>
            
        </div>
    </div>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
            <!--Script for Ajax Call to storeresetpassword.php which processes form data-->
            <script>
             //Once the form is submitted
             $("#forgotpasswordbuttom").submit(function(event){ 
                //prevent default php processing
                event.preventDefault();
                //collect user inputs
                var datatopost = $(this).serializeArray();
            //    console.log(datatopost);
                //send them to signup.php using AJAX
                $.ajax({
                    url: "resetpassword.php",
                    type: "POST",
                    data: datatopost,
                    success: function(data){

                        $('#resultmessage').html(data);
                    },
                    error: function(){
                        $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

                    }

                });

            });           
            
            </script>
        </body>
</html>
