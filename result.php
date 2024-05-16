<?php
require "connection.php";
require_once "status.php";
    $poll_id=$_GET['poll_id'];
    
    $sql="select * from polls where poll_id=$poll_id";
    $rs=$db->prepare($sql);
    $rs->execute();
    $row=$rs->fetch();
    $question=$row['question'];
    $title=$row['title'];

    $vquery = "SELECT COUNT(*) AS votes_number
          FROM votes
          WHERE poll_id = $poll_id";

    // Prepare and execute the query
    $stmt = $db->prepare($vquery);
    $stmt->execute();

    // Fetch the result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $votes_number = $row['votes_number'];

    $query="SELECT o.option_text,
    (SELECT COUNT(option_id) FROM votes v WHERE v.option_id = o.option_id) AS vote_count
    FROM options o
    WHERE o.poll_id = $poll_id
    ORDER BY o.option_id
";

    $result = $db->query($query);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="results.css">
    <link rel="stylesheet" href="media.css">

    <title><?php echo"$title";?></title>
    <?php require "header.php"; ?>
</head>
<body>
    <div class="container">

    <main>
    <h1><?php echo $title; ?></h1>
   
    <h2><?php echo $question; ?></h2>
    <hr style="height:2px;background-color:white; border-radius:50px; width:300px;">
    <?php

if ($votes_number > 0) {

    while ($row = $result->fetch()) {
        $optionText = $row['option_text'];
        $voteCount = $row['vote_count'];
        $perc=($voteCount/$votes_number)*100;
        echo"<div class='progress-container'>";
        echo "$optionText:<br>     <progress value='$perc' max='100' class='progress-bar'></progress><p class='voteinfo'>".number_format($perc, 0)."% ,
        $voteCount votes</p><br><div class='progress-text'> </div>";
    }
} else {
    echo "No votes found for this Poll yet.";
}

    ?>
    </main>
    
    <footer>
        <p>Thank you for using our poll creation service!</p>
    </footer>
    </div>
</body>
</html>