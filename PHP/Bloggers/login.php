<?php
session_start();

include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();
?>



<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
    <title>Our Blogs | Find Affordable Legal Help with us </title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />

    <meta name="description" content="Enjoy Fast Access To Top Family Lawyers Across The US.">


    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >


    <link  href="login_form_css.css" type="text/css" rel="stylesheet" media="screen">

    <link href='https://fonts.googleapis.com/css?family=Open Sans&display=swap' rel='stylesheet'>



</head>

<body class="bg_2">
<?php

//insert reocrd
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['pass'];
   
    $query1="select * from user where email=:email and pass=:pass";
    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        // MYSQLI
        // $stmt1->bind_param('sssssss', $name, $email, $password, $sex, $image, $date,$service); 
        
        // PDO
        $stmt1->bindParam(':email', $email); 
        $stmt1->bindParam(':pass', md5($password)); 
        // $stmt1->bindParam(':pass', $password); 
        $stmt1->execute();
        
        if ($stmt1->rowCount() == 1)  // PDO 
        {
            $_SESSION['email']= $email;
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



    <script async src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script async src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



</body>

</html>