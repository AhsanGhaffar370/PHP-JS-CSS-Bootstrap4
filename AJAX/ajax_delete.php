<?php
include('connect_db.php');
$database= new database();
$db=$database->connect_pdo();



////////////////
// Example4:
////////////////
// sleep(1);

$id=$_POST['id'];
$resp=0;

$query1="select profile from users where id=:id"; 
$stmt1 = $db->prepare($query1);

if ($stmt1) {
    $stmt1->bindParam(':id', $id); 
    $stmt1->execute(); 

    if($stmt1->rowCount() == 1) {
        $row = $stmt1->fetch(PDO::FETCH_ASSOC); 
        $image = $row["profile"];

        if (file_exists("user_pics/$image")) //check whether an image is exist or not
            unlink("user_pics/$image"); // this function will remove image from directory
            $resp= 1;
    } else{
        // exit();
        echo "Something went wrong";
    }
    unset($stmt1); //PDO

}else{
    echo "Something went wrong in deleting image";
}



$query1="delete from users where id=:id"; //PDO
$stmt1 = $db->prepare($query1);

if ($stmt1) {
    $stmt1->bindParam(':id', $id); //PDO
    $stmt1->execute(); 
    unset($stmt1); //PDO
    $resp= 1;
}else{
    echo "Something went wrong in deleting record";
}


?>