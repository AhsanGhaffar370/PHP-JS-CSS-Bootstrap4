<?php
if(isset($_GET['id']) && $_GET['id']>0){
    $url="api_url/delete.php?token=ahdhsasdnasbwdldkgldk";
    $ch=curl_init();
    $arr['id']=$_GET['id'];
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if(isset($result['status']) && isset($result['code']) && $result['code']==7){
        header('location:index.php');
        die();
    }else{
        echo $result['data'];
    }
}else{
    header('location:index.php');
    die();
}
?>