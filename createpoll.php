<?php
require "connection.php";
session_start();
// checking if the user is signed in or not
if (!isset($_SESSION['user_id'])) {
    // if not Redirect to the login page
    echo"<script>alert('You must login first')</script>";
    header( "Refresh:0.001; url=mainpage.php", true, 303);
    
}

try {
    if (isset($_POST["create"])) {
        $title = $_POST["title"];
        $question = $_POST["question"];
        $user_id = $_SESSION["user_id"];
        $end_date = null; //defualt vlaue of end date in database (if it is null the user chose manual close)
        if ($_POST["close"] === "date" && isset($_POST["end"])) {
            // If the user chooses to end by expiry date, store the end date in the database
            $end_date = $_POST['end'];
            $sql = "INSERT INTO polls VALUES(null, '$question','$title', current_timestamp(),'$end_date', '1', '$user_id')";

        }
        else   
            $sql = "INSERT INTO polls VALUES(null, '$question','$title', current_timestamp(),null, '1', '$user_id')";

        // Insert the poll details into the database
        $stmt = $db->exec($sql);
        // Get the last inserted poll ID to pass it to pages that need it
        $poll_id = $db->lastInsertId();

        // Insert the poll options into the database
        if (isset($_POST['options'])) {
            foreach ($_POST['options'] as $option) {
                $option_text = $option;
                $sql = "INSERT INTO options  VALUES (null,'$poll_id', '$option_text')";
                $rs = $db->exec($sql);
            }
        }
        //echo "<script>alert('poll created sucsessfully')</script>";
        header("location:viewpoll.php?poll_id=$poll_id");
    }
} 

catch (PDOException $ex) {
    echo "Error occurred!";
    die($ex->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="media.css">

        <title>Main Page</title>
        <?php require 'header.php' ?>  
    </head>
<body>

    <div class="container">
    
    <main>
    <h2>Create Your Poll</h2>
        <form method="post" >
            <div class="form-group">
                                        <!-- Title input -->
                <input type="text"  maxlength="21" name="title"  class="input" placeholder="Title" id="title" required>
            </div>

            <div class="form-group">
                
                <input type="text" maxlength="50" name="question" class="input"  placeholder="Question" id="question" required>
            </div>

            <!-- Radio buttons for choosing manual or date expiry-->
            <div class="form-group" id="manual">
                <input type="radio" name="close" class="texts" maxlength="100"  class="input"  value="manual_close" onclick="hideEndDate()" required> Manual Close
                <input type="radio" name="close" class="texts" maxlength="100" class="input" value="date" onclick="showEndDate()" > Expiry Date<br>
            </div>
        <!-- 
        <div class="form-group" id="manual">
        <select name='close' calss='texts'>
            <option name="close" class="texts" value='manual_close' onclick="hideEndDate()" required>Manual close</option>
            <option name="close" class="texts" value='date' onclick="showEndDate()">Expiry Date</option><br>
        </select> -->

       
            <div class="form-group" id="expiryDateContainer" style="display: none;">
                
                <input type="datetime-local" class="input" name="end" id="end">
            </div>
           

            <div class="form-group">
              
                <div id="optionsContainer">
                 <input type="text" class="input op" name="options[]" placeholder="Option 1" required><br>
                 <input type="text" class="input op"  name="options[]" placeholder="Option 2" required><br>
                </div>
                <button type="button" class="input" onclick="addOption()">Click to add option</button>
            </div>
         

            <div class="form-group">
                <button type="submit" class="icons" id="create" name="create">Create Poll</button>
            </div>
        </form>
        </main>

    </div> 

    <footer>
        <p>Thank you for using our poll creation service!</p>
    </footer>

    <script>
        function showEndDate() {
            document.getElementById("expiryDateContainer").style.display = "block";
            document.querySelector('input[name="end"]').disabled = false;
        }

        function hideEndDate() {
            document.getElementById("expiryDateContainer").style.display = "none";
            document.querySelector('input[name="end"]').value = '';
            document.querySelector('input[name="end"]').disabled = true;
        }
     
    let optionNumber = 3;
    
    function addOption() {
        if (optionNumber < 6) {
            const container = document.getElementById('optionsContainer');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'options[]';
            input.required = true;
            input.placeholder = 'Option ' + optionNumber;
            input.classList.add('input');
            input.classList.add('op');
            container.appendChild(input);
            container.appendChild(document.createElement('br'));
            optionNumber++;

            setTimeout(function() {
                const nextInput = document.querySelector('input[name="options[]"]:last-of-type');
                if (nextInput) {
                    nextInput.focus();
                }
            }, 0);
        } else {
            alert('No more options');
        }
    }

    </script>
</body>
</html>