<?php
session_start();
error_reporting(0);

include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();
?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <meta name="description" content="Hello bloggers">



    <?php include("head_libs.php"); ?>

</head>

<body class="bg_212">

    <?php

//insert reocrd
if (isset($_GET['q'])) {

   
    $query1="select * from user where email=:email";
    $stmt1 = $db->prepare($query1);

    if ($stmt1) {
        // PDO
        $stmt1->bindParam(':email', $_GET['q']); 
        $stmt1->execute();
        
        // echo "<script>alert('Account Created Successfully final')</script>";
        if ($stmt1->rowCount() > 0)  // PDO 
        {
            $row=$stmt1->fetch(PDO::FETCH_ASSOC);
            // while($row){
                
            // echo "<script>alert('Account Created Successfully final')</script>";
            // echo "<script>document.getElementById('ema').innerHTML='".$row['email']."'</script>";
            // echo $row['email'];
            echo '<i class="fas fa-info-circle"></i> Email Already Exist';
            
        // }
            // header("location: login.php");
        } else {
            // echo "<script>alert('Something went wrong')</script>";
        }
        
        unset($stmt1); //PDO
    }

}

?>
    

</body>
</html>