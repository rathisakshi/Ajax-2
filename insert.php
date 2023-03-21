<?php include 'connection.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    $userid = $_POST[ 'userid' ];
    if ( !( preg_match( '/^[0-9]{1,30}$/', $userid ) ) ) {
        $result_arr[] = array( 'message'=>'Invalid User id' );
        echo json_encode( $result_arr );
        exit;
    }
    $Title = $_POST[ 'Title' ];
    if ( strlen($Title)>40) {
        $result_arr[] = array( 'message'=>'Length allowed: 40 characters' );
        echo json_encode( $result_arr );
        exit;
    }

    $Description = $_POST[ 'Description' ];
    if ( strlen($Description)>150) {
        $result_arr[] = array( 'message'=>'Length allowed: 150 characters' );
        echo json_encode( $result_arr );
        exit;
    }
    $sql = "CREATE TABLE IF NOT EXISTS Post (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Title VARCHAR(40) NOT NULL,
        Description VARCHAR(200) NOT NULL,
        userid INT(100) NOT NULL

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
    }

    // else {
    //     echo '0 results';
    // }
}
