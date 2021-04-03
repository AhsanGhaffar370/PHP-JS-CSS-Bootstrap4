<?php


$name=$_POST['ser_val'];

$query='select * from users where name like :%name%';
$stmt=$db->prepare($query);

if($stmt){
    $stmt->bindParam(':name',$name);
    $stmt->execute();

    if($stmt->rowCount()>0){
        // $row=$stmt->fetch(PDO::FETCH_OBJ);

        // echo json_encode($row);

        // If num of records are more than 1
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $row['id'];
            $username = $row['name'];
            $email = $row['email'];
            $return_arr[] = array("id" => $id, "name" => $name, "email" => $email);
        }
        echo json_encode($return_arr);
    }
}

?>
