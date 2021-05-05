<?php
include('db.php');
header('Content-Type:application/json');
if(isset($_GET['token'])){
    $token=mysqli_real_escape_string($con,$_GET['token']);
    $checkTokenRes=mysqli_query($con,"select * from api_token where token='$token'");
    if(mysqli_num_rows($checkTokenRes)>0){
        $checkTokenRow=mysqli_fetch_assoc($checkTokenRes);
        if($checkTokenRow['status']==1){
            
        }else{
            $status='true';
            $data="API token deactivated";
            $code='3';
        }
    }else{
        $status='true';
        $data="Please provide valid API token";
        $code='2';
    }
    
}else{
    $status='true';
    $data="Please provide API token";
    $code='1';
}
?>