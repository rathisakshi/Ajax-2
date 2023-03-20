<?php
include 'connection.php';

// insert data into post table
$title = $_POST[ 'title' ];
$description = $_POST[ 'description' ];

//prepared statements
$stmt = $conn->prepare( 'INSERT INTO Post ( title, description) VALUES (?, ?)' );
// Bind the parameters and execute the statement
$stmt->bind_param( 'ss', $Title, $Description );
$stmt->execute();

// $sql = "INSERT INTO post (title, description) VALUES ('$title', '$description')";
// $conn->query( $sql );

// display posts in table
$sql = 'SELECT * FROM post ORDER BY id DESC';
$result = $conn->query( $sql );
if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $posts[] = $row;
    }
}

// output posts as JSON
header( 'Content-Type: application/json' );
echo json_encode( $posts );

$conn->close();
?>
