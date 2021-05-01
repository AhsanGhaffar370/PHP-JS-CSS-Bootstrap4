<?php
session_start();
error_reporting(0);

include '../connect_db.php';
$database=new database();
$db = $database->connect_pdo();

$check_status = 1;

$query1="select * from user where email=:email and status=:status";
$stmt1 = $db->prepare($query1);

if ($stmt1) {
    $stmt1->bindParam(':email', $_POST['email']); 
    $stmt1->bindParam(':status', $check_status);
    $stmt1->execute();
    if ($stmt1->rowCount() > 0)
    {
        echo true;
    } else {
        echo false;
    }
    unset($stmt1);
}

    // $serval=$_GET['q'];
    // $serval="%$serval%";
    // $query1="select * from location where country like :country limit 0,5"; 
    // $stmt1 = $db->prepare($query1);
    // if ($stmt1) {
    //     $stmt1->bindParam(':country', $serval); 
    //     $stmt1->execute();
    //     if ($stmt1->rowCount() > 0)  // PDO 
    //     {
    //         while($row=$stmt1->fetch(PDO::FETCH_ASSOC)){
    //         echo '<li class="list-group-item">'.$row['country'].'</li>';
    //         // echo '<i class="fas fa-info-circle"></i> Email Already Exist';
    //         }
    //     } else {
    //         echo "<script>alert('Something went wrong0')</script>";
    //     }
    //     unset($stmt1); //PDO
    // }
?>
    