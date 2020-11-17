<?php
session_start();

include 'connect_db.php';
$database=new database();
$db = $database->connect_mysqli();
?>

<?php

$name="";
$email="";
$pass="";
$sex="";
$image="";
$service="";
$update_flag=false;


if(isset($_GET['update_id'])){

    $update_flag=true;

    $id=$_GET['update_id'];

    $query1="select * from users where id=?";

    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        $stmt1->bind_param('i', $id);
        $stmt1->execute(); 

        $result = $stmt1->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);

            $name = $row["name"];
            $email = $row["email"];
            $pass = $row["password"];
            $sex = $row["sex"];
            $image = $row["profile"];
            $service = $row["service"];

            
        } else{
            // URL doesn't contain valid id. Redirect to error page
            // exit();
        }

        $stmt1->close(); 
    }else{
        //oops something went wrong
    }
}


?>

<?PHP //require_once"Mysqli_practice2.php";?>








<html>

<head>
    <title>Mysqli CRUD</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes" />
    <link href="css_prac1.css" type="text/css" rel="stylesheet" media="screen" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/7516c4b4cc.js" crossorigin="anonymous"></script>
</head>

<body class="ml_2 mr_2 ">

    <p class="size36 cl_b tc b8">Complete CRUD with PHP</p>
    <section class="pb_1 pt_1 con con85" id="contact_1">
        <div class=" sh_md form_grid1 pt_1 pb_2 pl_2 pr_2">

            <p class="size30 cl_b tc b8">Add Employee</p>


            <?PHP 
            if (isset($_SESSION['message'])){?>
            <div class="size13 alert alert-<?=$_SESSION['msg_type']?> verCen">
                <?PHP 
                echo $_SESSION['message']; 
                unset($_SESSION['message']) ;
                ?>
            </div>
            <?php } ?>


            <!-- Form Starts -->
            <form id="form1" method="post" action=crud_Mysqli2.php class="needs-validation1"
                enctype="multipart/form-data">
                <!--enctype="multipart/form-data" is used with post method -->

                <input type="hidden" name="id" value="<?php echo $id; ?>" /><!-- hidden id input -->

                <div class="form-group">
                    <label class="b7 size14" for="name1">Name:</label>
                    <input type="text" class="form-control p-2" id="name1" name="name" value="<?php echo $name; ?>"
                        placeholder="Full Name" />
                </div>

                <div class="form-group">
                    <label class="b7 size14" for="email1">Email:</label>
                    <input type="email" class="form-control p-2" id="email1" name="email" value="<?php echo $email; ?>"
                        placeholder="Email" />
                </div>

                <div class="form-group">
                    <label class="b7 size14" for="pass1">Password:</label>
                    <input type="password" class="form-control p-2" id="pass1" name="pass" value="<?php echo $pass; ?>"
                        placeholder="password" />
                </div>

                <div class="form-group">
                    <label class="b7 size14">Sex:</label><br>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" id="male1" name="sex" value="male" <?PHP
                            if($sex=='male' ) echo "checked" ; ?>/>
                        <label class="form-check-label" for="male1"> Male </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" id="female1" name="sex" value="female" <?PHP
                            if($sex=='female' ) echo "checked" ; ?>/>
                        <label class="form-check-label" for="female1"> Female </label>
                    </div>
                    <br>
                </div>

                <div class="form-group">
                    <label class="b7 size14" for="image1">Profile Pic:</label>
                    <input type="file" class="form-control p-2" id="image1" name="image"
                        value="user_pics/<?php echo $r['profile']  ?>" placeholder="image" />
                </div>

                <div class="form-group">
                    <label class="b7 size14">Services:</label><br>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="service1" name="service[]" value="html"
                            <?php  if($service=="html, ") {echo 'Checked';} elseif ($service=="html, php, ") {echo 'checked';}  ?> />
                        <label class="form-check-label" for="service1"> html </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="checkbox" id="service2" name="service[]" value="php"
                            <?php  if($service=="php, ") {echo 'Checked';} elseif ($service=="html, php, ") {echo 'checked';}  ?> />
                        <label class="form-check-label" for="service1"> php</label>
                    </div>
                    <br>
                </div>

                <div class="tc">
                    <input type="reset" name="reset" value="Reset" class="button btn_xxs btn-secondary d_in b7" />


                    <?PHP if ($update_flag==true):?>
                    <input type="submit" name="update" value="Update" class="button btn_xxs btn-warning d_in b7" />
                    <?PHP else:?>
                    <input type="submit" name="insert" value="Save" class="button btn_xxs btn-info d_in b7" />
                    <?PHP endif; ?>

                </div>
            </form>
            <!-- End of form -->
        </div>
    </section>


    <!-- View Data List -->
    <div class="container table-responsive">
        <table class="table table-light table-striped table-bordered">
            <tr class="thead-dark">
                <th class="b8">#</th>
                <th class="b8">Name</th>
                <th class="b8">Email</th>
                <th class="b8">Sex</th>
                <th class="b8">Profile Pic</th>
                <th class="b8">Service</th>
                <th class="b8">Action</th>
            </tr>
            <tbody>
                <?php
                if($stmt2=$db->query("SELECT * from users"))
                {
                    while($r=$stmt2->fetch_array(MYSQLI_ASSOC))
                    {
                ?>

                <tr>
                    <td class="size13 p-0"><?php echo $r['id']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['name']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['email']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['sex']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><img src="user_pics/<?php echo $r['profile']  ?>" width="100"
                            height="70"></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['service']  ?></td>
                    <td>
                        <?php 
                        echo '<a href="crud_Mysqli.php?update_id='.$r['id'].'" class="btn btn-warning cl_w">Update</a> &nbsp &nbsp &nbsp';
                        echo '<a href="crud_Mysqli2.php?delete_id='.$r['id'].'" class="btn btn-danger cl_w">Delete</a> &nbsp &nbsp &nbsp';
                        
                        ?>
                    </td>


                </tr>
                <?php  
                    }
                } 
                mysqli_free_result($stmt2);
                ?>
            </tbody>
        </table>
    </div>
    <!-- End of View Data List -->


</body>

</html>