<?php
include 'connect_db.php';
?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    $sex = $_POST['sex'];
    $date = trim(date("Y-m-d"));
    
    foreach($_POST['service'] as $i) {
        $service.=$i.', ';
    }
    
    $image = $_FILES['image']['name'];

    $fileext = pathinfo($image, PATHINFO_EXTENSION);
    if (!($fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'png' || $fileext == 'PNG')) {
        echo "Incorrect File Format";
    } 
    else {
        if ($stmt = $conn->prepare("insert into users set name=?,email=?,password=?,sex=?,profile=?,DoJ=?,service=?")) {
            $stmt->bind_param('sssssss', $name, $email, $password, $sex, $image, $date,$service);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                move_uploaded_file($_FILES['image']['tmp_name'],'user_pics/'.$image);
                echo "Insert succesfully";
            } else {
                echo "Not Insert";
            }
        }
    }
}
?>



<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <center>
        <h1>Registration Demo</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table>

                <tr>
                    <td><label>Name :</label></td>
                    <td><input type="text" name="name"></td>
                </tr>

                <tr>
                    <td><label>Email :</label></td>
                    <td><input type="email" name="email"></td>
                </tr>


                <tr>
                    <td> <label>Password :</label></td>
                    <td><input type="password" name="pass"></td>
                </tr>


                <tr>
                    <td> <label>Sex</label></td>
                    <td> <input type="radio" name="sex" value="male">Male</td>
                    <td><input type="radio" name="sex" value="female">Female </td>
                </tr>
                <tr>
                    <td> <label>Profile Pic</label></td>
                    <td> <input name="image" type="file"></td>

                </tr>
                <tr>
                    <td> <label>Service</label></td>
                    <td><input type="checkbox" name="service[]" value="html">html</td>
                    <td><input type="checkbox" name="service[]" value="php">php</td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit"></td>
                    <td><input type="reset" value="Reset"></td>
                </tr>
            </table>
        </form>
    </center>


    <table border="1">
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Sex</td>
            <td>Profile Pic</td>
            <td>Service</td>
            <td>Delete</td>
            <td>update</td>
        </tr>
        <?php
        if($stmt=$conn->query("select * from users"))
        {
            while($r=$stmt->fetch_array(MYSQLI_ASSOC))
            {
        ?>

        <tr>
            <td><?php echo $r['name']  ?></td>
            <td><?php echo $r['email']  ?></td>
            <td><?php echo $r['sex']  ?></td>
            <td><img src="user_pics/<?php echo $r['profile']  ?>" width="200" height="100"></td>
            <td><?php echo $r['service']  ?></td>
            <td><a href="">Delete</a></td>
            <td><a href="">update</a></td>
        </tr>
        <?php  
            }
        } ?>
    </table>
</body>

</html>