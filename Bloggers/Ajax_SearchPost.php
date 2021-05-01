<?PHP
include("connect_db.php");

$database=new database();
$db= $database->connect_pdo();

$return_arr = array();
// print_r($_POST['ser_val']);

$ser=$_POST['ser_val'];
$ser_v="%$ser%";

$q="select * from posts where title like :ser_val";

$stmt=$db->prepare($q);

if($stmt){
    $stmt->bindParam(":ser_val",$ser_v);
    $stmt->execute();

    if($stmt->rowCount()>0){

        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $permalink = $row['permalink'];
            $title = $row['title'];
            $image = $row['image'];
            $date = $row['date'];
            $content= strip_tags($row['content']);

            $return_arr[] = array("permalink" => $permalink, "title" => $title, "image" => $image, "date" => $date, "content" => $content);
        }
        echo json_encode($return_arr);
    }else{
        echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>No Record Found</div>';
    }
}

?>