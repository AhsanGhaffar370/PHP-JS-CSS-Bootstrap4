<?php
session_start();
error_reporting(0);

include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();

if(isset($_SESSION['username']))
	{	
header('location: admin/dashboard.php');
}

?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <meta name="description" content="Hello bloggers">



    <?php include("head_libs.php"); ?>


</head>

<body class="bg_212">
    <?php //include "header.php";?>

    <?php

//insert reocrd
if (isset($_POST['signup'])) {

    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
   
    $query1="insert into user set username=:username, email=:email, pass=:pass";
    $stmt1 = $db->prepare($query1);

    if ($stmt1) {
        // PDO
        $stmt1->bindParam(':username', $uname); 
        $stmt1->bindParam(':email', $email); 
        $stmt1->bindParam(':pass', $password); 
        // $stmt1->bindParam(':avatar', "law9.jpg"); 
        $stmt1->execute();
        
        if ($stmt1->rowCount() == 1)  // PDO 
        {
            echo "<script>alert('Account Created Successfully final')</script>";
            header("location: login.php");
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
        
        unset($stmt1); //PDO
    }

}


?>
    

    <section class="centre_sec21 pl-5 pr-5">

        <div class="col-12 col-lg-2 col-md-4 col-sm-6 p-0 rounded bg-white text-center shadow">
            <div class="border-bottom rounded-top bg-primary pt-3 pb-3">
            <a href="index.php"><i class="fab fa-blogger-b fa-4x text-white "></i></a>
                <!-- <p class="size24 text-secondary text-center b4 pt-0">Sign in to Bloggers</p> -->
            </div>

            <!-- Form Starts -->
            <form id="form41" action="" method="POST" class="needs-validation pt-4 pl-4 pr-4 pb-2" novalidate enctype="multipart/form-data">
            
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    <input type="text" class="form-control" id="uname1" name="uname" placeholder="Username" required />
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-at"></i></div>
                    </div>
                    <input type="email" class="form-control" id="email1" name="email" placeholder="Email" required />
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control " id="pass1" name="pass" placeholder="Password"
                        required />
                </div>

                <div class="">
                    <input type="submit" value="Sign up" name="signup" class="btn btn-primary btn-block btn-lg" />
                </div>
            </form>
            <p class="size11 text-dark text-center pb-2">Already have an account? <a href="login.php" class="b4 text-primary">Login</a></p>
        </div>

        <!-- End of form -->
    </section>

    <?php //include("footer.php"); ?>


    <?php include("footer_libs.php"); ?>



</html>