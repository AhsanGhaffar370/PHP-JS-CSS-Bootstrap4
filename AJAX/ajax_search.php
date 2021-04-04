<?php
include('connect_db.php');
$database= new database();
$db=$database->connect_pdo();


$ser_val=$_POST['ser_val'];
$ser_v="%$ser_val%";
// print_r($ser_val);
$return_arr = array();
// echo $name;
$query='select id,name,email,profile from users where name like :name or email like :email';
// $query='select * from users';
$stmt=$db->prepare($query);

if($stmt){
    $stmt->bindParam(':name',$ser_v);
    $stmt->bindParam(':email',$ser_v);
    $stmt->execute();

    if($stmt->rowCount()>0){
        // $row=$stmt->fetch(PDO::FETCH_OBJ);
        // echo json_encode($row);

        // If num of records are more than 1
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $profile = $row['profile'];
            $return_arr[] = array("id" => $id, "name" => $name, "email" => $email, "profile" => $profile);
        }
        // print_r($return_arr);
        echo json_encode($return_arr);
        // echo $add_val;
    }
    else{
        echo "no records found";
    }
}

?>
