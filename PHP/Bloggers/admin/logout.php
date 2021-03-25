<?php
    session_start(); 
    $_SESSION = array();
    
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset( $_SESSION['niche']);
        unset( $_SESSION['avatar']);
        unset( $_SESSION['email']);
        unset( $_SESSION['pass']);
        unset( $_SESSION['country']);
        session_destroy(); // destroy session
        header("location:../login.php"); 
?>