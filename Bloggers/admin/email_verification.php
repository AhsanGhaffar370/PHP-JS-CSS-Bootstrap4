<?php
session_start();
error_reporting(0);

include '../connect_db.php';
$database = new database();
$db = $database->connect_pdo();

?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Email Verification | Find Affordable Legal Help with us </title>

    <meta name="description" content="Hello bloggers">


    <?php include("header_libs.php"); ?>

</head>

<body class="bg-light">
    <?php

    //insert reocrd
    if (isset($_GET['code'])) {

        $code = $_GET['code'];
        $status = '1';

        $query1 = "UPDATE user SET status=:staus WHERE activationcode=:code";  //MYSQLI
        $stmt1 = $db->prepare($query1);

        if ($stmt1) {
            // PDO
            $stmt1->bindParam(':staus', $status);
            $stmt1->bindParam(':code', $code);
            $stmt1->execute();

            if ($stmt1->rowCount() > 0)  // PDO 
            {
    ?>
                <section class="container centre_sec21 pl-5 pr-5">

                    <div class="col-12 col-lg-5 col-md-5 col-sm-6 p-0 rounded-0 border border bg-white text-center ">
                        <div class=" bg-success pt-2 pb-2">
                            <a href="../index.php"><i class="fa fa-check-circle fa-5x text-white "></i></a>
                        </div>

                        <div class="pt-2 pl-4 pr-4 pb-2">
                            <p class="size24 text-dark">Your email address has been verified</p>
                            <input type="button" name="submitbtn" class="btn btn-primary rounded-0 b6 pr-4 pl-4 pt-2 pb-2" onclick="window.location.href='login.php'" value="Continue to Login">
                        </div>
                        <p class="size11 text-center pb-2" style="color: black;">Powered by<a href="../index.php" class="b6 size13 text-primary">Bloggers.com</a></p>
                    </div>
                </section>
            <?PHP

            } else {
            ?>
                <section class="container centre_sec21 pl-5 pr-5">
                    <div class="col-12 col-lg-5 col-md-5 col-sm-6 p-0 rounded-0 border border bg-white text-center ">
                        <div class=" bg-info pt-2 pb-2">
                            <a href="../index.php"><i class="fa fa-info-circle fa-5x text-white "></i></a>
                        </div>

                        <div class="pt-2 pl-4 pr-4 pb-2">
                            <p class="size24 text-dark">Email already verified </p>
                            
                            <input type="button" name="submitbtn" class="btn btn-primary rounded-0 b6 pr-4 pl-4 pt-2 pb-2" onclick="window.location.href='login.php'" value="Continue to Login">
                        </div>
                        <p class="size11 text-center pb-2" style="color: black;">Powered by<a href="../index.php" class="b6 size13 text-primary">Bloggers.com</a></p>
                    </div>
                </section>

    <?PHP
            }

            unset($stmt1); //PDO
        }
    }
    ?>


    <?php include("footer_libs.php"); ?>



</body>

</html>