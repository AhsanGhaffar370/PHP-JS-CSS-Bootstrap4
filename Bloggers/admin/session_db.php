<?php
session_start();
// error_reporting(0);

include '../connect_db.php';
$database=new database();
$db = $database->connect_pdo();

if(isset($_SESSION['username']))
{
    if(isset($_SESSION['timer'])){
        if(time()-$_SESSION['timer']>(180 * 60)){
            header('location:logout.php');
        }
    }
    $_SESSION['timer']=time();
    // if(time()-$_SESSION["login_time_stamp"] >(180 * 60))  
    // {
    //     // session_unset();
    //     // session_destroy();
    //     header("Location:logout.php");
    // }
}
else{	
header('location: login.php');
}
?>