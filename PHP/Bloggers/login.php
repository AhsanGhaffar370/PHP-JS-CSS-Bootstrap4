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

    <link  href="login_form_css.css" type="text/css" rel="stylesheet" media="screen">

</head>

<body class="bg_2">
<?php

//insert reocrd
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['pass']);
   
    $query1="select * from user where email=:email and pass=:pass";
    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        // MYSQLI
        // $stmt1->bind_param('sssssss', $name, $email, $password, $sex, $image, $date,$service); 
        
        // PDO
        $stmt1->bindParam(':email', $email); 
        $stmt1->bindParam(':pass', $password); 
        // $stmt1->bindParam(':pass', $password); 
        $stmt1->execute();
        
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
            
            $_SESSION["login_time_stamp"] = time();  

            header("location: admin/dashboard.php");
        } else {
            // header("location: crud_pdo.php");
            echo "Invalid Email or Password";
        }
        
        unset($stmt1); //PDO
    }
    
}

?>

    <section class="centre_sec">

        <i class="fab fa-weibo fa-5x cl_w"></i>
        <p class="size24 cl_w b8">Welcome</p>

        <!-- Form Starts -->
        <form name="form52" id="form1" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])  ?>">

            <div class="form-group mb-0">
                <input type="email" class="form-control field1 p-4" id="email1" name="email" placeholder="Email" required/>
            </div>

            <div class="form-group mb-2">
                <input type="password" class="form-control field2 border-top-0 p-4" id="pass1" name="pass" placeholder="Password" required/>
            </div>

            <div class="">
                <input type="submit" value="Log in" name="login" class="fbutton btn_lg btn_block b7 p-2" />
            </div>

            <div>
                <p class="tc cl_w m-2"><a href="#" class="b8">Signup</a> for new account</p>
            </div>
        </form>
        <!-- End of form -->
    </section>


    

    <?php //include("footer.php"); ?>


    <?php include("footer_libs.php"); ?>



</body>

</html>