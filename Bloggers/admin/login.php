<?php
session_start();
error_reporting(0);

include '../connect_db.php';
$database=new database();
$db = $database->connect_pdo();

if(isset($_SESSION['username']))
	{	
header('location: dashboard.php');
}

?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <meta name="description" content="Hello bloggers">


    <?php include("header_libs.php"); ?>

</head>

<body class="bg_212">
    <?php

//insert reocrd
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    $status = "1";
   
    $query1="select * from user where email=:email and pass=:pass and status=:status";
    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        // PDO
        $stmt1->bindParam(':email', $email); 
        $stmt1->bindParam(':pass', $password); 
        $stmt1->bindParam(':status', $status); 
        $stmt1->execute();
        echo "<script>alert('Query execute')</script>";
        
        if ($stmt1->rowCount() > 0)  // PDO 
        {
            
            $results=$stmt1->fetchAll(PDO::FETCH_OBJ);
            foreach($results as $res)
            {
                $_SESSION['id']= $res->id;
                $_SESSION['username']= $res->username;
                $_SESSION['avatar']= $res->avatar;
                $_SESSION['niche']= $res->niche;
                $_SESSION['email']= $res->email;
                $_SESSION['pass']= $res->pass;
                $_SESSION['country']= $res->country;

            }
            
            // $_SESSION["login_time_stamp"] = time();  
            
            header("location: dashboard.php");
        } else {
            // header("location: crud_pdo.php");
            echo "<script>alert('Invalid email & password combination or maybe your email is not verified')</script>";
        }

        unset($stmt1); //PDO
    }

}

?>

    <section class="container centre_sec21 pl-5 pr-5">

        <div class="col-12 col-lg-4 col-md-4 col-sm-6 p-0 rounded bg-white text-center shadow">
            <div class="border-bottom rounded-top bg-primary pt-3 pb-3">
                <!-- <a href="../index.php"><i class="fab fa-blogger-b fa-4x text-white "></i></a> -->
                <!-- <p class="size24 text-secondary text-center b4 pt-0">Sign in to Bloggers</p> -->
            </div>

            <!-- Form Starts -->
            <form name="form52" id="form1" class="pt-4 pl-4 pr-4 pb-2" method="POST"
                action="<?php echo htmlentities($_SERVER['PHP_SELF'])  ?>">
                <?PHP if($_SESSION['succ_reg']!="") {?>
                <div class="alert alert-success size11">
                We have just sent an email to <b> <?PHP echo $_SESSION['mail_reg'] ?> </b> <br> Please verify your email address.
                </div>
                
                <?PHP 
                unset( $_SESSION['mail_reg']);
                unset( $_SESSION['succ_reg']);
                } 
                ?>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-at"></i></div>
                    </div>
                    <input type="email" class="form-control" id="email1" name="email" placeholder="Email" required />
                </div>

                <div class="input-group mb-0">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control " id="pass1" name="pass" placeholder="Password"
                        required />

                </div>
                <div class="text-right mt-0 mb-3">
                    <a href="#" class="b4 size13 text-right text-primary">Forgot Passowrd?</a>
                </div>
                <div class="">
                    <input type="submit" value="Log in" name="login" class="btn btn-primary btn-block btn-lg" />
                </div>
            </form>
            <p class="size11 text-center pb-2" style="color: black;">New to Bloggers? <a href="signup.php"
                    class="b6 size13 text-primary">Create Account</a></p>
        </div>

        <!-- End of form -->
    </section>




    <?php //include("footer.php"); ?>


    <?php include("footer_libs.php"); ?>



</body>

</html>