<?php
session_start();
error_reporting(0);

date_default_timezone_set('Asia/Karachi');

include '../connect_db.php';
$database = new database();
$db = $database->connect_pdo();

if (isset($_SESSION['username'])) {
    header('location: dashboard.php');
}

?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <meta name="description" content="Hello bloggers">

    <?php include("header_libs.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body class="bg_212">
    <?php //include "header.php";
    ?>

    <?php

    //insert reocrd
    if (isset($_POST['signup'])) {

        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password = md5($_POST['pass']);
        $status = 0;
        $activationcode = md5($email . time());
        $entry_date = date("Y-m-d");

        $query0 = "select * from user where email=:email";
        $stmt0 = $db->prepare($query0);
        $stmt0->bindParam(':email', $email);
        $stmt0->execute();


        if ($stmt0->rowCount() > 0) {
            echo "<script>alert('Email already exist')</script>";
        } else {
            $query1 = "insert into user set username=:username, email=:email, pass=:pass, activationcode=:activationcode, status=:status, entry_date=:entry_date";
            $stmt1 = $db->prepare($query1);
            // PDO
            $stmt1->bindParam(':username', $uname);
            $stmt1->bindParam(':email', $email);
            $stmt1->bindParam(':pass', $password);
            $stmt1->bindParam(':status', $status);
            $stmt1->bindParam(':activationcode', $activationcode);
            $stmt1->bindParam(':entry_date', $entry_date);
            // $stmt1->bindParam(':avatar', "law9.jpg"); 
            $stmt1->execute();

            if ($stmt1->rowCount() == 1)  // PDO 
            {
                $to = $email;
                $subject = "Email verification (Bloggers.com)";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From:Bloggers.com | Ahsan Rao <eqannet@eqan.net>' . "\r\n";
                $headers .= 'Cc: ahsanrao237@gmail.com' . "\r\n";

                $message = '<html>';
                $message .= '<head>
							<style>
							.bg_color {background-color: #E9EAEC;padding: 50px 0px 50px 0px;}
                            .sec_bg {padding: 50px;background-color: white;margin: auto;border: 1px solid #bab7b7;}
                            .btn1{padding: 15px;background-color: #0e7eff;color: white;border: none;}
                            .h1 {font-size: 24px;font-weight: 700;}
                            .p1 {font-size: 17px;font-weight: 400;margin: 10px 10px 40px 10px; }
                            .p2 {margin-top: 40px; }
                            .section{ margin-top: 70px;width: 500px;padding: 20px;border: 1px solid grey;text-align: center;}
							</style>
						</head>';
                $message .= '<body>';

                $message .= '<section class="section sec_bg">
                    <div><a href="http://www.eqan.net/bloggers_php/index.php"><i class="fab fa-blogger-b fa-5x"></i></a></div>
                    <p class="h1">Let\'s confirm your email address. </p>
                    <p class="p1">By clicking on the following link, you are confirming your email address.</p>
                    <a href="http://www.eqan.net/bloggers_php/admin/email_verification.php?code=' . $activationcode . '" class="btn1">Confirm Email Address</a>
                    <p class="p2">Powered by<a href="http://www.eqan.net/bloggers_php/index.php">Bloggers.com</a></p>
                </section></html>';

                // echo "<script>window.location = 'login.php';</script>";
                $retval = mail($to, $subject, $message, $headers);

                if ($retval == true) {
                    echo "Account created successfully";
                } else {
                    echo "Something went wrong during creating account, try again later";
                }

                $_SESSION['mail_reg'] = $email;
                $_SESSION['succ_reg'] = "success";
                header("location: login.php");
            } else {
                echo "<script>alert('Something went wrong')</script>";
            }

            unset($stmt1); //PDO
        }
    }


    ?>

    <section class="container centre_sec21 pl-5 pr-5">

        <div class="col-12 col-lg-4 col-md-4 col-sm-6 p-0 rounded bg-white text-center shadow">
            <div class="border-bottom rounded-top bg-primary pt-3 pb-3">
                <a href="../index.php"><i class="fab fa-blogger-b fa-4x text-white "></i></a>
                <!-- <p class="size24 text-secondary text-center b4 pt-0">Sign in to Bloggers</p> -->
            </div>

            <!-- Form Starts -->
            <!-- <form id="form41" action=login.php method="POST" class="needs-validation pt-4 pl-4 pr-4 pb-2"> -->
            <form id="form1" method="post" action="" class="needs-validation1 pt-4 pl-4 pr-4 pb-2" enctype="multipart/form-data">

                <span id="msg21" class=""></span>

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
                    <input type="email" class="form-control" id="email21" name="email" placeholder="Email" required />
                    <br />

                </div>
                <!-- <p class="text-left size13 text-danger b6 mt-1 mb-3"><span id="ema"></span></p> -->

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control " id="pass1" name="pass" placeholder="Password" required />
                </div>

                <div class="">
                    <input type="submit" value="Sign up" name="signup" id="sign12" class="btn btn-primary btn-block btn-lg" />
                    <!-- <p  >abcd</p> -->
                </div>
            </form>
            <p class="size11 text-center pb-2" style="color: black;">Already have an account? <a href="login.php" class="b6 size13 text-primary">Login</a></p>
        </div>

        <!-- End of form -->
    </section>

    <?php //include("footer.php"); 
    ?>

    <?php include("footer_libs.php"); ?>

    <script>
        $(document).ready(function() {

            // AJAX Using jQuery 
            $("#email21").keyup(function() {
                let ser = $('#email21').val();

                $.ajax({
                    url: 'checkmail.php',
                    type: 'post',
                    data: 'email=' + ser,
                    success: function(response) {
                        if (response == true) {
                            $("#msg21").html(
                                '<div class="alert alert-warning"><i class="fas fa-info-circle"></i> Email Already Exist</div>'
                            );
                            $('#sign12').attr('disabled', 'disabled');
                        } else if (response == false) {
                            $("#msg21").html('');
                            $('#sign12').removeAttr('disabled');
                        } else {
                            // console.log("else : ",response);
                        }
                    }
                });
            });
        });

        // AJAX Using JavaScript:
        // function showUser(e) {
        //     let str=e.target.value;
        //     if (str == "") {
        //         document.getElementById("ema").innerHTML = "";
        //         return;
        //     } else {
        //         var xmlhttp = new XMLHttpRequest();
        //         xmlhttp.onreadystatechange = function() {
        //             if (this.readyState == 4 && this.status == 200)
        //                 document.getElementById("ema").innerHTML = this.responseText;
        //         };
        //         xmlhttp.open("GET","checkmail.php?q="+str,true);
        //         xmlhttp.send();
        //     }
        // }
        // document.getElementById('email1').addEventListener('blur',function(e){showUser(e)},false);
    </script>
</body>

</html>