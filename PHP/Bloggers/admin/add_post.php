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

<?PHP 
if(isset($_POST['addpost'])){
    $title= $_POST['title'];
    $permalink= $_POST['permalink'];
    $permalink= str_replace(" ","-",$permalink);
    $permalink= strtolower($permalink);
    $category= $_POST['category'];
    $date= $_POST['date'];
    $tags= $_POST['tags'];
    $image= $_FILES['image']['name'];
    $content= $_POST['content'];
    $author_id= $_SESSION['id'];

    $image_ext=pathinfo($image,PATHINFO_EXTENSION);

    if (!($image_ext == 'jpg' || $image_ext == 'jpeg' || $image_ext == 'png' || $image_ext == 'PNG')) {
        echo "<script>alert('Incorrect Image Format')</script>";
    } 
    else {
        $query='insert into posts set title=:title, permalink=:permalink, categories=:category, date=:date, image=:image, tags=:tags, content=:content, author_id=:author_id';
        $stmt= $db->prepare($query);

        if($stmt){
            $stmt->bindParam(':title',$title);
            $stmt->bindParam(':permalink',$permalink);
            $stmt->bindParam(':category',$category);
            $stmt->bindParam(':date',$date);
            $stmt->bindParam(':tags',$tags);
            $stmt->bindParam(':image',$image);
            $stmt->bindParam(':content',$content);
            $stmt->bindParam(':author_id',$author_id);

            $stmt->execute();

            if ($stmt->rowCount() == 1)  // PDO 
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'post_images/'.$image);
                echo "<script>alert('Post Inserted Successfully')</script>";
                header("location: view_posts.php");

            } else {
                echo "<script>alert('Image not inserted in database')</script>";
            }
            unset($stmt); //PDO
        }else{
            echo "<script>alert('query not prepared')</script>";
        }
    }
}


if(isset($_GET['update_id']))
{
    
}

?>

    <div class="wrapper d-flex align-items-stretch">

        <?php include "sidebar_menu.php";?>

        <!-- Page Content  -->
        <div class="content-sec">

            <?php include "header.php";?>

            <div id="content" class="p-4 p-md-5 pt-5">

                <div class="container-fluid sh_md p-0 rounded">

                    <h1 class="bg-primary text-white text-center b8 p-3 rounded-top">Add POST</h1>

                    <div class="p-5">

                        <form id="form41" action="" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">TITLE</label>
                                <input type="text" class="form-control rounded-0 p-4" id="title" name="title"
                                    placeholder="Post Title" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">PERMALINK</label>
                                <input type="text" class="form-control rounded-0 p-4" id="permalink" name="permalink"
                                    placeholder="Permalink" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">CATEGORY</label>
                                <select id="category" name="category" class="form-control rounded-0" required>
                                    <!-- <option value="-1" disabled selected>Select category</option> -->
                                    <option value="Uncategorized" selected>Uncategorized</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Food">Food</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please select any option.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">PUBLISHED DATE</label>
                                <input type="date" class="form-control rounded-0 p-4" id="date" name="date"
                                    placeholder="Published Date" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">TAGS</label>
                                <input type="text" class="form-control rounded-0 p-4" id="tags" name="tags"
                                    placeholder="Tags" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">STATUS</label>
                                <select id="status" name="status" class="form-control rounded-0" required>
                                    <option value="-1" disabled selected>Status</option>
                                    <option value="Published">Published</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Pending Review">Pending Review</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please select any option.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">VISIBILITY</label>
                                <select id="visibility" name="visibility" class="form-control rounded-0" required>
                                    <option value="-1" disabled selected>visibility</option>
                                    <option value="Public">Public</option>
                                    <option value="PRivate">PRivate</option>
                                    <option value="Password Protected">Password Protected</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please select any option.</div>
                            </div> -->

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">POST IMAGE</label>
                                <input type="file" class="form-control rounded-0 p-4" id="image" name="image"
                                    value="post_images/" placeholder="image" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">CONTENT</label>
                                <textarea name="content" class="form-control rounded-0" id="content" cols="20" rows="10"
                                    placeholder="Write Your Content Here" required></textarea>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="centre">
                                <input type="submit" name="addpost" value="ADD POST" class="button btn_sm d_in b7" />
                            </div>
                        </form>
                        <!-- End of form -->

                    </div>


                </div>


            </div>
        </div>
    </div>

    <?php //include("../footer.php"); ?>

    <?php include("footer_libs.php"); ?>



</body>

</html>