<?php
include('token.php');
if(!isset($status)){
    if(isset($_POST['name']) && isset($_POST['email'])){
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);

        if(isset($_GET['id']) && $_GET['id']>0){
            $id=mysqli_real_escape_string($con,$_GET['id']);
            mysqli_query($con,"update user set name='$name', email='$email' where id='$id'");   
            $data="Data updated";
            $code='10';
        }else{
            mysqli_query($con,"insert into user(name,email) values('$name','$email')");
            $data="Data inserted";
            $code='8';
        }

        $status='true';
    }else{
        $status='true';
        $data="Provide valid column count";
        $code='9';
    }
}
echo json_encode(["status"=>$status,"data"=>$data,"code"=>$code]);
?>