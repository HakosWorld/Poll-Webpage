<?php 
    date_default_timezone_set('Asia/Bahrain');
    $db = new PDO('mysql:host=localhost;dbname=pollproject;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
?>


