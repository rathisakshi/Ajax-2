<?php include 'connection.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    $userid = $_POST[ 'userid' ];
    $Title = $_POST[ 'Title' ];
    $Description = $_POST[ 'Description' ];

    $sql = "CREATE TABLE IF NOT EXISTS Post (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Title VARCHAR(100) NOT NULL,
        Description VARCHAR(100) NOT NULL,
        userid VARCHAR(100) NOT NULL

    )";

    if ( $conn->query( $sql ) === TRUE ) {
        // echo 'Table posts created successfully';
    } else {
        echo 'Error creating table: ' . $conn->error;
    }
    //prepared statements
    $stmt = $conn->prepare( 'INSERT INTO Post (userid, Title, Description) VALUES (?, ?, ?)' );
    // Bind the parameters and execute the statement
    $stmt->bind_param( 'sss', $userid, $Title, $Description );
    $stmt->execute();

    if ( $conn->query( $sql ) === TRUE ) {
        // echo 'New record created successfully';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $sql_select = 'SELECT * FROM Post';
    $result = $conn->query( $sql_select );

    if ( $result->num_rows > 0 ) {
        while ( $row = $result->fetch_assoc() ) {

            $id = $row[ 'id' ];
            $userid = $row[ 'userid' ];
            $Title = $row[ 'Title' ];
            $Description = $row[ 'Description' ];

            $return_arr[] = array(
                'id' => $id,
                'userid'=>$userid,
                'Title' => $Title,
                'Description' => $Description
            );
        }
        echo json_encode( $return_arr );
    } else {
        echo '0 results';
    }
}
