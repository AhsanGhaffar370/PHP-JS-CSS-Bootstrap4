<?php include 'session_db.php'; ?>

<html lang="en-US">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Our Blogs | Find Affordable Legal Help with us </title>

    <?php include "header_libs.php";?>
    <style>
    </style>
    
    <script src="ckeditor/ckeditor.js"></script>

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


$page_head="ADD POST";

$id="";
$title = "";
$permalink = "";
$categories = "";
$date = "";
$image = "";
$tags = "";
// $status = "";
$content = "";
$author_id = "";
$update_flag=false;


//set content for update
if(isset($_GET['update_id']))
{
    $page_head="UPDATE POST";
    $update_flag=true;

    $id=$_GET['update_id'];

    $query1="select * from posts where id=:id";
    $stmt= $db->prepare($query1);

    if($stmt){
        $stmt->bindParam(':id',$id);

        $stmt->execute();

        if($stmt->rowCount() == 1){

            $row= $stmt->Fetch(PDO::FETCH_ASSOC);

            $title = $row["title"];
            $permalink = $row["permalink"];
            $categories = $row["categories"];
            $date = $row["date"];
            $image = $row["image"];
            $tags = $row["tags"];
            // $status = $row["status"];
            $content = $row["content"];
            $author_id = $row["author_id"];
        }
        else{
            echo "something went wrong";
        }

        unset($stmt);
    }
    else{
        echo "something went wrong2";
    }
}



//update post
if(isset($_POST['updatepost'])){

    $post_id=$_POST['post_id'];
    $title = $_POST["title"];
    $permalink = $_POST["permalink"];
    $permalink= str_replace(" ","-",$permalink);
    $permalink= strtolower($permalink);
    $categories = $_POST["category"];
    $date = $_POST["date"];
    $image = $_FILES["image"]['name'];
    $tags = $_POST["tags"];
    // $status = $row["status"];
    $content = $_POST["content"];
    // $author_id = $_POST["author_id"];


    // image insertion process
    $image = $_FILES['image']['name'];
    $fileext = pathinfo($image, PATHINFO_EXTENSION);

    if (!($fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'png' || $fileext == 'PNG')) {
        echo "Incorrect File Format";
    } 
    else {
        $query1 = "UPDATE posts SET title=:title, permalink=:permalink, categories=:category, date=:date, image=:image, tags=:tags, content=:content WHERE id=:id";  //MYSQLI
        $stmt1 = $db->prepare($query1);
        
        if ($stmt1) {
            //MYSQLI
            // $stmt1->bind_param('sssssssi', $name, $email, $password, $sex, $image, $date,$service, $id); 
            
            // PDO
            $stmt1->bindParam(':title',$title);
            $stmt1->bindParam(':permalink',$permalink);
            $stmt1->bindParam(':category',$category);
            $stmt1->bindParam(':date',$date);
            $stmt1->bindParam(':image',$image);
            $stmt1->bindParam(':tags',$tags);
            $stmt1->bindParam(':content',$content);
            $stmt1->bindParam(':id', $post_id); 

            $stmt1->execute();
            
            // if ($stmt1->affected_rows == 1)  //MYSQLI
            if ($stmt1->rowCount() == 1)  // PDO 
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'post_images/'.$image);

                echo "<script>alert('Post Update Successfully')</script>";
                header("location: view_posts.php");
            } else {
                echo "<script>alert('Post Update Successfully')</script>";;
            }

            // $stmt1->close(); // MYSQLI
            unset($stmt1); //PDO

            
        }else{
            //oops something went wrong
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

                <div class="container-fluid sh_md p-0 rounded">

                    <h1 class="bg-primary text-white text-center b8 p-3 rounded-top"><?php echo $page_head; ?></h1>

                    <div class="p-5">

                        <form id="form411" action="" method="POST" class="needs-validation form411" novalidate enctype="multipart/form-data">

                            <input type="hidden" name="post_id" value="<?php echo $id; ?>" /><!-- hidden id input -->

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">TITLE</label>
                                <input type="text" class="form-control rounded-0 p-4" id="title" name="title" value="<?php echo $title; ?>"
                                    placeholder="Post Title" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">PERMALINK</label>
                                <input type="text" class="form-control rounded-0 p-4" id="permalink" name="permalink" value="<?php echo $permalink; ?>"
                                    placeholder="Permalink" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">CATEGORY</label>
                                <select id="category" name="category" class="form-control rounded-0" required>
                                    <!-- <option value="-1" disabled selected>Select category</option> -->
                                    <option value="Uncategorized" <?PHP if($categories=='Uncategorized' ) echo "selected" ; ?>>Uncategorized</option>
                                    <option value="Technology" <?PHP if($categories=='Technology' ) echo "selected" ; ?> >Technology</option>
                                    <option value="Food" <?PHP if($categories=='Food' ) echo "selected" ; ?> >Food</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please select any option.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">PUBLISHED DATE</label>
                                <input type="date" class="form-control rounded-0 p-4" id="date" name="date" value="<?php echo $date; ?>"
                                    placeholder="Published Date" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">TAGS</label>
                                <input type="text" class="form-control rounded-0 p-4" id="tags" name="tags" value="<?php echo $tags; ?>"
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
                                value="post_images/<?php echo $image;  ?>" placeholder="image" required />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group">
                                <label class="size20 b7 pt-2 m-0">CONTENT</label>
                                <textarea name="content" class="ckeditor form-control rounded-0" id="content" rows="10" cols="80" required><?php echo $content; ?></textarea>
                                    
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="centre">
                            <?PHP if ($update_flag==true):?>
                                <input type="submit" name="updatepost" value="UPDATE POST" class="button btn_xxs btn-info d_in b7" />
                            <?PHP else:?>
                                <input type="submit" name="addpost" value="ADD POST" class="button btn_sm d_in b7" />
                            <?PHP endif; ?>
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
