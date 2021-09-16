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
    <title>My profile</title>
    <style>

        #notearea, #allNotes, #done, .delete, #add{
            display: none;   
        }

        .buttons{
            margin-bottom: 20px;   
        }

        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #CA3DD9;
            color: #CA3DD9;
            background-color: #FBEFFF;
            padding: 10px;
              
        }
        
        .noteheader{
            border: 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            background: linear-gradient(#FFFFFF,#ECEAE7);
        }
          
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
          
        .timetext{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .notes{
            margin-bottom: 100px;
        }

      </style>
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
                        <a class="nav-link active" href="#loginModal" data-bs-toggle="modal">Hello <b><?= $_SESSION['username']?></b></a>
                        </li>
                        <li class="nav-item">
                        <a href="index.php?logout=1" style="margin: 0; padding-top: 8px; padding-left: 0px;" class="btn logout" id="logout"> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <!--body container-->

    <div class=" container" id="container">

        <div id="alert" class="alert alert-danger" style="display: none;">
            <a data-bs-dismiss="alert" class="close">
                &times;
            </a>
            <p class="alertContent" id="alertContent"></p>
        </div>

        <div class="col-md-offset-3 col-md-6 col-12">

        </div>

        <div class="text-align">
            <button id="addnote" class="btn btn-lg yellow" type="button" style="min-width: 10%;"> Add Note</button>
            <button id="add" name="add" class="btn btn-lg yellow" type="button" style="min-width: 10%;"> Add</button>
            <button id="edit" class="btn btn-lg yellow" type="button" style="min-width: 10%;"> Edit</button>
            <button id="done" class="btn btn-lg yellow" type="button" style="background-color:#C3F700; min-width: 10%;"> Done</button>
            <button id="allnotes" class="btn btn-lg yellow" type="button" style="min-width: 10%;"> All notes</button>
        </div>
        <div id="notearea">
            <textarea name="textarea" id="textarea" name="textarea" cols="30" rows="10"></textarea>
        </div>
       

        <div id="notes" class="notes">

        </div>
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
        $(function(){
    //define variables
    var activeNote = 0;
    var editMode = false;
    //show notes on page load: Ajax call to shownotes.php
    $.ajax({
        url: "shownotes.php",
        success: function (data){
            $('#notes').html(data);
            clickonNote();
            clickonDelete();
            
        },
        error: function(){
            $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                    $("#alert").fadeIn();
        }
    
    });
    

    $("#addnote").click(function(){
        //siwtch to non edit mode
        editMode = false;
       //expand notes
        //$(".noteheader").removeClass("col-xs-7 col-sm-9");
        //show hide elements
        showHide(["#notearea", "#allnotes" ,"#add"], ["#notes", "#addnote", "#edit", "#done"]);
        $("textarea").focus();
    });

    //add a new note: : Ajax call to createnote.php
    $('#add').click(function(){
        $.ajax({
            url: "addnotes.php",
            success: function(data){
                if(data == 'error'){
                    //$("#alert").css("display", "block");
                    $('#alertContent').text("There was an issue inserting the new note in the database!");
                }else{
                    //update activeNote to the id of the new note
                    activeNote = data;
                    $("textarea").val("");
                    //show hide elements
                    showHide(["#notearea", "#allnotes" ,"#add"], ["#notes", "#addnote", "#edit", "#done" ]);
                    $("textarea").focus();
                    
                }
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                    $("#alert").fadeIn();
            }
        
        
        });
    
    
    });
    //type note: : Ajax call to updatenote.php
    $("textarea").keyup(function(){
        //ajax call to update the task of id activenote
        $.ajax({
            url: "updatingnotes.php",
            type: "POST",
            //we need to send the current note content with its id to the php file
            data: {note: $(this).val(), id:activeNote},
            success: function (data){
                if(data == 'error'){
                    $('#alertContent').text("There was an issue updating the note in the database!");
                    $("#alert").fadeIn();
                }
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
            }

        });
        
    });
    
    //click on all notes button
    $("#allnotes").click(function(){
        $.ajax({
            url: "shownotes.php",
            success: function (data){
                $('#notes').html(data);
                showHide(["#addnote", "#edit", "#notes"], ["#allnotes", "#notearea" ,"#add"]);
                clickonNote(); clickonDelete();
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
            }

        });
    
    });
    
    //click on done after editing: load notes again
    $("#done").click(function(){
        //siwtch to non edit mode
        editMode = false;
       //expand notes
        //$(".noteheader").removeClass("col-xs-7 col-sm-9");
        //show hide elements
        showHide(["#edit"],[this,".delete"]);
    });
    
    
    //click on edit: go to edit mode (show delete buttons, ...)
    $("#edit").click(function(){
        //switch to edit mode
        editMode = true;
        //reduce the width of notes
       // $(".noteheader").addClass("col-xs-7 col-sm-9");
        //show hide elements
        showHide(["#done", ".delete"],[this]);
    
    });
    
    //functions
        //click on a note
        function clickonNote(){              $(".noteheader").click(function(){
            if(!editMode){
                //update activeNote variable to id of note
                activeNote = $(this).attr("id");

                //fill text area
                $("textarea").val($(this).find('.text').text());
                //show hide elements
                showHide(["#notearea", "#allnotes"], ["#notes", "#addnote", "#edit", "#done"]);
                $("textarea").focus();
            }
        });
    }
        //click on delete
    
    function clickonDelete(){
        $(".delete").click(function(){
            var deleteButton = $(this);
            //send ajax call to delete note
            $.ajax({
                url: "deletenotes.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:deleteButton.next().attr("note_id")},
                success: function (data){
                    if(data == 'error'){
                        $('#alertContent').text("There was an issue delete the note from the database!");
                        $("#alert").fadeIn();
                    }else{
                        //remove containing div
                        deleteButton.parent().remove();
                    }
                },
                error: function(){
                    $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                            $("#alert").fadeIn();
                }

            });
            
        });
        
    }
        //show Hide function
        
    function showHide(array1, array2){
        for(i=0; i<array1.length; i++){
            $(array1[i]).show();   
        }
        for(i=0; i<array2.length; i++){
            $(array2[i]).hide();   
        }
    };
    
});
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>