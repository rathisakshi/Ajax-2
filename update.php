<?php
include 'connection.php';
$tbname='Post';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    


    $updatetitle = $_POST["Post_title"];
    $updatedes = $_POST["Post_description"];
    $id = $_POST["id"];
    $check = "SELECT `id` FROM $tbname";
    $result1 = mysqli_query($conn, $check);
    $num = $result1->num_rows;
    for ($i = 0; $i < $num; $i++) {
        $arr = mysqli_fetch_assoc($result1);
        if ($arr['id'] == $id) {
            if ($updatedes != null && $updatetitle != null) {
                $query = "UPDATE $tbname SET `Description`='$updatedes',Title='$updatetitle'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post Title and Description Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
            if ($updatedes != null) {
                $query = "UPDATE $tbname SET `Description`='$updatedes' WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post Description Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
            if ($updatetitle != null) {
                $query = "UPDATE $tbname SET Title='$updatetitle'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post Title Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
        }
    }

}

?>