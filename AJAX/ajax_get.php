<?php
include('connect_db.php');
$database= new database();
$db=$database->connect_pdo();



////////////////
// Example3:
////////////////
sleep(3);
$name=$_POST['name'];
$email=$_POST['email'];

$query='insert into users set name=:name,email=:email';

$stmt=$db->prepare($query);

if($stmt){
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':email',$email);
    $stmt->execute();

    if($stmt->rowCount() == 1){
        // print_r($_POST);
        echo "Data Submitted";
    }
}



////////////////
// Example2:
////////////////
// $id=$_POST['userid'];

// $query='select * from users where id=:id';
// $stmt=$db->prepare($query);

// if($stmt){
//     $stmt->bindParam(':id',$id);
//     $stmt->execute();

//     if($stmt->rowCount()==1){
//         $row=$stmt->fetch(PDO::FETCH_OBJ);
//         echo json_encode($row);
//     }
// }



////////////////
// Example1:
////////////////
// echo "hello ajax";
// print_r($_POST)


?>