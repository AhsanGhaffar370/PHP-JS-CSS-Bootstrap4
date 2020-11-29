<?php


session_start();

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


//save reocrd
if (isset($_POST['save'])) {
    if(!check_email($_POST['email'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        
        //1st way 
        // $query1="insert into user1 set name=:name1 ,email=:email1 ,gender=:gender1";
        // $stmt1->bindParam(':name1', $name);
        // $stmt1->bindParam(':email1', $email);
        // $stmt1->bindParam(':gender1', $gender);
        
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


            $_SESSION['message']= "Record added successfully";
            $_SESSION['msg_type']= "Success";

            header("location: Mysqli_practice.php");
        }
    }else{
        $_SESSION['email_err']="This email already exist";

        header("location: Mysqli_practice.php");
    }
}



//delete reocrd
if(isset($_GET['delete_id'])){

    $id=$_GET['delete_id'];

    $query1="delete from user1 where id=?";
    
        $stmt1 = $db->prepare($query1);
        
        if ($stmt1) {
            //  s= string, i= integer, d= double, b= BLOB
            $stmt1->bind_param('i', $id);
            
            $stmt1->execute(); //Returns TRUE on success or FALSE on failure.
    
            $stmt1->close(); // close connection (free the variable using close )

            $_SESSION['message']= "Record deleted successfully";
            $_SESSION['msg_type']= "danger";

            header("location: Mysqli_practice.php");
        }
}


//update reocrd
if(isset($_POST['update'])){

    $id=$_POST['id'];

    $name = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];

    // Prepare an update statement
    $query1 = "UPDATE user1 SET name=?, email=?, gender=? WHERE id=?";
    
        $stmt1 = $db->prepare($query1);
        
        if ($stmt1) {
            //  s= string, i= integer, d= double, b= BLOB
            $stmt1->bind_param("sssi", $name, $email, $gender, $id);

            $stmt1->execute(); //Returns TRUE on success or FALSE on failure.
    
            $stmt1->close(); // close connection (free the variable using close )

            $_SESSION['message']= "Record updated successfully";
            $_SESSION['msg_type']= "info";

            header("location: Mysqli_practice.php");
        }
}



?>