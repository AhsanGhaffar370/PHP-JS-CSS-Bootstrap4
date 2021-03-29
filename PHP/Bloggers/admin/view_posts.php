<?php include 'session_db.php'; ?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <?php include "header_libs.php";?>
    <style>
    .rem_b:hover{
        color: white !important;
    }

    .id_col{ width: 5%;}
    .title_col{ width: 30%;}
    .author_col{ width: 10%;}
    .cat_col{ width: 10%;}
    .date_col{ width: 10%;}
    .img_col{ width: 10%;}
    .tag_col{ width: 15%;}
    .act_col{ width: 10%;}

    </style>

</head>

<body class="fontb bg33">


    <?PHP
// delete record
if(isset($_GET['delete_id'])){

    $id=$_GET['delete_id'];


    //remove image from directory
    $query1="select image from posts where id=:id"; //PDO
    
    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        $stmt1->bindParam(':id', $id); //PDO
        $stmt1->execute(); 

        if($stmt1->rowCount() == 1) //PDO
        {
            $row = $stmt1->fetch(PDO::FETCH_ASSOC); //PDO
            $image = $row["image"];

            if (file_exists("post_images/$image")) //check whether an image is exist or not
                unlink("post_images/$image"); // this function will remove image from directory
        } else
            echo "Something went wrong";
        
        unset($stmt1); //PDO
    }else
        echo "Something went wrong";
    

    //remove record from database
    $query1="delete from posts where id=:id"; //PDO
    
    $stmt1 = $db->prepare($query1);
    
    if ($stmt1) {
        $stmt1->bindParam(':id', $id); //PDO
        $stmt1->execute(); 

        unset($stmt1); //PDO

        echo "<script>alert('Post Delete Successfully')</script>";
        // header("location: view_posts.php");

    }else{
        //oops something went wrong
    }
}


?>





    <div class="wrapper d-flex align-items-stretch">

        <?php include "sidebar_menu.php";?>

        <!-- Page Content  -->
        <div class="content-sec">

            <?php include "header.php";?>

            <div id="content" class="p-4 p-md-5 pt-5">

                <!-- View Data List -->
                <div class="container-fluid table-responsive">
                    <table class="table bg-white shadow-sm">
                        <tr class="thead-dark">
                            <!-- <th class="b8">#</th> -->
                            <th class="size15 b6 id_col pt-4 pb-4">ID</th>
                            <th class="size15 b6 title_col pt-4 pb-4">Post Title</th>
                            <th class="size15 b6 author_col pt-4 pb-4">Author Name</th>
                            <th class="size15 b6 cat_col pt-4 pb-4">Categories</th>
                            <th class="size15 b6 date_col pt-4 pb-4">Published Date</th>
                            <th class="size15 b6 img_col pt-4 pb-4">Post Image</th>
                            <th class="size15 b6 tag_col pt-4 pb-4">Tags</th>
                            <th class="size15 b6 act_col pt-4 pb-4">Action</th>
                        </tr>
                        <tbody>
                            <?php
                // select *, count(*) from users having count(*)>1
                // select * from users qualify count(*) over (partition by email rows unbounded preceding) = 1
                // select id,name,sex,profile,service, count(email) e from users group by email having e = 1
                // SELECT id,name,email,sex,profile,service FROM users GROUP BY email HAVING COUNT(email) = 1
                // SELECT * FROM users WHERE EXISTS (SELECT DISTINCT email);

                // $query='SELECT * FROM posts where author_id=:author_id';
                // $query2='SELECT news.id AS newsId, user.id AS userId FROM posts JOIN user ON posts.user = user.id';
                $query='SELECT posts.id AS post_id,user.id AS user_id,posts.title,user.username,posts.categories,posts.date,posts.image,posts.tags,posts.author_id FROM posts inner join user on posts.author_id=user.id and posts.author_id=:author_id';
                $stmt2=$db->prepare($query);

                if($stmt2)
                {
                    $stmt2->bindParam(':author_id',$_SESSION['id']);
                    $stmt2->execute();

                    //if($stmt2->num_rows > 0) // Mysqli
                    if($stmt2->rowCount() > 0) // PDO
                    {
                        //while($r=$stmt2->fetch_array(MYSQLI_ASSOC)) // MYSQLI
                        while($r=$stmt2->fetch(PDO::FETCH_ASSOC)) //PDO
                        {
                        ?>
                            <tr>
                                <td class="size13 text-center"><?php echo $r['post_id']  ?></td>
                                <td class="size13 text-left"><?php echo $r['title']  ?></td>
                                <td class="size13 p-0"><?php echo $r['username']  ?></td>
                                <td class="size13 text-left"><?php echo $r['categories']  ?></td>
                                <td class="size13 text-left"><?php echo $r['date']  ?></td>
                                <td class="size13 text-center"><img src="post_images/<?php echo $r['image']  ?>"
                                        class="img-responsive" width="100" height="70"></td>
                                <?PHP // if fatch type is (PDO::FETCH_OBJ) then we have to access values, something like this $r->name ?>
                                <td class="size13 text-left"><?php echo $r['tags']  ?></td>
                                <!-- <td class="size13 text-left"><?php //echo $r['status']  ?></td> -->
                                <td>
                                    <?php 
                            echo '<a href="add_post.php?update_id='.$r['post_id'].'"" class="btn btn-warning btn-block cl_w rem_b">Update</a>';
                            echo '<a href="view_posts.php?delete_id='.$r['post_id'].'" class="btn btn-danger btn-block cl_w rem_b">Delete</a>';
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


            </div>
        </div>
    </div>


    <?php //include("../footer.php"); ?>




    <?php include("footer_libs.php"); ?>



</body>

</html>