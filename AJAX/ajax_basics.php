<?php

include("connect_db.php");

$database= new database();
$db=$database->connect_pdo();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <!-- Font awesome -->
    <!-- <script src="https://kit.fontawesome.com/7516c4b4cc.js" crossorigin="anonymous"></script> -->
    <!-- <link  href="style.css" type="text/css" rel="stylesheet" media="screen"> -->

</head>
<body>
    <div class="text-center">

        <h1 class="bg-primary text-white mt-5">Example1</h1>
        <input class="" type="text" name="name" id="name1" />
        <a class="btn btn-warning" href="#" id="click_me">Click me</a>
        


        <h1 class="bg-primary text-white mt-5">Example2</h1>

        <select name="user" class="" id="username">
            <?php
                $query="select * from users";
                $stmt=$db->query($query);

                while($row=$stmt->fetch(PDO::FETCH_OBJ)){
            ?>
            <option value="<?PHP echo $row->id ?>"><?PHP echo $row->name ?></option>

            <?PHP }?>
        </select>

        <table id="usertable" class="table table-light table-striped table-bordered container">
            <tr class="thead-dark">
                <th class="b8">#</th>
                <th class="b8">Name</th>
                <th class="b8">Email</th>
                <th class="b8">Sex</th>
                <th class="b8">Profile Pic</th>
                <th class="b8">Service</th>
            </tr>
            <tbody>
                <tr>
                    <td id="user_id" class="size13 p-0"></td>
                    <td id="user_name" class="size13 pl_0 pr_0 pb_0"></td>
                    <td id="user_email" class="size13 pl_0 pr_0 pb_0"></td>
                    <td id="user_sex" class="size13 pl_0 pr_0 pb_0"></td>
                    <td  class="size13 pl_0 pr_0 pb_0"><img src="#" id="user_profile" width="100" height="70"></td>
                    <td id="user_service" class="size13 pl_0 pr_0 pb_0"></td>
                </tr>
            </tbody>
        </table>



        <h1 class="bg-primary text-white mt-5">Example3</h1>

        <div class="container col-6">
            <input type="text" name="name" id="name" placeholder="Name" class="form-control mtop-3" />
            <input type="text" name="email" id="email" placeholder="Email" class="form-control mt-3" />
            <input type="file" name="image" id="image" placeholder="Image" class="form-control mt-3" />
            <input type="button" name="submit" id="submit21" value="Add User" class="btn btn-danger mt-3"/>
        </div>

        <!-- <table id="usertable" class="table table-light table-bordered container">
            <tr class="thead-dark">
                <th class="b8">Name</th>
                <th class="b8">Email</th>
                <th class="b8">Profile Pic</th>
            </tr>
            <tbody>
                <tr>
                    <td id="user_name21" class="size13 pl_0 pr_0 pb_0"></td>
                    <td id="user_email21" class="size13 pl_0 pr_0 pb_0"></td>
                    <td  class="size13 pl_0 pr_0 pb_0"><img src="#" id="user_profile" width="100" height="70"></td>
                </tr>
            </tbody>
        </table> -->

    </div>





<script>

$(document).ready(function(){


    // Example3:
    $("#submit21").click(function(){
        let name=$('#name').val()
        let email=$('#email').val()
        // let name=$('#name').val()

        if( name=="" || email==""){
            alert("Please fill out all fields");
        }
        else{
            // alert("Please Wait");
            $('#submit21').attr('value', 'Please Wait...');
            $('#submit21').attr('disabled', 'disabled');
            $.ajax({
                url: 'ajax_get.php',
                type: 'post',
                data: "name="+name+"&email="+email,
                success: function (result){
                    alert(result);
                    $('#submit21').attr('value', 'Add User');
                    $('#submit21').removeAttr('disabled');
                }
            })
        }
    });



    //Example2:
    $('#usertable').hide();

    $('#username').change(function(){

        let username=$('#username').val();
        // alert(username);

        $.ajax({
            url: 'ajax_get.php', 
            type: 'post', 
            data: 'userid='+username, 
            success: function (result){ 
                let json_data=$.parseJSON(result);
                // console.log(json_data.id);
                $('#usertable').show();

                $('#user_id').html(json_data.id);
                $('#user_name').html(json_data.name);
                $('#user_email').html(json_data.email);
                $('#user_sex').html(json_data.sex);
                $('#user_profile').attr('src','user_pics/'+json_data.profile);
                $('#user_service').html(json_data.service);
            }
        });
    });



    //Example1:
    $('#click_me').click(function(e){

        e.preventDefault();
        let name=$('#name1').val();

        $.ajax({
            url: 'ajax_get.php', //url of page which we want to hit
            type: 'post', // request type
            // async: false,
            data: 'name='+name, //data we send to ajax_get.php
            success: function (result){ // when data receive from ajax_get.php page, it stores in result variable
                alert(result);
            }
        });
    });


});

</script>

</body>
</html>