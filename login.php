<?php
include 'connection.php';
$return_array = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username1 = $_POST['email'];

    $password1 = $_POST['password'];

    $query1 = "SELECT * FROM `Registrations`";
    $result = $conn->query($query1);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $db_email = $row['email'];
            $db_password = $row['password'];

            $db_array = array("username" => $db_email,
                "password" => $db_password);

            array_push($return_array, $db_array);
        }

        $len = count($return_array);

        for ($i = 0; $i < $len; $i++) {
            $username = $return_array[$i]['username'];
            $password = $return_array[$i]['password'];

            if ($username1 == $username && $password1 == $password) {
                $return_arr['success'] = true;
                echo json_encode($return_arr);
                exit;
            }
        }
    }

    $return_arr['success'] = false;
    $return_arr['message'] = "This is wrong ";
    echo json_encode($return_arr);
    exit;
}
