<?PHP
include 'connect_db.php';
$database=new database();
$db = $database->connect_pdo();

// print_r($_POST);

if($_POST['type']=='like'){
    $like_dislike=$_POST['like'];
    $post_id=$_POST['post_id'];
    $query="update posts set likes=:like_dislike where id=:id";
        // OR (in below query, we don't need to get  value of like or dislike through post)
    // $query="update posts set likes=:likes+1 where id=:id";
}
else if($_POST['type']=='dislike'){
    $like_dislike=$_POST['dislike'];
    $post_id=$_POST['post_id'];
    $query="update posts set dislikes=:like_dislike where id=:id";
    // OR (in below query, we don't need to get  value of like or dislike through post)
    // $query="update posts set dislikes=:dislikes+1 where id=:id";
}



$stmt=$db->prepare($query);

if($stmt){

    $stmt->bindParam(":like_dislike",$like_dislike);
    $stmt->bindParam(":id",$post_id);
    $stmt->execute();

    if($stmt->rowCount()>0){
        // $r=$stmt->fetch(PDO::FETCH_ASSOC);
        echo $like_dislike;
        // echo $r['like'];
    }else{
        echo 'fail';
    }
}


?>