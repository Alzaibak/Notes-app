<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember me
include('remember.php');

?>

<!doctype html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@1&display=swap" rel="stylesheet">
    <title>Notes</title>
</head>

<body>
  

    <!-- navigation bar-->
    <div class="container-fluid navigation">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Notes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Help</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Contact</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav pull-right">
                        <li class="nav-item">
                            <a class="nav-link active" href="#loginModal" data-bs-toggle="modal">Login</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" style="margin: 0; padding-top: 8px; padding-left: 0px;" class="btn signup" data-bs-target="#signupModal" data-bs-toggle="modal"> signup</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <!--body jumbotron-->
    <div class="jumbotron" id="main-container">
        <h1> Your online notes site</h1>
        <p> You can see your notes anywhere, anytime</p>
        <p> Your notes are protected and private </p>
        <button type="button" class="btn btn-lg yellow signup" data-bs-target="#signupModal" data-bs-toggle="modal"> Create an account</button>
        <button type="button" class="btn btn-lg yellow signup" data-bs-target="#loginModal" data-bs-toggle="modal"> See my notes</button>
    </div>

    <!--signin form-->
    <form method="post" id="loginform">
        <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-bs-dismiss="modal" type="buttom">
                    &times;
                  </button>
                        <h4 style="margin: 10px; text-align: center;" id="myModalLabel">
                            Login:
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Sign up message from PHP file-->
                        <div id="loginpmessage"></div>

                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email:" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only"></label>
                            <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
                        </div>
                    </div>
                    <div class="checkbox">
                        <label for="" style="width: 50%;"> <input type="checkbox" name="remeberme" id="rememberme"> remember me</label>
                        <a class="pull-right" data-bs-target="#forgotpasswordModal" data-bs-toggle="modal" data-bs-dismiss="modal">Forgot password?</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn pull-left" data-bs-dismiss="modal" data-bs-target="#signupModal" data-bs-toggle="modal"> Register </button>
                        <input class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="Sign in">

                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--forgot password form-->
    <form  method="post" id="forgotpasswordform">
        <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button class="close" data-bs-dismiss="modal" type="buttom">
                    &times;
                  </button>
                        <h4 style="margin: 10px; text-align: center;" id="myModalLabel">
                            Forgot your password?
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Sign up message from PHP file-->
                        <div id="forgotpasswordmessage"></div>

                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="email" name="forgotpasswordemail" id="forgotpasswordemail" placeholder="Please enter your email address" maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id='forgotpasswordbuttom' class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="submit">
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--signup form -->
    <form  method="post" id="signupform">
        <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button class="close" data-bs-dismiss="modal" type="buttom">
                    &times;
                  </button>
                        <h4 style="margin: 10px; text-align: center;" id="myModalLabel">
                            Create your account easily
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Sign up message from PHP file-->
                        <div id="signupmessage">  </div>

                        <div class="form-group">
                            <label for="username" class="sr-only"></label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only"></label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="password2" class="sr-only"></label>
                            <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="Sign up">

                    </div>
                </div>
            </div>
        </div>
    </form>



    <!-- footer-->
    <div class="container-fluid navigation footer">
        <div class="container">
            <p style="text-align: center; color: black; margin-top: 5px;">Created By <strong> Alzaibak Mohamad</strong></p>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
      //Ajax Call for the sign up form 
//Once the form is submitted
$(signupform).submit(function(event) {
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost,
        success: function(data) {
            if (data) {
                $("#signupmessage").html(data);
            }
        },
        error: function() {
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

        }

    });

});

//Ajax Call for the login form
//Once the form is submitted
$("#loginform").submit(function(event) {
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    //    console.log(datatopost);
    //send them to login.php using AJAX
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        success: function(data) {
            if (data == "success") {
                window.location = "account.php";
            } else {
                $('#loginpmessage').html(data);
            }
        },
        error: function() {
            $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

        }

    });

});


//Ajax Call for the forgot password form
//Once the form is submitted
$("#forgotpasswordform").submit(function(event) {
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    //    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: datatopost,
        success: function(data) {

            $('#forgotpasswordmessage').html(data);
        },
        error: function() {
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

        }
    });

    $("#cancel").click(function(event) {
    
    });


});
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>