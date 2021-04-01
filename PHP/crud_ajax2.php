<?php

//test github
session_start();

include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();



//insert reocrd
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']); // md5() function convert pass into hash code
    $sex = $_POST['sex'];
    $date = trim(date("Y-m-d"));
    $service="";
    foreach($_POST['service'] as $i) {
        $service.=$i.', ';
    }

    // image insertion process
    $image = $_FILES['image']['name'];
    $fileext = pathinfo($image, PATHINFO_EXTENSION);

    if (!($fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'png' || $fileext == 'PNG')) {
        echo "Incorrect File Format";
    } 
    else {

        // Insert Query
        // $query1="insert into users set name=?,email=?,password=?,sex=?,profile=?,DoJ=?,service=?"; // MYSQLI
        $query1="insert into users set name=:name,email=:email,password=:pass,sex=:sex,profile=:profile,DoJ=:doj,service=:ser"; // PDO
        $stmt1 = $db->prepare($query1);
        
        if ($stmt1) {
            // MYSQLI
            // $stmt1->bind_param('sssssss', $name, $email, $password, $sex, $image, $date,$service); 
            
            // PDO
            $stmt1->bindParam(':name', $name); 
            $stmt1->bindParam(':email', $email); 
            $stmt1->bindParam(':pass', $password); 
            $stmt1->bindParam(':sex', $sex); 
            $stmt1->bindParam(':profile', $image); 
            $stmt1->bindParam(':doj', $date); 
            $stmt1->bindParam(':ser', $service); 
            
            $stmt1->execute();
            
            // if ($stmt1->affected_rows == 1)  //MYSQLI
            if ($stmt1->rowCount() == 1)  // PDO 
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'user_pics/'.$image);
                // echo "Insert succesfully";
            } else {
                echo "Not Insert";
            }
            
            // $stmt1->close(); // MYSQLI
            unset($stmt1); //PDO

            // $db->close() //MYSQLI
            // unset($db); //PDO


            $_SESSION['message']= "Record added successfully";
            $_SESSION['msg_type']= "Success";

            header("location: crud_ajax.php");
        }
    }
}

// delete record
if(isset($_GET['delete_id'])){

    $id=$_GET['delete_id'];


    //remove image from directory
    // $query1="select profile from users where id=?"; //MYSQLI
    $query1="select profile from users where id=:id"; //PDO
    
    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        // $stmt1->bind_param('i', $id); // MYSQLI
        $stmt1->bindParam(':id', $id); //PDO
        $stmt1->execute(); 

        // $result = $stmt1->get_result();

        // if($result->num_rows == 1) //MYSQLI
        if($stmt1->rowCount() == 1) //PDO
        {
            // $row = $result->fetch_array(MYSQLI_ASSOC); //MYSQLI
            $row = $stmt1->fetch(PDO::FETCH_ASSOC); //PDO
            $image = $row["profile"];

            if (file_exists("user_pics/$image")) //check whether an image is exist or not
                unlink("user_pics/$image"); // this function will remove image from directory
        } else{
            // exit();
        }

        // $stmt1->close(); // MYSQLI
        unset($stmt1); //PDO

    }else{
        //oops something went wrong
    }

    //remove record from database
    // $query1="delete from users where id=?"; //MYSQLI
    $query1="delete from users where id=:id"; //PDO
    
    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        // $stmt1->bind_param('i', $id); //MYSQLI
        $stmt1->bindParam(':id', $id); //PDO
        
        $stmt1->execute(); 

        // $stmt1->close(); // MYSQLI
        unset($stmt1); //PDO

        // $db->close() //MYSQLI
        // unset($db); //PDO

        $_SESSION['message']= "Record deleted successfully";
        $_SESSION['msg_type']= "danger";

        header("location: crud_ajax.php");

    }else{
        //oops something went wrong
    }
}


//update record
if(isset($_POST['update'])){

    $id=$_POST['id'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']); // md5() function convert pass into hash code
    $sex = $_POST['sex'];
    $date = trim(date("Y-m-d"));
    $service="";
    foreach($_POST['service'] as $i) {
        $service.=$i.', ';
    }

    // image insertion process
    $image = $_FILES['image']['name'];
    $fileext = pathinfo($image, PATHINFO_EXTENSION);

    if (!($fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'png' || $fileext == 'PNG')) {
        echo "Incorrect File Format";
    } 
    else {

        // Insert Query
        
        // $query1 = "UPDATE users SET name=?,email=?,password=?,sex=?,profile=?,DoJ=?,service=? WHERE id=?";  //MYSQLI
        $query1 = "UPDATE users SET name=:name,email=:email,password=:pass,sex=:sex,profile=:profile,DoJ=:doj,service=:ser WHERE id=:id";  //MYSQLI
        $stmt1 = $db->prepare($query1);
        
        if ($stmt1) {
            //MYSQLI
            // $stmt1->bind_param('sssssssi', $name, $email, $password, $sex, $image, $date,$service, $id); 
            
            // PDO
            $stmt1->bindParam(':name', $name); 
            $stmt1->bindParam(':email', $email); 
            $stmt1->bindParam(':pass', $password); 
            $stmt1->bindParam(':sex', $sex); 
            $stmt1->bindParam(':profile', $image); 
            $stmt1->bindParam(':doj', $date); 
            $stmt1->bindParam(':ser', $service); 
            $stmt1->bindParam(':id', $id); 

            $stmt1->execute();
            
            // if ($stmt1->affected_rows == 1)  //MYSQLI
            if ($stmt1->rowCount() == 1)  // PDO 
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'user_pics/'.$image);
                // echo "Insert succesfully";
            } else {
                echo "Not Insert";
            }

            // $stmt1->close(); // MYSQLI
            unset($stmt1); //PDO

            // $db->close() //MYSQLI
            // unset($db); //PDO

            $_SESSION['message']= "Record updated successfully";
            $_SESSION['msg_type']= "info";

            header("location: crud_ajax.php");
            
        }else{
            //oops something went wrong
        }
    }
}



?>