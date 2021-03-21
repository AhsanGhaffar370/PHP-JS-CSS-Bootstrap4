
<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
    <title>Our Blogs | Find Affordable Legal Help with us </title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png" />

    <meta name="description" content="Enjoy Fast Access To Top Family Lawyers Across The US. Connect Now With An Attorney In Your Local Area And Get Your Questions Answered Now.">


    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >


    <link  href="style.css" type="text/css" rel="stylesheet" media="screen">
    <link  href="style2.css" type="text/css" rel="stylesheet" media="screen">

    <link href='https://fonts.googleapis.com/css?family=Open Sans&display=swap' rel='stylesheet'>



</head>

<body class="fontb bg33">
    <?php
    include "header.php";
    ?>
    
    <div class="jumbotron jumbotron-fluid bg1 blog_bg border-0">
        <div class="paddings">
            <!-- <h1 class="size55 text-primary text-center b8 ">OUR BLOGS</h1> -->
        </div>
    </div>


    <section class="bg-transparent text-dark mt-5">
        <div class="container">
            <div class="row">

                <div class="col-xl-8 col-lg-8 col-md-8  col-sm-12 col-12  mb-3">

                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 card bg-white set_img card  mb-5 shadow-sm rounded-0 p-0">

                            <!-- <img src="/images/<?php //echo $post_image; ?>" class="img-fluid images" /> -->
                            <img src="images/WHEN DOES CHILD SUPPORT END IN TEXAS.png" class="img-fluid images" />

                            <div class="card-body p-5 text-dark">



                                <!--<p align="right">Posted by:&nbsp;&nbsp;<b>-->
                                <?php
                                //echo $post_author; 

                                ?>
                                <!--</b></p>-->

                                <p class="text-black-50 text-left font-weight-bold mb-2">
                                    <span class="text-primary">Published Date: Oct 03, 2020</span>
                                    <?php //echo date("M d, Y", strtotime($post_date)); ?>
                                </p>

                                <a href="/<?php //echo $post_url; ?>" class="blog_hov1 nav-link p-0">
                                    <h3 class="font_meri">
                                        <?php //echo $post_title; ?>
                                        Family Law Attorney, Dayton, Ohio
                                    </h3>
                                </a>

                                <?php
                                //// for ($i=0;$i<300;$i++){
                                ////     echo $post_content[$i];
                                //// }




                                // $post_content = strip_tags($post_content);
                                // $post_content = substr($post_content, 0, 240);
                                ?>
                                <p class="text-dark fontb text-left pt-2 ">
                                    <?php

                                    // // echo implode(' ', array_slice(explode(' ', $gg), 0, 90));
                                    // // echo $post_content;
                                    // echo "<p class='card-text text-secondary text-justify size16 decor' >$post_content...</p>";
                                    ?>
                                    Family Law Attorney, Dayton, Ohio Just like there are some legal requirements to get married, similarly, there are certain laws you need to follow for getting a divorce. The process of a divorce is not an easy one. You have to make sure ...
                                </p>

                                <a href="/<?php //echo $post_url; ?>" class="nav-link size14 font-weight-bold mt-2 p-0">
                                    Read More <i class="fas fa-angle-double-right fa-1x"></i>
                                </a>
                            </div>
                        </div>
                    <?php //} ?>
                    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                        <strong>Page <?php //echo $page_no . " of " . $total_no_of_pages; ?></strong>
                    </div>

                    <ul class="pagination">
                        <?php 
                        // if ($page_no > 1) {
                        //     echo "<li class='page-item'><a class='page-link' href='?page_no=1'>First</a></li>";
                        // } 
                        ?>

                        <li <?php 
                        // if ($page_no <= 1) {
                        //         echo "class='page-item disabled'";
                        //     } 
                            ?>>
                            <a <?php 
                            // if ($page_no > 1) {
                            //         echo "class='page-link' href='?page_no=$previous_page'";


                                ?>><<</a>

                        <?php
                                //}
                                // if ($total_no_of_pages <= 10) {
                                //     for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                //         if ($counter == $page_no) {
                                //             echo "<li class='active'><a class='page-link'>$counter</a></li>";
                                //         } else {
                                //             echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                //         }
                                //     }
                                // } elseif ($total_no_of_pages > 10) {
                                //     if ($page_no <= 4) {
                                //         for ($counter = 1; $counter < 8; $counter++) {
                                //             if ($counter == $page_no) {
                                //                 echo "<li class='active'><a class='page-link'>$counter</a></li>";
                                //             } else {
                                //                 echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                //             }
                                //         }
                                //         echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                //     } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                //         echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                //         for (
                                //             $counter = $page_no - $adjacents;
                                //             $counter <= $page_no + $adjacents;
                                //             $counter++
                                //         ) {
                                //             if ($counter == $page_no) {
                                //                 echo "<li class='active'><a class='page-link'>$counter</a></li>";
                                //             } else {
                                //                 echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                //             }
                                //         }
                                //         echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                //     } else {
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                //         echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                //         echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                //         for (
                                //             $counter = $total_no_of_pages - 6;
                                //             $counter <= $total_no_of_pages;
                                //             $counter++
                                //         ) {
                                //             if ($counter == $page_no) {
                                //                 echo "<li class='active'><a class='page-link'>$counter</a></li>";
                                //             } else {
                                //                 echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                //             }
                                //         }
                                //     }
                                // }
                        ?>

                        </li>

                        <li <?php 
                        // if ($page_no >= $total_no_of_pages) {
                        //         echo "class='page-item disabled'";
                        //     } 
                            ?>>
                            <a <?php 
                            // if ($page_no < $total_no_of_pages) {
                            //         echo "class='page-link' href='?page_no=$next_page'";
                                ?>>>></a>
                        </li>

                    <?php //}
                                // if ($page_no < $total_no_of_pages) {
                                //     echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last</a></li>";
                                // } 
                                ?>
                    </ul>
                </div>




                <div class="col-xl-4 col-lg-4 col-md-4 mb-5 col-sm-12 col-12">

                    <div id="searchbox" class="card sh_md rounded-0 mb-5">
                        <div class="card-body pt-4 pb-4">
                            <h6 class="font-weight-bold pl-1">Search Article</h6>

                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" class="form-control col-7  ml-3 rounded-0" name="searchingValue" placeholder="Search" size="25">
                                    <input type="submit" name="submitbtn" class="btn btn-danger col-3 size13 font-weight-bold  rounded-0" value="Search">
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card  bg-white set_img sh_md rounded-0 pb-5" style="display: table-cell;">
                        <div class="card-body text-dark">

                            <h6 class="font-weight-bold mb-5 mt-3">Recently Uploaded</h6>
                            <?php

                            // $query = "select * from posts order by 1 DESC LIMIT 0,5";

                            // $run = mysqli_query($con, $query);

                            // while ($row = mysqli_fetch_array($run)) {

                            //     $post_id = $row['post_id'];

                            //     $post_url = $row['post_url'];
                            //     $title = $row['post_title'];
                            //     $post_date = $row['post_date'];


                            //     $arr = explode('-', $post_date);
                            //     $post_date = $arr[2] . '-' . $arr[0] . '-' . $arr[1];

                            ?>
                                <div class="">
                                    <!-- <a href="/<?php //echo $post_url; ?>" class="col-5 d-block mr-0 pr-0">
                        <img src='images/<?php //echo $image; 
                                            ?>' width='100' height='100'></a> -->

                                    <a href="/<?php //echo $post_url; ?>" class="blog_hov1 d-block nav-link p-0 ">
                                        <h6 class="font-weight-bold m-0 size17">
                                        Family Law Attorney, Dayton, Ohio
                                            <?php //echo $title; ?>
                                        </h6>
                                    </a>

                                    <p class="size14 text-black-50 text-left font-weight-bold">
                                        <?php //echo date("M d, Y", strtotime($post_date)); ?>
                                        Oct 03, 2020
                                    </p>

                                </div>


                            <?php // } ?>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>




    <?php include("footer.php"); ?>





    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142213622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-142213622-3');
    </script>


    <script async src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script async src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



</body>

</html>