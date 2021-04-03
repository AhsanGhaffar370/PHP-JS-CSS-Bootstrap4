<?php
include('connect_db.php');
$database= new database();
$db=$database->connect_pdo();



////////////////
// Example3:
////////////////
sleep(1);
// print_r( $_FILES);




$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$image = $_FILES['image']['name'];
$fileext = pathinfo($image, PATHINFO_EXTENSION);

//update record
if (!($fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'png' || $fileext == 'PNG'))
    echo "Incorrect File Format";
else if($_FILES['image']['size']>1000000) //1000000 => 1MB
    echo "file size is too big";
else {
    $query='UPDATE users SET name=:name,email=:email,profile=:profile WHERE id=:id';
    $stmt=$db->prepare($query);

    if($stmt){
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':profile',$image);
        $stmt->bindParam(':id',$id);
        $stmt->execute();

        $id=$db->lastInsertId();

        if($stmt->rowCount() == 1){

            //delete image from folder
            $query1="select profile from users where id=:id"; 
            $stmt2 = $db->prepare($query1);

            if ($stmt2) {
                $stmt2->bindParam(':id', $id); 
                $stmt2->execute(); 

                if($stmt2->rowCount() == 1) {
                    $row = $stmt2->fetch(PDO::FETCH_ASSOC); 
                    $image = $row["profile"];

                    if (file_exists("user_pics/$image")) //check whether an image is exist or not
                        unlink("user_pics/$image"); // this function will remove image from directory
                        $resp= 1;
                } else{
                    // exit();
                    echo "Something went wrong";
                }
                unset($stmt2); //PDO

            }else{
                echo "Something went wrong in deleting image";
            }

            // save updated image in folder
            move_uploaded_file($_FILES['image']['tmp_name'],'user_pics/'.$image);
            echo $id;
        }
    }
}

?>