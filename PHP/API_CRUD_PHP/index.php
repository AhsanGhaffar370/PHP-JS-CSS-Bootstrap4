<?php
$url="api_url/index.php?token=ahdhsasdnasbwdldkgldk";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($ch);
curl_close($ch);
$result=json_decode($result,true);
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
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>User</h2>
                    </div>
                    <div class="col-sm-7">
                        <a href="form.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>					
                    </div>
                </div>
            </div>
            <?php
            if(isset($result['status']) && isset($result['code']) && $result['code']==5){
                ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>	
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($result['data'] as $list){
                            ?>
                            <tr>
                                <td><?php echo $list['id']?></td>
                                <td><?php echo $list['name']?></a></td>
                                <td><?php echo $list['email']?></td>
                                <td>
                                <a href="form.php?id=<?php echo $list['id']?>" class="edit" title="Edit"><i class="material-icons colorize">&#xe3b8;</i></a>
                                <a href="delete.php?id=<?php echo $list['id']?>" class="delete" title="Delete" ><i class="material-icons">&#xE5C9;</i></a>
                                </td>
                            </tr>
                            <?php        
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }else{
                echo $result['data'];
            }
            ?>
        </div>
    </div>
</div>     	
</body>
</html>
