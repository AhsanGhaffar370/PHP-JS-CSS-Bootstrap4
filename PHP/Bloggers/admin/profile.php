<?php include 'session_db.php'; ?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <?php include "header_libs.php";?>
    <style>
    
    #countrydataPar
    {
        position: absolute !important;
        width: 100%;
    }
    #countrydata li:hover
    {
        background-color: #dbe9ff;
    }

    
    .table_col{ 
        width: 40%;
        margin: auto;
        }
        
    .name_col{ width: 30%;}
    .name2_col{ width: 20%;}

    </style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>


<body class="fontb bg33">




    <?php
$update_flag=false;
if(isset($_GET['update_id'])){
    $update_flag=true;
}
    // $id=$_SESSION['id'];
    // $query1="select * from user where id=:id"; //PDO

    // $stmt1 = $db->prepare($query1);
    // if ($stmt1) {
    //     $stmt1->bindParam(':id', $id); // PDO
    //     $stmt1->execute(); 
    //     if($stmt1->rowCount() == 1) // PDO
    //     { 
    //         $row = $stmt1->fetch(PDO::FETCH_ASSOC); // PDO

    //         $id = $row["id"];
    //         $username = $row["username"];
    //         $email = $row["email"];
    //         $avatar = $row["avatar"];
    //         $niche = $row["niche"];
    //         $country = $row["country"];
    //         echo $avatar;
    //         echo $_SESSION["avatar"] ;
    //     } else{
    //         exit();
    //     }
    //     unset($stmt1); // PDO
    // }else{
    //     //oops something went wrong
    // }
// }



//update record
if(isset($_POST['update'])){

    // $id=$_GET['update_id'];
    $id2=$_POST['id'];

    $username2 = $_POST["username"];
    $niche2 = $_POST["niche"];
    $email2 = $_POST["email"];
    $country2 = $_POST["country"];
    $avatar2 = $_FILES['image']['name'];
    $avatar_ext=pathinfo($avatar2,PATHINFO_EXTENSION);

    // $avatar2=pathinfo($avatar2,PATHINFO_FILENAME);
    // $avatar=$avatar;




    if (!($avatar_ext == 'jpg' || $avatar_ext == 'jpeg' || $avatar_ext == 'png' || $avatar_ext == 'PNG')) {
        echo "Incorrect File Format";
    } 
    else {

    // Insert Query
    $query2 = "UPDATE user set username=:username,avatar=:avatar,niche=:niche,email=:email,country=:country where id=:id";  //MYSQLI
    $stmt2 = $db->prepare($query2);
    
    if ($stmt2) {
        // PDO
        $stmt2->bindParam(':username', $username2); 
        $stmt2->bindParam(':avatar', $avatar2); 
        $stmt2->bindParam(':niche', $niche2); 
        $stmt2->bindParam(':email', $email2); 
        $stmt2->bindParam(':country', $country2); 
        $stmt2->bindParam(':id', $id2); 

        $stmt2->execute();

        if ($stmt2->rowCount() == 1)  // PDO 
        {
            move_uploaded_file($_FILES['image']['tmp_name'],'profile_images/'.$avatar2);
            // echo "Insert succesfully";
        } else {
            echo "Not Insert";
        }

        unset($stmt2); //PDO

        $update_flag=false;

        $_SESSION["username"] = $_POST["username"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["niche"] = $_POST["niche"];
        $_SESSION["country"] = $_POST["country"];
        $_SESSION["avatar"] = $_FILES['image']['name'];

    }else{
        // header("location: dashboard.php");
        echo "something went wrong";
    }
}
    
}


?>


    <div class="wrapper d-flex align-items-stretch">

        <?php include "sidebar_menu.php";?>

        <!-- Page Content  -->
        <div class="content-sec">

            <?php include "header.php";?>

            <div id="content" class="p-4 p-md-5 pt-5">


                <div class="container sh_md p-0 rounded">

                    <h1 class="bg-primary text-white text-center b8 p-3 rounded-top">UPDATE PROFILE</h1>


                    <div class="p-5 text-center">

                        <?PHP if ($update_flag==false) {?>
                        <!-- <p class="size20 text-dark b7">Profile Pic:</p>  -->
                        <?PHP
                        if(strlen($_SESSION['avatar'])==0)
                        {
                        ?>
                        <img src="profile_images/law9.jpg" class="img-responsive mb-3" width="200" height="200"
                            alt="demo" style="border-radius: 6.25rem!important;">
                            
                        <?PHP }
                            else{
                        ?>

                        <img src="profile_images/<?PHP echo $_SESSION['avatar'] ?>" class="img-responsive mb-3" width="200" height="200"
                            alt="<?PHP echo $_SESSION['avatar'] ?>" style="border-radius: 6.25rem!important;">
                            
                        <?PHP } ?>

                        <table  class="table table_col table-borderless">
                            <tr>
                                <td class="text-left size18 b7 name_col">User Name:</td>
                                <td class="text-left size17 name2_col"><?PHP echo $_SESSION['username'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-left size18 b7">Email:</td>
                                <td class="text-left size17 "><?PHP echo $_SESSION['email'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-left size18 b7">Niche:</td>
                                <td class="text-left size17 "><?PHP echo $_SESSION['niche'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-left size18 b7">Country:</td>
                                <td class="text-left size17 "><?PHP echo $_SESSION['country'] ?></td>
                            </tr>
                        </table>

                        <input type="button" value="Update" class="btn btn-primary btn-lg" onclick="window.location.href='profile.php?update_id=<?PHP echo $_SESSION['id'] ?>'" />
                        <?PHP
                }
                else {
                ?>
                        <!-- Form Starts -->
                        <form id="form1" method="POST" action=profile.php enctype="multipart/form-data">
                            <!--enctype="multipart/form-data" is used with post method -->

                            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
                            <!-- hidden id input -->

                            <div class="form-group">
                                <label class="b7 size14">Profile Pic:<br /></label>
                                <br />
                                <img src="profile_images/<?PHP echo $_SESSION['avatar'] ?>" id="image" name="image"
                                    class="img-responsive" width="200" height="200" alt="<?PHP echo $_SESSION['avatar'] ?>"
                                    srcset="" style="border-radius: 6.25rem!important;">
                                <br /><br />
                                <!-- <input type="file" class="form-control p-2" id="image" name="image" /> -->
                                <input type="file" class="form-control p-2" id="image1" name="image"
                                    value="profile_images/<?php echo $_SESSION['avatar']  ?>" placeholder="image" required />
                            </div>

                            <div class="form-group">
                                <label class="b7 size14" for="username1">Name:</label>
                                <input type="text" class="form-control p-2" id="username" name="username"
                                    value="<?php echo $_SESSION['username']; ?>" placeholder="Full Name" required />
                            </div>

                            <div class="form-group">
                                <label class="b7 size14" for="email1">Email:</label>
                                <input type="email" class="form-control p-2" id="email1" name="email"
                                    value="<?php echo $_SESSION['email']; ?>" placeholder="Email" required />
                            </div>

                            <!-- <div class="form-group">
                                <label class="b7 size14" for="niche1">Niche:</label>
                                <input type="text" class="form-control p-2" id="niche1" name="niche"
                                    value="<?php //echo $_SESSION['niche']; ?>" placeholder="Niche" required />
                            </div> -->

                            <div class="form-group">
                                <label class="b7 size14" for="niche1">Niche:</label>
                                <select class="form-control" id="niche1"  name="niche" required >
                                    <option value="-1" disabled >Select Niche</option>
                                    <option value="Food" <?php if($_SESSION['niche']=="Food") {echo "selected";} ?> >Food</option>
                                    <option value="Technology" <?php if($_SESSION['niche']=="Technology") {echo "selected";}  ?> >Technology</option>
                                    <option value="Fashion" <?php  if($_SESSION['niche']=="Fashion") {echo "selected";} ?>>Fashion</option>
                                    <option value="Programming" <?php  if($_SESSION['niche']=="Programming") {echo "selected";} ?>>Programming</option>
                                    <option value="Digital Marketing"> <?php  if($_SESSION['niche']=="Digital Marketing") {echo "selected";} ?>Digital Marketing</option>
                                    <option value="News" <?php  if($_SESSION['niche']=="News") {echo "selected";} ?>>News</option>
                                    <option value="Sports" <?php  if($_SESSION['niche']=="Sports") {echo "selected";} ?>>Sports</option>
                                    <option value="Movies" <?php  if($_SESSION['niche']=="Movies") {echo "selected";} ?>>Movies</option>
                                </select>
                            </div>

                            

                            <div class="form-group d-block col-12 p-0">
                                <label class="b7 size14" for="country21">Country:</label>
                                <input type="text" class="form-control rounded-0 p-2" id="country21" name="country"
                                    value="<?php echo $_SESSION['country']; ?>" placeholder="Country" required />
                                    <div id="countrydataPar">
                                        <ul class="text-left size13 list-group rounded-0 p-0 d-block" id='countrydata'></ul>
                                    </div>
                            </div>

                            <div class="tc">
                                <input type="submit" name="update" value="Update Profile" class="btn btn-primary" />
                            </div>
                        </form>
                        <!-- End of form -->

                        <?PHP } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php //include("../footer.php"); ?>

    <?php include("footer_libs.php"); ?>

<script>

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    function itemDone(e) {
        var target = e.target;
        // alert(target.childNode.value);
        e.preventDefault();
        document.getElementById("country21").value = target.innerHTML;
        document.getElementById("countrydata").innerHTML="";
    }
    document.getElementById("countrydata").addEventListener('click', function(e) {itemDone(e);}, false);

    function showUser(e) {
        let str=e.target.value;
        if (str == "") {
            document.getElementById("countrydata").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("countrydata").innerHTML = this.responseText;
            }

            };
            xmlhttp.open("GET","searchCountry.php?q="+str,true);
            xmlhttp.send();
        } 
    }
    document.getElementById('country21').addEventListener('keyup',function(e){showUser(e)},false);
</script>



</body>

</html>
