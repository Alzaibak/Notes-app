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
<div class="container">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
            <h1>Reset Password:</h1>
            <div id="resetpassworderrors"></div>
            <form method="post" id="resetpasswordform">
            <div id="forgotpasswordModal">
            <div>
                <div>
                    <div>   
                    <div>
                        <!--Sign up message from PHP file-->
                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="email" name="forgotpasswordemail" id="forgotpasswordemail" placeholder="Please enter your email address" maxlength="50">
                            <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Please enter your new password" maxlength="50">
                            <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Please confirm your new password" maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                       </button id='forgotpasswordbuttom'>
                        <input id='forgotpassword' class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="submit">
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
        </div>
    </div>       
    
</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
            <!--Script for Ajax Call to passwordchange.php which processes form data-->
            <script>
             //Once the form is submitted
             $("#resetpasswordform").submit(function(event){ 
                //prevent default php processing
                event.preventDefault();
                //collect user inputs
                var datatopost = $(this).serializeArray();
            //    console.log(datatopost);
                //send them to passwordchange.php using AJAX
                $.ajax({
                    url: "passwordchange.php",
                    type: "POST",
                    data: datatopost,
                    success: function(data){

                        $("#resetpassworderrors").html(data);
                    },
                    error: function(){
                        $("#resetpassworderrors").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

                    }

                });

            });           
            
            </script>
            </body>
        </body>
</html>

