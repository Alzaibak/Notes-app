
<?php
session_start();
include('connection.php');

$missingvalue = '<p><strong>The value should not be null</strong></p>';

if (!strlen(trim($_GET['textarea']))){
    $errors .= $missingvalue; 
}

if ($errors) {
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage; 
}
//get user_id
$user_id = $_SESSION['id'];
//get the current time
$time = time();
$note = $_GET['textarea'];
$usernote = mysqli_real_escape_string($link, $note);
//run a query to create new note
$sql = "INSERT INTO notes (`user_id`, `note`, `time`) VALUES ($user_id, '$usernote', '$time')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
}else{
    //mysqli_insert_id returns the auto generated id used in the last query
    echo mysqli_insert_id($link);
       
}
?>