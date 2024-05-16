<?php
require "connection.php";
require_once "status.php";

session_start();
    $poll_id=$_GET['poll_id'];
    
    $sql="select * from polls where poll_id=$poll_id";
    $rs=$db->prepare($sql);
    $rs->execute();
    $row=$rs->fetch();
    $question=$row['question'];
    $title=$row['title'];
    if($row['is_active']==0){
        header("location:result.php?poll_id=$poll_id");
        exit;
    }
    //checking if the user already voted or not
    if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];
    $vote_sql="select * from votes where user_id=$user_id and poll_id=$poll_id";
    $rcs=$db->prepare($vote_sql);
    $rcs->execute();
    $vote_row=$rcs->fetch();
    if($voted=isset($vote_row['vote_id'])){
        header("location:result.php?poll_id=$poll_id");//if it is the case redirect him to result page
        exit;
        }
    }
    $opsql="select option_id,option_text from options where poll_id=$poll_id";
    $ops=$db->prepare($opsql);
    $ops->execute();


    if(isset($_POST['result_button']))
        header("location:result.php?poll_id=$poll_id");
    //inseting the vote into the db, then redirecting to the resutl page
    if(isset($_POST['vote_button'])){
        $optionid=$_POST['option'];
        $ins="insert into votes values(null, $user_id, $poll_id, '$optionid', current_timestamp() )";
        $db->exec($ins);
        header("location:result.php?poll_id=$poll_id");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewpoll.css">
    <link rel="stylesheet" href="media.css">
    <title><?php echo" $title"; ?></title>
    <?php require 'header.php' ?>  
</head>
<body>
<div class="conatiner">

    <main>

    <form method="post">
        <h1><?php echo $title; ?></h1>
        <hr>
        <h3><?php echo $question; ?></h3>
        
        <?php 
            while($row=$ops->fetch()){
                $option_id=$row['option_id'];
                $opt=$row['option_text'];
                echo"
                    <input type='radio' class='options' name='option' value='$option_id'>$opt<br>\n";
            }
        ?>
        <br>
        <?php 
            if(!isset($_SESSION['user_id'])){
                echo "<button  type='submit' class='icons btn' name='result_button'>View result</button>";
            }
            else{
                echo "<button type='submit' class='icons btn' name='vote_button'>Vote</button>";
                echo "<button  type='submit' class='icons btn' name='result_button'>View result</button>";
            }
        ?>
          

    </form>

    </main>

    <footer>


    </footer>

    </div>
</body>
</html>