<?php
require "connection.php";
session_start();
if(!isset($_SESSION["user_id"])){
    echo"<script>alert('You must login first')</script>";
    header( "Refresh:0.001; url=login.php", true, 303);

}
//getting info needed to display
$user_id=$_SESSION['user_id'];
$userSql="select * from users where user_id=$user_id";
$pollSql="select * from polls where creator_id=$user_id";

$users=$db->query($userSql);
$userInfo=$users->fetch();

$polls=$db->query($pollSql);
$pollsNumber=$polls->rowCount();

$id=0;
if (isset($_POST['close_btn'])) {
    $id = $_POST['poll_id'];
    $new_status = $_POST['status_select'];

    if ($new_status == 'close') {
        $change = $db->prepare("UPDATE `polls` SET `is_active`  = 0 , `expires_at` = null WHERE `polls`.poll_id = $id");
        $change->execute();
        header("Location: profile.php");
        exit;
        
    } else if ($new_status == 'open') {
        $change = $db->prepare("UPDATE `polls` SET `is_active` = 1 WHERE `polls`.poll_id = $id");
        $change->execute();
        header("Location: profile.php");
        exit;
        
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="media.css">

    <?php require 'header.php' ?>  
    <title><?php echo $userInfo['name']." profile"?></title>
</head>
<body>
    <div class="container">
        <main>
            <div class="info">
                <h1>Welcome <?php echo $userInfo['name']; ?> !</h1>
                <hr style='color:black;'>
           
                
            </div>
            
            <h3>Number of polls created by you is <?php echo $pollsNumber; ?>:</h3>

            <!-- Display the polls created by this user in a table -->
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Close at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $polls->fetch()) {
                        $poll_id = $row['poll_id'];
                        $title = $row['title'];
                        $is_active = $row['is_active'];
                        $date = $row['expires_at'];
                        echo "<tr>
                                <td><a href='viewpoll.php?poll_id=$poll_id'>$title</a></td>
                                <td>";if($date==null){echo"Manual Only";}else {echo"$date";}echo"</td>
                                <td>";
                                if ($is_active == 0 || $is_active == 1) {
                                    echo "<form action='profile.php' class='no-style-form' method='post'>
                                            <select  ". ($is_active == 0 ? "style='background-color:lightcoral'" : "style='background-color:lightgreen'") ." name='status_select' >
                                                <option value='open' " . ($is_active == 1 ? "selected" : "") . ">Opened</option>
                                                <option value='close' " . ($is_active == 0 ? "selected" : "") . ">Closed</option>
                                            </select>
                                            <input type='hidden'  name='poll_id' value='$poll_id'>
                                            <button type='submit'". ($is_active == 0 ? "style='color:black'" : "style='color:black'") ."name='close_btn'>Change Status</button>
                                          </form>";
                                }
                                echo "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
