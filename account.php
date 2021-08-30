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
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@1&display=swap" rel="stylesheet">
    <title>My account</title>
</head>

<body>
    <!-- navigation bar-->
    <div class="container-fluid navigation">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Notes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="account.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Help</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="profilepage.php">My notes</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav pull-rightp">
                        <li class="nav-item">
                            <a class="nav-link active" href="#loginModal" data-bs-toggle="modal">Hello <b>username</b></a>
                        </li>
                        <li class="nav-item">
                            <button type="button" style="margin: 0; padding-top: 8px; padding-left: 0px;" class="btn signup" data-bs-target="#signupModal" data-bs-toggle="modal"> Logout</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>



    <!--edit password form-->
    <form method="post" id="editpasswordform">
        <div class="modal" id="editpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-bs-dismiss="modal">
                    &times;
                  </button>
                        <h4 style="margin: 10px; text-align: center;" id="myModalLabel">
                            Edit password?
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Sign up message from PHP file-->
                        <div id="updatepasswordmessage"></div>

                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="password" name="oldpassword" id="oldpassword" placeholder="Please enter your old password" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="password" name="newpassword" id="newpassword" placeholder="Please enter your new password" maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" placeholder="Please confirm your new password" maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="submit">
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--edit username form-->
    <form method="post" id="editusernameform">
        <div class="modal" id="editusernameModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-bs-dismiss="modal">
                    &times;
                  </button>
                        <h4 style="margin: 10px; text-align: center;" id="myModalLabel">
                            Change username?
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Sign up message from PHP file-->
                        <div id="editusernamemessage"></div>

                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="text" name="editusername" id="editusername" placeholder="Please enter your new username" maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="submit">
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--edite email form-->
    <form method="post" id="emailchangeform">
        <div class="modal" id="emailchangeModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-bs-dismiss="modal">
                    &times;
                  </button>
                        <h4 style="margin: 10px; text-align: center;" id="myModalLabel">
                            Changed your Email?
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Sign up message from PHP file-->
                        <div id="editemailmessage"></div>

                        <div class="form-group">
                            <label for="email" class="sr-only"></label>
                            <input class="form-control" type="email" name="editemail" id="editemail" placeholder="Please enter your new email" maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn yellow" style="margin: 0; background-color: #fbb034; background-image: linear-gradient(315deg, #fbb034 0%, #ffdd00 74%);" name="signup" type="submit" value="submit">
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--body container-->

    <div class="table-responsive">
        <table class="table table-hover table-condensed" style="background-color:  #F2F2F2;">
            <tr data-bs-target="#editpasswordModal" data-bs-toggle="modal">
                <td>Password</td>
                <td>Value</td>
            </tr>
            <tr data-bs-target="#editusernameModal" data-bs-toggle="modal">
                <td>username</td>
                <td>valuse</td>
            </tr>
            <tr data-bs-target="#emailchangeModal" data-bs-toggle="modal">
                <td>Email</td>
                <td>value</td>
            </tr>
        </table>
    </div>


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
        // Ajax call to updateusername.php
            $("#editusernameform").submit(function(event){ 
        //prevent default php processing
            event.preventDefault();
            //collect user inputs
            var datatopost = $(this).serializeArray();
            //    console.log(datatopost);
            //send them to updateusername.php using AJAX
        $.ajax({
        url: "updateusername.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#editusernamemessage").html(data);
            }else{
                location.reload();   
            }
        },
        error: function(){
            $("#editusernamemessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
         });

            });

            // Ajax call to updatepassword.php
$("#editpasswordform").submit(function(event) {
        //prevent default php processing
        event.preventDefault();
        //collect user inputs
        var datatopost = $(this).serializeArray();
        //  console.log(datatopost);
         //send them to login.php using AJAX
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datatopost,
        success: function(data) {
            if (data == "success") {
                window.location = "updatepassword.php";
            } else {
                $('#updatepasswordmessage').html(data);
            }
        },
        error: function() {
            $("#updatepasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

        }

    });

});



            // Ajax call to updateemail.php
            $("#emailchangeform").submit(function(event){ 
                //prevent default php processing
                event.preventDefault();
                //collect user inputs
                var datatopost = $(this).serializeArray();
            //    console.log(datatopost);
                //send them to updateusername.php using AJAX
                $.ajax({
                    url: "updateemail.php",
                    type: "POST",
                    data: datatopost,
                    success: function(data){
                        if(data){
                            $("#editemailmessage").html(data);
                        }
                    },
                    error: function(){
                        $("#editemailmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                        
                    }
                
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