<?php
include('connect_db.php');
$database= new database();
$db=$database->connect_pdo();



////////////////
// Example3:
////////////////
sleep(1);
// print_r( $_FILES);
$name=$_POST['name'];
$email=$_POST['email'];
// $image=$_POST['image'];

// print_r($_FILES);

// image insertion process
$image = $_FILES['image']['name'];
$fileext = pathinfo($image, PATHINFO_EXTENSION);

if (!($fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'png' || $fileext == 'PNG')) {
    echo "Incorrect File Format";
} 
else if($_FILES['image']['size']>1000000){ //1000000 => 1MB
    echo "file size is too big";
}
else {

    $query='insert into users set name=:name,email=:email,profile=:image';

    $stmt=$db->prepare($query);

    if($stmt){
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':image',$image);
        $stmt->execute();

        $id=$db->lastInsertId();

        if($stmt->rowCount() == 1){
            // print_r($_POST);
            move_uploaded_file($_FILES['image']['tmp_name'],'user_pics/'.$image);
            echo $id;
        }
    }
}



////////////////
// Example2:
////////////////
$id=$_POST['userid'];

$query='select * from users where id=:id';
$stmt=$db->prepare($query);

if($stmt){
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    if($stmt->rowCount()==1){
        $row=$stmt->fetch(PDO::FETCH_OBJ);

        echo json_encode($row);

        // If num of records are more than 1
        // while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //     $id = $row['id'];
        //     $username = $row['name'];
        //     $email = $row['email'];
        //     $return_arr[] = array("id" => $id, "name" => $name, "email" => $email);
        // }
        // echo json_encode($return_arr);
    }
}



////////////////
// Example1:
////////////////
// echo "hello ajax";
// print_r($_POST)

?>