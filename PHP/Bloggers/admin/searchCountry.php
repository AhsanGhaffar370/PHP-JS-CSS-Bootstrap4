<?php
session_start();
error_reporting(0);

include '../connect_db.php';
$database=new database();
$db = $database->connect_pdo();
?>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Our Blogs | Find Affordable Legal Help with us </title>
    <meta name="description" content="Hello bloggers">
    <?php include("head_libs.php"); ?>

    <style>
        #countrydata li a {
            color: black !important;
            transition: all 0.2s 0s ease-out;
            text-decoration: none !important;
            text-decoration-color: rgb(16, 206, 32);
        }

        #countrydata li a:hover {
            color: #0073aa !important;
        }
    </style>
</head>

<body>
<?php
if (isset($_GET['q'])) {

    $serval=$_GET['q'];
    $serval="%$serval%";

    $query1="select * from location where country like :country limit 0,5"; 
    $stmt1 = $db->prepare($query1);
    if ($stmt1) {
        $stmt1->bindParam(':country', $serval); 
        $stmt1->execute();
        if ($stmt1->rowCount() > 0)  // PDO 
        {
            while($row=$stmt1->fetch(PDO::FETCH_ASSOC)){
            echo '<li class="list-group-item"><a href="#">'.$row['country'].'</a></li>';
            }
        } else {
            echo "<script>alert('Something went wrong during fetching data')</script>";
        }
        unset($stmt1); //PDO
    }
}
?>
</body>
</html>