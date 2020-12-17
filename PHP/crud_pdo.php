<?php
session_start();

include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();
?>

<?php

$name="";
$email="";
$pass="";
$sex="";
$image="";
$service="";
$update_flag=false;

//pdo fetch(PDO::FETCH_ASSOC) == mysqli fetch_array(MYSQLI_ASSOC) 

// $stmt2->fetch(PDO::FETCH_ASSOC) -->return an array in the form of key value pair
// $stmt2->fetch(PDO::FETCH_NUM) -->return an array in the form of index value pair
// $stmt2->fetch(PDO::FETCH_BOTH) -->return an array in the form of (key value) and (index value) pair
// $stmt2->fetch(PDO::FETCH_OBJ) -->return an array in the form of obj
// $stmt2->fetch() -->by default its FETCH_BOTH
//$row=$stmt2->fetch() //fetches a single row from a result set. Then we can use while loop to get row one by one
//$rows=$stmt2->fetchAll() fetches an array containing all of the rows from a result set. Then we can use foreach loop to print data
                    

// pdo rowCount() == mysqli num_rows & affected_rows

//rowCount(): returns the number of rows affected by the last (executed) SQL statement


if(isset($_GET['update_id'])){

    $update_flag=true;

    $id=$_GET['update_id'];

    $query1="select * from users where id=:id"; //PDO
    //$query1="select * from users where id=?"; //Mysqli

    $stmt1 = $db->prepare($query1);
    if ($stmt1) {
        $stmt1->bindParam(':id', $id); // PDO
        //$stmt1->bind_param('i', $id); // MYSQLI
        
        $stmt1->execute(); 

        // $result = $stmt1->get_result(); Mysqli (not used in PDO)

        if($stmt1->rowCount() == 1) // PDO
        //if($result->num_rows == 1) // Mysqli
        { 
            // $row = $stmt1->fetch_array(MYSQLI_ASSOC); // MYSQLI
            $row = $stmt1->fetch(PDO::FETCH_ASSOC); // PDO

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

        //Close Statement

        // $stmt1->close(); // MYSQLI
        unset($stmt1); // PDO

        // $db->close(); // MYSQLI
        // unset($db); // PDO
    }else{
        //oops something went wrong
    }
}


?>

<?PHP //require_once"Mysqli_practice2.php";?>








<html>

<head>
    <title>PDO CRUD</title>
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
            <form id="form1" method="post" action=crud_pdo2.php class="needs-validation1" enctype="multipart/form-data">
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
                // select *, count(*) from users having count(*)>1
                // select * from users qualify count(*) over (partition by email rows unbounded preceding) = 1
                // select id,name,sex,profile,service, count(email) e from users group by email having e = 1
                // SELECT id,name,email,sex,profile,service FROM users GROUP BY email HAVING COUNT(email) = 1
                // SELECT * FROM users WHERE EXISTS (SELECT DISTINCT email);
                if($stmt2=$db->query("SELECT UNIQUE(email) FROM users"))
                {
                    //if($stmt2->num_rows > 0) // Mysqli
                    if($stmt2->rowCount() > 0) // PDO
                    {
                        //while($r=$stmt2->fetch_array(MYSQLI_ASSOC)) // MYSQLI
                        while($r=$stmt2->fetch(PDO::FETCH_ASSOC)) //PDO
                        {
                        ?>
                <tr>
                    <td class="size13 p-0"><?php echo $r['id']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['name']  ?></td>
                    <?PHP // if fatch type is (PDO::FETCH_OBJ) then we have to access values, something like this $r->name ?>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['email']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['sex']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><img src="user_pics/<?php echo $r['profile']  ?>" width="100"
                            height="70"></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['service']  ?></td>
                    <td>
                        <?php 
                            echo '<a href="crud_pdo.php?update_id='.$r['id'].'" class="btn btn-warning cl_w">Update</a> &nbsp &nbsp &nbsp';
                            echo '<a href="crud_pdo2.php?delete_id='.$r['id'].'" class="btn btn-danger cl_w">Delete</a> &nbsp &nbsp &nbsp';
                        ?>
                    </td>
                </tr>
                <?php  
                        }
                    }else
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    
                } else
                    echo "ERROR: Could not able to execute query.";
                
                // $stmt2::close(); //MYSQLI
                unset($stmt2); // PDO

                // $db->close() //MYSQLI
                // unset($db); //PDO
                ?>
            </tbody>
        </table>
    </div>
    <!-- End of View Data List -->


</body>

</html>