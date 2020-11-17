<?php

session_start();

include 'connect_db.php';
$database=new database();
$db = $database->connect_mysqli();


//function to check whether a table is already exisit or not
function check_table($table){
    GLOBAL $db;
    $flag=FALSE;
    
    $query = "show tables";
    $result= $db->query($query);
    
    if($result !== false){
        if($result->num_rows > 0) {
            while($data= $result->fetch_array(MYSQLI_ASSOC)){

                if($data['Tables_in_demo1'] == $table)
                $flag= TRUE;  
            }
        }
        else 
            echo 'There is no table in "demo1"';

        $result->free_result();// Free result set
    }
    else 
        echo "Unable to check the $table, error - ". $db->error;
    
    return $flag;
}

$name="";
$email="";
$gender="";
$update_flag=false;

if(isset($_GET['update_id'])){

    $update_flag=true;

    $id=$_GET['update_id'];

    $query1="select * from user1 where id=?";
    
        $stmt1 = $db->prepare($query1);
        
        if ($stmt1) {
            //  s= string, i= integer, d= double, b= BLOB
            $stmt1->bind_param('i', $id);
            $stmt1->execute(); //Returns TRUE on success or FALSE on failure.
    
            $result = $stmt1->get_result();

            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                // Retrieve individual field value
                $name = $row["name"];
                $email = $row["email"];
                $gender = $row["gender"];
            } else{
                // URL doesn't contain valid id. Redirect to error page
                // header("location: error.php");
                // exit();
            }

            $stmt1->close(); // close connection (free the variable using close )
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

    <p class="size36 cl_b tc b8">Complete MYSQLI Practice and CRUD with PHP</p>
    <section class="pb_1 pt_1 con con85" id="contact_1">
        <div class=" sh_md form_grid1 pt_1 pb_2 pl_2 pr_2">

            <p class="size30 cl_b tc b8">Add Employee</p>


            <?PHP 
            if (isset($_SESSION['email_err'])){?>
            <div class="size13 alert alert-danger verCen">
                <?PHP 
                echo $_SESSION['email_err']; 
                unset($_SESSION['email_err']) ;
                ?>
            </div>
            <?php } ?>

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
            <form id="form1" method="post" action=Mysqli_practice2.php class="needs-validation1"
                enctype="multipart/form-data">
                <!--enctype="multipart/form-data" is used with post method -->

                <input type="hidden" name="id" value="<?php echo $id; ?>" /><!-- hidden id input -->
                <div class="form-group">
                    <input type="text" class="form-control p-2" id="name1" name="name" value="<?php echo $name; ?>"
                        placeholder="Full Name" />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control p-2" id="email1" name="email" value="<?php echo $email; ?>"
                        placeholder="Email" />
                </div>
                <div class="form-group">
                    <label class="b8">Gender:</label>&nbsp
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" id="male1" name="gender" value="male" <?PHP
                            if($gender=='male' ) echo "checked" ; ?>/>
                        <label class="form-check-label" for="male1"> Male </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" id="female1" name="gender" value="female" <?PHP
                            if($gender=='female' ) echo "checked" ; ?>/>
                        <label class="form-check-label" for="female1"> Female </label>
                    </div>
                    <br>
                </div>
                <div class="tc">
                    <input type="reset" name="reset" value="Reset" class="button btn_xxs btn-secondary d_in b7" />


                    <?PHP if ($update_flag==true):?>
                    <input type="submit" name="update" value="Update" class="button btn_xxs btn-info d_in b7" />
                    <?PHP else:?>
                    <input type="submit" name="save" value="Save" class="button btn_xxs d_in b7" />
                    <?PHP endif; ?>

                </div>
            </form>
            <!-- End of form -->
        </div>
    </section>

    <!-- View Data List -->
    <div class="container table-responsive">
        <table class="table table-light table-striped table-hover table-bordered">
            <tr class="thead-dark">
                <th class="b8">#</th>
                <th class="b8">Name</th>
                <th class="b8">Email</th>
                <th class="b8">Gender</th>
                <th class="b8">Action</th>
            </tr>
            <tbody>
                <?php
                if($stmt2=$db->query("SELECT * from user1"))
                {
                    while($r=$stmt2->fetch_array(MYSQLI_ASSOC))
                    {
                ?>

                <tr>
                    <td class="size13 p-0"><?php echo $r['id']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['name']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['email']  ?></td>
                    <td class="size13 pl_0 pr_0 pb_0"><?php echo $r['gender']  ?></td>
                    <td>
                        <?php 
                        echo '<a href="Mysqli_practice2.php?view_id='.$r['id'].'" title="View Record" data-toggle="tooltip"><i class="fas fa-eye"></i></a> &nbsp &nbsp &nbsp';
                        echo '<a href="Mysqli_practice.php?update_id='.$r['id'].'" title="Update Record" data-toggle="tooltip"><i class="fas fa-pen-fancy"></i></a> &nbsp &nbsp &nbsp';
                        echo '<a href="Mysqli_practice2.php?delete_id='.$r['id'].'" title="Delete Record" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a> &nbsp &nbsp &nbsp';
                        
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



    <h1 class="b7 size25 mt_2">Example Of View</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
        </tr>
        <?php

        $db->query("CREATE DATABASE IF NOT EXISTS demo1"); // this query can be run with query() and execute() function

        $table_name="males";
        if(!check_table($table_name))
              $db->query("CREATE VIEW $table_name AS SELECT name, email, gender FROM user1 WHERE gender='male' ");
        else
            echo "Table already exisit";
        

        if($stmt3=$db->query("select * from males"))
        {
            while($row=$stmt3->fetch_array(MYSQLI_ASSOC))
            {
        ?>

        <tr>
            <td class="size13 pl_0 pr_0"><?php echo $row['name']  ?></td>
            <td class="size13 p-0"><?php echo $row['email']  ?></td>
            <td class="size13 p-0"><?php echo $row['gender']  ?></td>
        </tr>
        <?php  
            }
        } 
            
        $stmt3->free_result();// Free result set
        ?>
    </table>



    <h1 class="b7 size25 mt_2">Example Of Queries</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>Email</th>
            <th>Sex</th>
            <th>Services</th>
            <th>name_sex</th>
        </tr>
        <?php
        // // Where and LIKE Example
        // $query1="SELECT * FROM users WHERE sex='male' AND name LIKE '_h_%' "; //'_h_%' --> 2nd character of name should be "h", 1st and 3rd character could be anything.  
        // // AND, OR Operator Example
        // $query2="SELECT * FROM users WHERE (sex='male' OR service='html,') AND email LIKE '%.com' "; 
        // // ORDER BY
        // $query3="SELECT * FROM users  ORDER BY id DESC"; // by default is ascending(ASC)
        // //LIMIT Example
        // $query4="SELECT * FROM users LIMIT 4";
        // $query5="SELECT * FROM users LIMIT 4 OFFSET 2";// The SQL query below says "return only 4 records, start on record 2 (OFFSET 2)"
        // $query6="SELECT * FROM users LIMIT 2, 4";// You could also use a shorter syntax to achieve the same result:
        // IFNULL()
        // $query7="SELECT name, IFNULL(email,'anonymous@gmail.com') AS email FROM users";

        //Combined use of all above queries
        $query8="SELECT id AS CustomerID,name,email,sex,service,CONCAT(name,'-',sex) AS name_sex FROM users WHERE service='html,' AND email IS NOT NULL AND name LIKE '%ma%' ORDER BY id DESC LIMIT 8";


        if($stmt3=$db->query($query8))
        {
            while($r=$stmt3->fetch_array(MYSQLI_ASSOC))
            {
        ?>
        <tr>
            <td><?php echo $r['CustomerID']  ?></td>
            <td><?php echo $r['name']  ?></td>
            <td><?php echo $r['email']  ?></td>
            <td><?php echo $r['sex']  ?></td>
            <td><?php echo $r['service']  ?></td>
            <td><?php echo $r['name_sex']  ?></td>
        </tr>
        <?php  
            }
        }
        $stmt3->free_result();// Free result set

        // Perform queries and print out affected rows
        $db->query("SELECT * FROM user1");
        echo "Affected rows: " . $db->affected_rows;

        $db->close();// close connection in Mysqli
        ?>
    </table>
</body>

</html>