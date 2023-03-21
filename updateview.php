<?php include 'connection.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    
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
    
}
