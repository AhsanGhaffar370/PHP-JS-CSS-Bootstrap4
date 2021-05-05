<?php
include('token.php');
if(!isset($status)){
    $sql="select * from user ";
    if(isset($_GET['id']) && $_GET['id']>0){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        $sql.=" where id='$id'";
    }
    $sqlRes=mysqli_query($con,$sql);
    if(mysqli_num_rows($sqlRes)>0){
        $data=[];
        while($row=mysqli_fetch_assoc($sqlRes)){
            $data[]=$row;
        }
        $status='true';
        $code='5';
    }else{
        $status='true';
        $data="Data not found";
        $code='4';
    }
}
echo json_encode(["status"=>$status,"data"=>$data,"code"=>$code]);
?>