<?php
session_start();
error_reporting(0);

date_default_timezone_set('Asia/Karachi');

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body class="bg_212">
    <?php //include "header.php";?>

    <?php

//insert reocrd
if (isset($_POST['signup'])) {

    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    $status= 0;
    $activationcode=md5($email.time());
   
    $query1="insert into user set username=:username, email=:email, pass=:pass, activationcode=:activationcode, status=:status";
    $stmt1 = $db->prepare($query1);

    if ($stmt1) {
        // PDO
        $stmt1->bindParam(':username', $uname); 
        $stmt1->bindParam(':email', $email); 
        $stmt1->bindParam(':pass', $password); 
        $stmt1->bindParam(':status', $status); 
        $stmt1->bindParam(':activationcode', $activationcode); 
        // $stmt1->bindParam(':avatar', "law9.jpg"); 
        $stmt1->execute();
        
        echo "<script>alert('Account Created Successfully final')</script>";
        if ($stmt1->rowCount() == 1)  // PDO 
        {
            // alert("success");
            // $to=$email;
            // $msg="Thanks for new registration.";
            // $subject="Email verification (Bloggers.com)";
            // $headers  = 'MIME-Version: 1.0' . "\r\n";
            // $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";    
            // // $headers.='Content-type: text/html; charset=iso-8859-1'."\r\n";
            // $headers .= 'From:<info@eqan.net>' . "\r\n";
            // // $headers.='From:Bloggers.com | Ahsan Rao <ahsangh237@gmail.com>'."\r\n";

            // $ms="<html><body><div>Hello world</div></body></html>";
            // // $ms="<html></body><div><div>Dear $uname,</div></br></br>";
            // // $ms.="<siv style='padding-top:8px;'>Please click the following link for verifying and activation of your account</div><div style='padding-top:10px;'><a href='http://www.Bloggers.com/demos/emailverify/email_verification.php?code=$activationcode'>click Here</a></div><div style='padding-top:4px;'>Powered by<a href='Bloggers.com'>Bloggers.com</a></div></div></body></html>";
            // $mail($to, $subject,$ms,$headers);
            // echo "<script>alert('Registration successful, please verify in the registered Email-id');</script>";
            // // header("location: login.php");
            // echo "<script>window.location = 'login.php';</script>";
            echo "<script>alert('Account Created Successfully final')</script>";
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
            <a href="index.php"><i class="fab fa-blogger-b fa-4x text-white "></i></a>
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
                    <br/>
                   
                </div>
                <!-- <p class="text-left size13 text-danger b6 mt-1 mb-3"><span id="ema"></span></p> -->

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control " id="pass1" name="pass" placeholder="Password"
                        required />
                </div>

                <div class="">
                    <input type="submit" value="Sign up" name="signup"  id="sign12" class="btn btn-primary btn-block btn-lg"  />
                    <!-- <p  >abcd</p> -->
                </div>
            </form>
            <p class="size11 text-center pb-2" style="color: black;">Already have an account? <a href="login.php" class="b6 size13 text-primary">Login</a></p>
        </div>

        <!-- End of form -->
    </section>

    <?php //include("footer.php"); ?>

    <?php include("footer_libs.php"); ?>

    <script>

        $(document).ready(function() {

            // AJAX Using jQuery 
            $("#email21").keyup(function(){
                let ser = $('#email21').val();

                $.ajax({
                    url: 'checkmail.php',
                    type: 'post',
                    data: 'email=' + ser,
                    success: function(response) {
                        if (response==true){
                            $("#msg21").html('<div class="alert alert-warning"><i class="fas fa-info-circle"></i> Email Already Exist</div>');
                            $('#sign12').attr('disabled', 'disabled');
                        }
                        else if(response==false){
                            $("#msg21").html('');
                            $('#sign12').removeAttr('disabled');
                        }
                        else{
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
