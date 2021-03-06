<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember me
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
    <title>My profile</title>
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
                            <a class="nav-link active" href="#loginModal" data-bs-toggle="modal">Hello <b><?php $username ?></b></a>
                        </li>
                        <li class="nav-item">
                            <button type="button" style="margin: 0; padding-top: 8px; padding-left: 0px;" class="btn signup" data-bs-target="#signupModal" data-bs-toggle="modal"> Logout</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <!--body container-->
           <!--body jumbotron-->
    <div class="jumbotron" id="main-container">
        <h1> Thank your for your registration</h1>
        <p> You can see your notes anywhere, anytime</p>
        <a href="profilepage.php"><button type="button" class="btn btn-lg yellow signup"> enter to my notes</button></a>
        
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
    <script src="jscode.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>