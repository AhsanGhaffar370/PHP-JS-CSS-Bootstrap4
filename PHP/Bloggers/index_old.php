<?php 


include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();


?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <meta name="description" content="Hello bloggers">



    <?php include("head_libs.php"); ?>


</head>

<body class="fontb bg33 ">







    <?php include "header.php"; ?>

    <div class="jumbotron jumbotron-fluid bg1 blog_bg border-0">
        <div class="container paddings text-left">
            <p class="size55 text-white text-left b7 m-0" style="line-height: 1.3;">Start Your Blogging Journey <span class="text-primary b8">Now</span></p>
            <button class="btn btn-primary text-white b8  pl-5 pr-5 pt-4 pb-4 mt-5 btn-lg text-center" style="border-radius: 38px;" onclick="window.location.href='signup.php'">Sign Up Now</button>
        </div>
    </div>


    <section class="bg-transparent text-dark mt-5 pr-3 pl-3">
        <div class="container p-0">
            <div class="row">

                <div class="col-xl-8 col-lg-8 col-md-8  col-sm-12 col-12 pt-4 mb-3">

                    <?PHP 

                    if(isset($_GET['sp'])){

                    $query='SELECT posts.id AS pid,user.id AS uid,posts.title,posts.permalink,user.username,user.avatar,posts.date,posts.content,posts.likes,posts.dislikes,posts.image,posts.author_id FROM posts inner join user on posts.author_id=user.id and posts.permalink=:permalink';
                    // $query='SELECT * FROM posts';
                    $stmt=$db->prepare($query);

                    if($stmt){
                        $stmt->bindParam(":permalink",$_GET['sp']);
                        $stmt->execute();

                        if($stmt->rowCount() > 0){

                            $r = $stmt->fetch(PDO::FETCH_ASSOC); 
                    ?>
                    <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 mb-5 rounded-0 p-0">
                        
                        <p class="" id="post_id" style="display: none;"><?PHP echo $r['pid'] ?></p>
                        <p class="text-black-50 text-left font-weight-bold mt-1 mb-3">
                            <!-- <span class="text-dark">Published Date: </span> -->
                            <span class="size15 b7">
                                <?php 
                                $arr = explode('-', $r['date']);
                                $post_date = $arr[2] . '-' . $arr[0] . '-' . $arr[1];
                                echo date("M d, Y", strtotime($post_date));
                                ?>
                            </span>
                        </p>

                        <p class="blog_hov1 nav-link p-0">
                            <h3 class="font_meri jl_heading">
                                <?php echo $r['title']; ?>
                            </h3>
                        </p>

                        <p class="text-black-50 text-left font-weight-bold mb-2 p-0">
                            <?PHP if($r['avatar']=="") {?>
                            <img src="admin/profile_images/law9.jpg" width=50 height=50 class="img-responsive rounded-circle" /> 
                            <?PHP }
                            else{
                            ?>
                            <img src="admin/profile_images/<?php echo $r['avatar']; ?>" width=50 height=50 class="img-responsive rounded-circle" /> 
                            
                            <?php
                            }
                            ?>
                            <a href="#" class="size17 b7 text-primary"><?php echo $r['username']; ?></a>
                        </p>

                        <img src="admin/post_images/<?php echo $r['image']; ?>" class="img-fluid images" />

                        <div class="pt-5 text-dark">

                            
                            <p class="text-dark fontb text-left pt-2 ">
                                <?php
                                $post_content = $r['content'];
                                // $post_content = strip_tags($r['content']);
                                // $post_content = substr($post_content, 0, 240);
                                echo $post_content;
                                ?>
                            </p>

                            <div class="text-center mt-4 border border-primary p-3 ">
                                <a href="#" id="like21" class="mr-4 ">
                                    <i class="fas fa-thumbs-up fa-2x mr-1"></i> 
                                    <h5 id="like_counter" class="d-inline text-primary"><?PHP echo $r['likes'] ?></h5>
                                </a>
                                <a href="#" id="dislike21" >
                                    <i class="fas fa-thumbs-down fa-2x mr-1"></i> 
                                    <h5 id="dislike_counter" class="d-inline text-primary"><?PHP echo $r['dislikes'] ?></h5>
                                </a>
                            </div>

                            <!-- <a href="index.php?sp=<?php //echo $r['permalink']; ?>"
                                class="nav-link size14 text-primary font-weight-bold mt-2 p-0">
                                Read More <i class="fas fa-angle-double-right fa-1x"></i>
                            </a> -->
                        </div>
                    </div>
                    <?PHP
                    }}}
                    
                    else{
                        

                    $query='SELECT posts.id AS pid,user.id AS uid,posts.title,posts.permalink,user.username,posts.date,posts.content,posts.image,posts.author_id FROM posts inner join user on posts.author_id=user.id';
                    // $query='SELECT * FROM posts';
                    $stmt=$db->prepare($query);

                    if($stmt){

                        $stmt->execute();

                        if($stmt->rowCount() > 0){

                            while($r= $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>

                    <div
                        class="col-xl-10 col-lg-10 col-md-10 col-sm-12 card bg-white mb-5 card shadow rounded-0 p-0">
                        

                        <img src="admin/post_images/<?php echo $r['image']; ?>" class="img-fluid images" />

                        <div class="card-body p-5 text-dark">

                            <p class="text-black-50 text-left font-weight-bold m-0 p-0">
                                <span class="text-dark">Author: </span>
                                <a href="#" class="size15 b7 text-primary"><?php echo $r['username']; ?></a>
                            </p>

                            <p class="text-black-50 text-left font-weight-bold mt-1 mb-3">
                                <span class="text-dark">Published Date: </span>
                                <span class="size15 b7">
                                    <?php 
                                    $arr = explode('-', $r['date']);
                                    $post_date = $arr[2] . '-' . $arr[0] . '-' . $arr[1];
                                    echo date("M d, Y", strtotime($post_date));
                                    ?>
                                </span>
                            </p>

                            <a href="/<?php //echo $post_url; ?>" class="blog_hov1 nav-link p-0">
                                <h3 class="font_meri">
                                    <?php echo $r['title']; ?>
                                </h3>
                            </a>

                            <p class="text-dark fontb text-left pt-2 ">
                                <?php
                                $post_content = strip_tags($r['content']);
                                $post_content = substr($post_content, 0, 240);
                                echo "<p class='card-text text-secondary text-justify size16 decor' >$post_content...</p>";
                                ?>
                            </p>

                            <a href="?sp=<?php echo $r['permalink']; ?>"
                                class="nav-link size14 text-primary font-weight-bold mt-2 p-0">
                                Read More <i class="fas fa-angle-double-right fa-1x"></i>
                            </a>
                        </div>
                    </div>

                    <?PHP            
                    }
                    }else
                        echo "Something went wrong1";
                    }else
                    echo "Something went wrong2";

                }
                    ?>

                </div>


                <div class="col-xl-4 col-lg-4 col-md-4 mb-5 col-sm-12 col-12">

                    <div class="pt-4" style="position:sticky; top:0;">
                        <div id="searchbox" class="card shadow rounded-0 mb-5">
                            <div class="card-body pt-4 pb-4">
                                <h6 class="font-weight-bold pl-1">Search Article</h6>

                                <form method="post" action="search_post.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="text" class="form-control col-7  ml-3 rounded-0" name="sertitle" placeholder="Search" size="25">
                                        <input type="submit" name="serbtn" class="btn btn-primary col-3 size13 font-weight-bold  rounded-0" value="Search">
                                    </div>
                                </form>
                            </div>
                        </div>

                        
                        <div class="card  bg-white set_img shadow rounded-0 " style="display: table-cell;">
                        <p class="size22 font-weight-bold text-white p-3 mt-0 bg-primary">Recently Uploaded</p>
                            <div class="card-body text-dark">

                                <?php
                            $query = "select * from posts order by 1 DESC LIMIT 0,5";
                            $stmt = $db->prepare($query);
                            if($stmt){
                                $stmt->execute();
                                if($stmt->rowCount()>0){
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                $post_id = $row['id'];
                                $post_url = $row['permalink'];
                                $title = $row['title'];
                                $image = $row['image'];
                                $post_date = $row['date'];


                                $arr = explode('-', $post_date);
                                $post_date = $arr[2] . '-' . $arr[0] . '-' . $arr[1];

                            ?>
                                <div class="">
                                    <!-- <a href="/<?php //echo $post_url; ?>" class="col-5 d-block mr-0 pr-0">
                                        <img src='admin/post_images/<?php //echo $image; ?>' width='100' height='100' />
                                    </a> -->

                                    <a href="?sp=<?php echo $post_url; ?>" class="blog_hov1 d-block nav-link p-0">
                                        <h6 class="font-weight-bold m-0 size18">
                                            <!-- Family Law Attorney, Dayton, Ohio -->
                                            <?php echo $title; ?>
                                            <p class="size14 text-black-50 text-left font-weight-bold pb-1">
                                                <?php echo date("M d, Y", strtotime($post_date)); ?>
                                            </p>
                                        </h6>
                                    </a>


                                    <hr>
                                </div>


                                <?php }}} ?>
                            
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>




    <?php include("footer.php"); ?>


    <?php include("footer_libs.php"); ?>


    <script>

        $(document).ready(function(){
            $("#like21").click(function(e){
                e.preventDefault();
                let like_val=parseInt($("#like_counter").text())+1;
                let post_id=$("#post_id").text();

                $.ajax({
                    url: 'like_dislike.php',
                    type: 'post',
                    data: "type=like"+"&like="+like_val+"&post_id="+post_id,
                    success:function(response){
                        if(response=="fail")
                            alert("sorry, we couldn't update. something went wrong");
                        else
                            $("#like_counter").text(response);
                    }
                })
            });

            $("#dislike21").click(function(e){
                e.preventDefault();
                let dislike_val=parseInt($("#dislike_counter").text())+1;
                let post_id=$("#post_id").text();

                $.ajax({
                    url: 'like_dislike.php',
                    type: 'post',
                    data: "type=dislike"+"&dislike="+dislike_val+"&post_id="+post_id,
                    success:function(response){
                        if(response=="fail")
                            alert("sorry, we couldn't update. something went wrong");
                        else
                            $("#dislike_counter").text(response);
                    }
                })
            });
        });

    </script>


</body>

</html>