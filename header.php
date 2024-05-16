

<html>
<style>
    <?php
    if(!isset($_SESSION['user_id']))
        echo ".menue a{display:none; }";
    ?>
  
</style>


<header>
    <nav>
        <div class="logo"><a href="mainpage.php" id="logolink"><img src="images/logo.png" x` width='120px'></a></div>
        <div class="menue">
            <a href="createpoll.php">Create poll</a>
            <a href="browse.php">Browse polls</a>
            <a href="profile.php">Profile</a>
        </div>
        <div class="loginAndSignup">
        <a class="icons" href="login.php">Login</a>
        <a class="icons" href="register.php">Sign Up</a>
      
        </div>  
    </nav><!--  end of nav -->
</header> <!--  end of header -->

</html>