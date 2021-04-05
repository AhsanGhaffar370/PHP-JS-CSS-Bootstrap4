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

    <style>
    
    #ser_rec {
        width: 200px;
        transition: 0.7s ease-in-out;
    }

    #ser_rec:focus {
        /* transform: scale(1.02); */
        width: 100%;
    }
    </style>


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
            <option value="<?PHP echo $row->id ?>">
                <?PHP echo $row->name ?>
            </option>

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
                    <td class="size13 pl_0 pr_0 pb_0"><img src="#" id="user_profile" width="100" height="70"></td>
                    <td id="user_service" class="size13 pl_0 pr_0 pb_0"></td>
                </tr>
            </tbody>
        </table>



        <h1 class="bg-primary text-white mt-5">Example3</h1>

        <form id="form21" method="post" action="#" class="container col-5 shadow p-5 mt-3 mb-3" enctype="multipart/form-data" >
        <h1 class="pb-3 font-weight-bold">Add User</h1>
            <input type="hidden" name="id" id="id" value=""/>
            <input type="text" name="name" id="name" value="" placeholder="Name" class="form-control mtop-3" />
            <input type="text" name="email" id="email" value="" placeholder="Email" class="form-control mt-3" />
            <img src="user_pics/default_pic.jpg" id="set_img" value="" class="img-responsive d-flex mt-3 rounded-circle" width="150" height="140">
            <input type="file" name="image" id="image" placeholder="Image" class="form-control mt-3" />
            <input type="submit" name="submit" id="submit21" value="Add User" class="btn btn-success mt-3" />
            <input type="submit" name="submit" id="submit22" value="Update User" class="btn btn-warning mt-3" style="display:none;"/>
        </form>


        <!-- View Data List -->
        <div class="container col-6 table-responsive">

        <h6 class="mt-3 text-left" >Search</h6>
        <input type="text" name="search_record" id="ser_rec" class="form-control mb-3 pt-4 pb-4 rounded-0" placeholder="Search Record" />
        <p id="ser_status" class="font-italic text-left text-danger"></p>

            <table class="table bg-white table-bordered">
                <tr class="thead-light">
                    <!-- <th class="b8">#</th> -->
                    <th class="b8">Name</th>
                    <th class="b8">Email</th>
                    <th class="b8">Profile Pic</th>
                    <th class="b8">Action</th>
                </tr>
                <tbody id="tabledata">
                    <?php
                if($stmt2=$db->query("SELECT * FROM users order by id desc"))
                {
                    if($stmt2->rowCount() > 0) // PDO
                    {
                        while($r=$stmt2->fetch(PDO::FETCH_ASSOC)) //PDO
                        {
                        ?>
                    <tr>
                        <!-- <td class="size13 p-0"><?php //echo $r['id']  ?></td> -->
                        <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['name']  ?></td>
                        <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['email']  ?></td>
                        <td class="size13 pl_0 pr_0 pb_0"><img src="user_pics/<?php echo $r['profile']  ?>" class="rounded-circle" width="75" height="70"></td>
                        <td><?php 
                            echo '<button id='.$r['id'].' class="update21 btn btn-warning cl_w">Update</button>&nbsp;&nbsp;';
                            echo '<button id='.$r['id'].' class="delete21 btn btn-danger cl_w">Delete</button>';
                            ?>
                        </td>
                    </tr>
                    <?php  
                        }
                    }else
                        echo "<p class='lead'><em>No records were found.</em></p>";
                } else
                    echo "ERROR: Could not able to execute query.";
                unset($stmt2); // PDO
                ?>
                </tbody>
            </table>
        </div>
        <!-- End of View Data List -->
    </div>


    <script>

    $(document).ready(function() {

        /////////////////////////////
        // Example4:
        /////////////////////////////
        $("#ser_rec").keyup(function(){
            let ser = $('#ser_rec').val();
            // alert(username);

            $.ajax({
                url: 'ajax_search.php',
                type: 'post',
                // dataType: 'json',
                data: 'ser_val=' + ser,
                success: function(result) {
                    // console.log(json_data.length);
                    if (result=="no records found"){
                        $("#ser_status").html("No records found");
                        $("#tabledata").html("");
                    }
                    else{
                        let json_data = $.parseJSON(result);
                        var len = json_data.length;
                        var tr_str="";

                        for(var i=0; i<len; i++){
                            var id = json_data[i].id;
                            var name = json_data[i].name;
                            var email = json_data[i].email;
                            var profile = json_data[i].profile;
                            tr_str+= '<tr>' + '<td class="size13 pl_0 pr_0 pb_0">' + name + '</td>' +
                                                '<td class="size13 pl_0 pr_0 pb_0">' + email + '</td>' +
                                                '<td class="size13 pl_0 pr_0 pb_0">' + '<img src="user_pics/'+profile+'" class="rounded-circle" width="75" height="70">' + '</td>' + 
                                                '<td class="size13 pl_0 pr_0 pb_0">' 
                                                        + '<button id="'+id+'" class="update21 btn btn-warning cl_w mr-2">Update</button>'+
                                                        '<button id="'+id+'" class="delete21 btn btn-danger cl_w">Delete</button>'+ 
                                                '</td>' + 
                                                
                                        '</tr>';
                        }
                        
                        $("#tabledata").html(tr_str);
                    }
                    
                    // console.log(json_data.id);
                    
                    

                    // $('#usertable').show();
                    // $('#user_id').html(json_data.id);
                    // $('#user_name').html(json_data.name);
                    // $('#user_email').html(json_data.email);
                    // $('#user_sex').html(json_data.sex);
                    // $('#user_profile').attr('src', 'user_pics/' + json_data.profile);
                    // $('#user_service').html(json_data.service);


                    // If num of records are more than 1:
                        
                        
                    
                }
            });
        });






        

        $('#set_img').attr('src', "user_pics/default_pic.jpg");
        /////////////////////////////
        // Example3:
        /////////////////////////////

        // $('.update21').click(function(e){
        //     e.preventDefault();
        //     let el= e.target;
            
        //     $('#submit22').show();
        //     $('#submit21').hide();
        // });

        // update data example3
        $(document).on('click','.update21',function(e){
            e.preventDefault();
            let el= e.target;
            let el_par= $(el).parent();

            $('#submit22').show();
            $('#submit21').hide();
            $("#form21").attr('id','update_form21');

            required_html = $(el_par).prevUntil(el_par, 0);

            // let image=$(required_html[0]).children().attr('src');
            // image=image.split("/");
            let email=$(required_html[1]).html();
            let name=$(required_html[2]).html();

            $("#id").val($(el).attr('id'));
            $("#name").val(name);
            $("#email").val(email);
            // $("#image").val(image[1]);
        });

        $(document).on('submit','#update_form21',function(e){
        // $("#update_form21").submit(function(e) {
            e.preventDefault();
            let id = $('#id').val();
            let name = $('#name').val();
            let email = $('#email').val();
            let img_name=$('#image').val().replace(/^.*[\\\/]/, '');

            if (name == "" || email == "" || $('#image').get(0).files.length === 0) {
                alert("Please fill out all fields");
            } else {
                $('#submit22').attr('value', 'Please Wait...');
                $('#submit22').attr('disabled', 'disabled');
                $.ajax({
                    url: 'ajax_update.php',
                    type: 'post',
                    // data: "name=" + name + "&email=" + email+ "&image="+image_obj,
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        alert("Record Updated");
                        $('#submit22').attr('value', 'Update User');
                        $('#submit22').removeAttr('disabled');

                        let el=$("#"+id);
                        let el_par= el.parent();
                        required_html = $(el_par).prevUntil(el_par, 0);

                        $(required_html[0]).children().attr('src',"user_pics/"+img_name);
                        // image=image.split("/");
                        $(required_html[1]).html(email);
                        $(required_html[2]).html(name);

                        $("#update_form21").attr('id','form21');
                        $('#submit21').show();
                        $('#submit22').hide();
                        $('#id').val("");
                        $('#name').val("");
                        $('#email').val("");
                        $('#image').val("");
                        $('#set_img').attr('src', "user_pics/default_pic.jpg");

                    }
                })
            }
        });


        //delete data example3
        $(document).on('click','.delete21',function(e){
        // $(".delete21").click(function(e){
            e.preventDefault();
            let el = e.target;
            let table_row=$(el).parent().parent();
            let deleteid = e.target.getAttribute('id');

            // alert(deleteid);

            let confirmalert = confirm("Are you sure?");
            if (confirmalert == true) 
            {
                // AJAX Request
                $.ajax({
                    url: 'ajax_delete.php',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        // alert(response);
                        // if(response == 1){
                            // Remove row from HTML Table
                            table_row.css('background','tomato');
                            table_row.fadeOut(800,function(){
                            table_row.remove();
                        });
                        // }else{
                            // alert('Invalid ID.');
                        // }

                    }
                });
            }
        });



        function readURL(input) {
            if (input.files && input.files[0]) {
                // var geekss = e.target.files[0].name;

                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#set_img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function(){readURL(this);});


        // insert and view data example3:
        $(document).on('submit','#form21',function(e){
        // $("#form21").submit(function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            let img_name=$('#image').val().replace(/^.*[\\\/]/, '');

            if (name == "" || email == "" || $('#image').get(0).files.length === 0) {
                alert("Please fill out all fields");
            } else {
                $('#submit21').attr('value', 'Please Wait...');
                $('#submit21').attr('disabled', 'disabled');
                $.ajax({
                    url: 'ajax_insert.php',
                    type: 'post',
                    // data: "name=" + name + "&email=" + email+ "&image="+image_obj,
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        alert("Record Inserted");
                        $('#submit21').attr('value', 'Add User');
                        $('#submit21').removeAttr('disabled');

                        let insertRow="";
                        insertRow+='<tr><td class="size13 pl_0 pr_0 pb_0">'+name+'</td>';
                        insertRow+='<td class="size13 pl_0 pr_0 pb_0">'+email+'</td>';
                        insertRow+='<td class="size13 p-0"><img src="user_pics/'+img_name+'" class="rounded-circle" width="100" height="70"></td>';
                        insertRow+='<td><button id='+result+' class="update21 btn btn-warning cl_w">Update</button>&nbsp;&nbsp;';
                        insertRow+='<button id='+result+' class="delete21 btn btn-danger cl_w">Delete</button></td>';
                        insertRow+="</tr>"
                        $("#tabledata").prepend(insertRow);

                        $('#name').val("");
                        $('#email').val("");
                        $('#image').val("");
                        $('#set_img').attr('src', "user_pics/default_pic.jpg");
                    }
                })
            }
        });
 




        /////////////////////////////
        // Example2:
        /////////////////////////////
        $('#usertable').hide();

        $('#username').change(function() {

            let username = $('#username').val();
            // alert(username);

            $.ajax({
                url: 'ajax_insert.php',
                type: 'post',
                data: 'userid=' + username,
                success: function(result) {
                    let json_data = $.parseJSON(result);
                    // console.log(json_data.id);
                    $('#usertable').show();

                    $('#user_id').html(json_data.id);
                    $('#user_name').html(json_data.name);
                    $('#user_email').html(json_data.email);
                    $('#user_sex').html(json_data.sex);
                    $('#user_profile').attr('src', 'user_pics/' + json_data.profile);
                    $('#user_service').html(json_data.service);


                    // If num of records are more than 1:
                    // var len = result.length;
                    // for(var i=0; i<len; i++){
                    //     var id = response[i].id;
                    //     var name = response[i].name;
                    //     var email = response[i].email;
                    //     var tr_str = "<tr>" + "<td align='center'>" + (i+1) + "</td>" +
                    //                           "<td align='center'>" + name + "</td>" +
                    //                           "<td align='center'>" + email + "</td>" + "</tr>";
                    //     $("#usertable tbody").append(tr_str);
                    // }
                }
            });
        });



        /////////////////////////////
        // Example1:
        /////////////////////////////
        $('#click_me').click(function(e) {

            e.preventDefault();
            let name = $('#name1').val();

            $.ajax({
                url: 'ajax_insert.php', //url of page which we want to hit
                type: 'post', // request type
                // async: false,
                data: 'name=' + name, //data we send to ajax_insert.php
                success: function(result) { // when data receive from ajax_insert.php page, it stores in result variable
                    alert(result);
                }
            });
        });


    });
    </script>

</body>

</html>