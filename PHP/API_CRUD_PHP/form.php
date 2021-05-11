<?php
$msg="";
$name="";
$email="";
if(isset($_POST['submit'])){
    $arr['name']=$_POST['name'];
    $arr['email']=$_POST['email'];
    $id="";
    if(isset($_GET['id']) && $_GET['id']>0){
        $id=$_GET['id'];
    }
    $url="api_url/manage_form.php?token=ahdhsasdnasbwdldkgldk&id=".$id;
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    $msg=$result['data'];
}

if(isset($_GET['id']) && $_GET['id']>0){
    $url="https://programmingwithvishal.com/api/index.php?token=ahdhsasdnasbwdldkgldk&id=".$_GET['id'];
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if(isset($result['status']) && isset($result['code']) && $result['code']==5){
        $name=$result['data']['0']['name'];
        $email=$result['data']['0']['email'];
    }else{
        header('location:index.php');
        die();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>API Crud Operation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Manage User</h2>
                    </div>
                    <div class="col-sm-7">
                        <a href="index.php" class="btn btn-secondary"><i class="material-icons arrow_back">&#xe5c4;</i> <span>Back</span></a>					
                    </div>
                </div>
            </div>
        </div>
    </div>
         
    <div class="row" id="form_bg">
        <?php echo $msg?>
        <form method="post">
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="name" class="form-control" id="name" name="name" placeholder="Enter name" required value="<?php echo $name?>">
                </div>       
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="email" class="form-control" id="nombre" name="email" placeholder="Enter email" required value="<?php echo $email?>">
                </div>       
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-info btn-block" name="submit">
                </div>       
            </div>
        </form>
    </div>	
</div>
</body>
</html>
