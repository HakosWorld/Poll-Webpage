
<?php
require "connection.php";
require_once "status.php";
session_start();

?>


<!DOCTYPE html>
<html>
<head>
  <title>Browse</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="browse.css">
  <link rel="stylesheet" href="media.css">
  <?php require "header.php"; ?>
</head>
<body class="broswe-page">
<div class="container">
    <!-- displaing all polls to browse them -->
    <main>
    <?php 
    $sql="select * from polls";
    $polls=$db->query($sql);
        while($row=$polls->fetch())
        {
            $poll_id=$row['poll_id'];
            $title=$row['title'];
            $is_active=$row['is_active'];
            $creator=$row['creator_id'];
            $select_name="select name from users where user_id=$creator";
            $statement = $db->prepare($select_name);
            $statement->execute();
            $creator_name=$statement->fetch()['name'];
            echo "  
            <a  href='viewpoll.php?poll_id=$poll_id'>
          
                <div class='polls-browse' >
                ";
                $color="";
                if($is_active==0){
                  $status="closed";
                  $color="red";
                }
                else{ 
                  $status="open";
                  $color="green";
                }
                echo"
                
                <h1>$title</h1>
                
                <h4>Creatd by $creator_name</h4>
                ";
            echo "<h4 style='color:$color; background-color:white'>$status</h4>
                  </div></a> ";    


        }
    //
        
    
    ?>
    </main>
  
  </div>
  <footer>
        <p>Thank you for using our poll creation service!</p>
    </footer>
</body>
</html>

