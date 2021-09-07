<?php
session_start();
include('connection.php');

//get the user_id

$user_id = $_SESSION['id'];

 if (!$user_id) {
    session_destroy();
    echo "<script> window.location.assign('index.php'); </script>";
 } else {
     //run a query to delete empty notes
     //shows notes or alert message
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM notes WHERE user_id ='$user_id ' ORDER BY time DESC";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if ($count>0) {
        while ($row = $result->fetch_assoc()) {
            $note_id = $row['notid'];
            $note = $row['note'];
            $time = $row['time'];
            $time = date("F d, Y h:i:s A", $time);
            echo "
            <div class='note container' style='padding-top: 25px;'>
                <div class='row'>
                    <div class='offset-lg-3 col-lg-6 col-md-6 col-8'>
                        <div class='noteheader' id='note_id' style='color: currentcolor; background-color: ghostwhite; line-height: 1.0; padding: 5px; border: solid 1px black; border-radius: 5px;'>$note_id
                            <p class='text' style='text-align: center;'>$note</p>
                            <p class='timetext' style='font-size: 10px; margin-bottom: 0px; padding-bottom: 0px;'>$time</p>    
                        </div>
                    </div> 
                    <div class='col-lg-2 col-md-2 col-4 delete'>
                        <button class='btn' style='width: 85%; background-color: aliceblue; border-radius: 5px; box-shadow: black 2px 2px 2px;margin-bottom: 3px;'>Delete</button>
                    </div> 
                </div> 
            </div>";
        }
    } else {
        echo '<div class="alert alert-warning">You have not created any notes yet!</div>'; exit;
    }
    
 }
 
 ?>
