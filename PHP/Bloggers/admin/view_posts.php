<?php include 'session_db.php'; ?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <?php include "header_libs.php";?>
    <style>


    </style>

</head>

<body class="fontb bg33">


    <div class="wrapper d-flex align-items-stretch">

        <?php include "sidebar_menu.php";?>

        <!-- Page Content  -->
        <div class="content-sec">

            <?php include "header.php";?>

            <div id="content" class="p-4 p-md-5 pt-5">


                <!-- View Data List -->
                <div class="container-fluid table-responsive">
                    <table class="table table-light table-striped table-bordered">
                        <tr class="thead-dark">
                            <!-- <th class="b8">#</th> -->
                            <th class="size16 b7">Post Title</th>
                            <th class="size16 b7">Author Name</th>
                            <th class="size16 b7">Categories</th>
                            <th class="size16 b7">Published Date</th>
                            <th class="size16 b7">Post Image</th>
                            <th class="size16 b7">Tags</th>
                            <th class="size16 b7">Action</th>
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
                    $stmt2->bindParam('author_id',$_SESSION['id']);
                    $stmt2->execute();

                    //if($stmt2->num_rows > 0) // Mysqli
                    if($stmt2->rowCount() > 0) // PDO
                    {
                        //while($r=$stmt2->fetch_array(MYSQLI_ASSOC)) // MYSQLI
                        while($r=$stmt2->fetch(PDO::FETCH_ASSOC)) //PDO
                        {
                        ?>
                            <tr>
                                <td class="size13 text-left"><?php echo $r['title']  ?></td>
                                <td class="size13 p-0"><?php echo $r['username']  ?></td>
                                <td class="size13 text-left"><?php echo $r['categories']  ?></td>
                                <td class="size13 text-left"><?php echo $r['date']  ?></td>
                                <td class="size13 text-left"><img src="post_images/<?php echo $r['image']  ?>" class="img-responsive" width="100" height="70"></td>
                                <?PHP // if fatch type is (PDO::FETCH_OBJ) then we have to access values, something like this $r->name ?>
                                <td class="size13 text-left"><?php echo $r['tags']  ?></td>
                                <!-- <td class="size13 text-left"><?php //echo $r['status']  ?></td> -->
                                <td>
                                    <?php 
                            echo '<a href="add_post.php?update_id='.$r['post_id'].'" class="btn btn-warning d-inline cl_w">Update</a> &nbsp &nbsp &nbsp ';
                            echo '<a href="dashboard.php?delete_id='.$r['post_id'].'" class="btn btn-danger d-inline cl_w">Delete</a> &nbsp &nbsp &nbsp';
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