<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="media.css">

    <?php require 'header.php' ?>  
    <!--  end of header -->

</head>
<body>
<div class="container">

  
    
<main>
<?php
require 'connection.php';
try {
  if (isset($_POST['btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $rs = $db->query($sql);

    if ($row = $rs->fetch()) {
      if ($password == password_verify($password, $row['password']) && $email == $row['email']) {
        echo "<p style='color:lightblue;'>Welcome</p>";
        session_start();
        $_SESSION["user_id"] = $row["user_id"];
        header( "Refresh:2; url=createpoll.php", true, 303);
      } 
      else {
        echo"<script>alert('Invalid Email or Password')</script>";
     
      }
      
    } else {
 echo"<script>alert('Invalid Email or Password')</script>";
       
    }
  } 
  
 
} catch (PDOException $ex) {
  echo "Error occurred!";
  die($ex->getMessage());
}
?>




      <form action="login.php" method="post" enctype="multipart/form-data">
        <div class="logo">
      <img id="loginlogo" src="images/logoonly.png" x` width='180px'>
     <p> Login to your account</p>
        
        <div class="form-group">
          <label for="email"></label>
          <input type="text" id="email" name="email" class="input" placeholder="Email" required>
        </div>
        
        <div class="form-group">
          <label for="password"></label>
          <input type="password" id="password" name="password" class="input" placeholder="Password" required>
        </div>

        <div class="form-group">
          <input type="submit" name="btn" id="btn" class="icons" value="Login">
        
      </form>
    </main>

   
  </div>
  <footer>
        <p>Thank you for using our poll creation service!</p>
    </footer>
</body>
</html>
