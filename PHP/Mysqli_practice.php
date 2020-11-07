<?php
include 'connect_db.php';
$database=new database();
$db = $database->connect_mysqli();


// This function will prevent data from SQL injections
function test_input($data) {
    GLOBAL $db;
    // trim() method strip unnecessary characters (extra space, tab, newline) from the user input data
    $data = trim($data); 
    // strip_tags() function strips a string from HTML, XML, and PHP tags.
    $data = strip_tags($data); 
    // strplashes() method remove backslashes (\) from the user input data
    $data = stripslashes($data); 
    /* The htmlspecialchars() function converts special characters to HTML entities. It replaces HTML characters like 
    < and > with &lt; and &gt;. It prevents attackers from  exploiting the code by injecting HTML or JS code in forms.*/
    $data = htmlspecialchars($data);
    // This function prepends backslashes to the following characters: \x00, \n, \r, \, ', ". 
    // This function is normally used to make data safe before sending a query to MySQL
    $data = $db->real_escape_string($data);

    return $data;
}


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

//function to check whether a email address is already exisit or not
function check_email($email){
    GLOBAL $db;
    $flag=FALSE;
    
    $query = "SELECT email from user1";
    $result= $db->query($query);
    
    if($result !== false){
        if($result->num_rows > 0) {
            while($data= $result->fetch_array(MYSQLI_ASSOC)){
                // echo $data['email'],"<br>";
                if($data['email'] == $email)
                $flag= TRUE;  
            }
        }
        else 
            echo 'No record found';

        $result->free_result();// Free result set
    }
    else 
        echo "Unable to check the email: $email, error - ". $db->error;
    
    return $flag;
}

?>

<?php

$email_err="";

if (isset($_POST['save'])) {
    if(!check_email($_POST['email'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
     
        // First Way
        // $query1= "insert into user1 (name, email, gen) values (:name, :em, :gen)"
        // $stmt = $db->prepare($query1);
        // $stmt->bindParam(':nam', $name);
        // $stmt->bindParam(':em', $email);
        // $stmt->bindParam(':gen', $gender);
        // $stmt->execute();
        // $stmt1->close();
        
        // Second Way
        $query1="insert into user1 set name=?,email=?,gender=?";
    
        //It’ll helpful for a statement that you need to issue multiple times, prepare a  Statement 
        // with $db->prepare() and issue the statement with $db->execute().
        $stmt1 = $db->prepare($query1);
        
        if ($stmt1) {
            //  s= string, i= integer, d= double, b= BLOB
            $stmt1->bind_param('sss', $name, $email, $gender);
            $stmt1->execute(); //Returns TRUE on success or FALSE on failure.
    
            $stmt1->close(); // close connection (free the variable using close )
        }
    }else{
        $email_err="This email already exist";
        // echo '';
    }
}



?>


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
            <div class="size13 alert alert-danger verCen">
                <?PHP echo $email_err ?>
            </div>

            <!-- Form Starts -->
            <form id="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="needs-validation1">

                <div class="form-group">
                    <input type="text" class="form-control p-2" id="name1" name="name" placeholder="Full Name" />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control p-2" id="email1" name="email" placeholder="Email" />
                </div>
                <div class="form-group">
                    <label class="b8">Gender:</label>&nbsp
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" id="male1" name="gender" value="male" />
                        <label class="form-check-label" for="male1"> Male </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" id="female1" name="gender" value="female" />
                        <label class="form-check-label" for="female1"> Female </label>
                    </div>
                    <br>
                </div>
                <div class="tc">
                    <input type="reset" name="reset" value="Reset" class="button btn_xxs d_in b7" />
                    <input type="submit" name="save" value="Save" class="button btn_xxs d_in b7" />

                </div>
            </form>
            <!-- End of form -->
        </div>
    </section>

    <!-- View Data List -->
    <div class="container table-responsive">
        <table class="table table-light table-striped table-hover table-bordered">
            <tr class="thead-dark">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Action</th>
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
                        echo '<a href="Mysqli_practice_view.php?id='.$r['id'].'" title="View Record" data-toggle="tooltip"><i class="fas fa-eye"></i></a> &nbsp &nbsp &nbsp';
                        echo '<a href="Mysqli_practice_update.php?id='.$r['id'].'" title="Update Record" data-toggle="tooltip"><i class="fas fa-pen-fancy"></i></a> &nbsp &nbsp &nbsp';
                        echo '<a href="Mysqli_practice_delete.php?id='.$r['id'].'" title="Delete Record" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a> &nbsp &nbsp &nbsp';
                        
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