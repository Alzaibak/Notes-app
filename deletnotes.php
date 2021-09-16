<?php
session_start();
include('connection.php');

//get the id of the note through Ajax
$note_id = $_GET['note_id'];
$usernote = mysqli_real_escape_string($link, $note_id);
// run a query to delete the note
$sql = "DELETE FROM notes WHERE noteid = $note_id";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';   
}

?>