<!DOCTYPE html>
<html>
<head>
  <title>Register new user</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="media.css">

    <?php require 'header.php' ?>   
</head>
<body>
<div class="container">

  
 <main>
    <form action="register.php" method="post" enctype="multipart/form-data">
      <div class="logo">
      <img id="loginlogo" src="images/logoonly.png" x` width='180px'>
        <p> Create to your account</p>


        <div class="form-group">
        <input type="text" id="name" class="input" name="name" placeholder="Full Name" required><br>
      </div>

      <div class="form-group">
        <input type="password" id="password" class="input" name="password" placeholder="Password" required><br>
      </div>

      <div class="form-group">
        <input type="password" id="confirmpassword" class="input" placeholder="Confirm Password" name="confirmpassword" required><br>
      </div>

      <div class="form-group">
        <input type="text" id="email" name="email" class="input" placeholder="Email" required><br>
      </div>

     

      <input type="submit" name="btn" id="btn" class="icons" value="Register">
    </form>
 
<?php
try {
  require 'connection.php';

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $confirmpassword = $_POST['confirmpassword'];
    $email = $_POST['email'];
    
    //Regular expressions for email,name,password vlidaton       
    $email_exp = '/^[A-Z][\w\d\.]{0,25}@[A-Z]{4,}\.[A-Z]{2,4}$/i';
    $name_exp = '/^[A-Z]{3,15}\s[A-Z]{3,15}(?:\s[A-Z]{3,15})?$/i';
    $pass_exp = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[#@%\$\!])[a-zA-Z0-9#@%\$\!]{5,20}$/';

    if (!preg_match($email_exp, $email)) {
      echo '<div class="custom-alert"><script>alert("Invalid Email");</script></div>';
    } elseif (!preg_match($name_exp, $name)) {
      
      echo '<div class="custom-alert"><script>alert("Invalid Name");</script></div>';

      
    } elseif (!preg_match($pass_exp, $password)) {
      echo '<div class="custom-alert"><script>alert("Invaild Password Must contain small and big letter and number and special char");</script></div>';
    } else {  
      
      $insert_query = "INSERT INTO users VALUES (NULL, '$name', '$email', '$hashed_password');";
      $rs = $db->exec($insert_query);
      
      if ($rs) {
        echo "<p style='color:green; background-color:white; font-size:20px;'>Registeration Successfull</p>"; 
       
        ?>
          <script>
         function redirectToLoginPage() {          //if the usere registered redirect him to loginpage
         window.location.href = 'login.php';
        }
          document.addEventListener('DOMContentLoaded', function() {
          setTimeout(redirectToLoginPage, 3000);
        });
        </script>
        <?php
      } else {
        echo "<p style='color:red; background-color:white; font-size:20px;'>Registeration Faild</p>";
      }
    }
  }
} catch (PDOException $ex) {
  echo "<p style='color:red; background-color:white; font-size:20px;'>Registeration Faild</p>";
  
}
?>

</main>

<footer>
  <p>Thank you for using our poll creation service!</p>
</footer>
</body>
</html>


