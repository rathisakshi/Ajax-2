<?php include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $conn->select_db($dbname);
    $stmt = $conn->prepare("DELETE FROM Post WHERE id = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo 'Record deleted successfully';
    } else {
        echo 'Error deleting record: ' . mysqli_error($conn);
    }
}
?>