<?php
include('token.php');
if(!isset($status)){
    if(isset($_POST['id']) && $_POST['id']>0){
        $id=mysqli_real_escape_string($con,$_POST['id']);
        mysqli_query($con,"delete from user where id='$id'");
        $status='true';
        $data="Data deleted";
        $code='7';
    }else{
        $status='true';
        $data="Provide id";
        $code='6';
    }
}
echo json_encode(["status"=>$status,"data"=>$data,"code"=>$code]);
?>