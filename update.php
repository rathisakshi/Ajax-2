<?php
include 'connection.php';
$tbname = 'Post';
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    $updatetitle = $_POST[ 'Post_title' ];
    if ( strlen( $updatetitle )>40 ) {
        $result_arr[] = array( 'message'=>'Length allowed: 40 characters' );
        echo json_encode( $result_arr );
        exit;
    }
    $updatedes = $_POST[ 'Post_description' ];
    if ( strlen( $updatedes )>150 ) {
        $result_arr[] = array( 'message'=>'Length allowed: 150 characters' );
        echo json_encode( $result_arr );
        exit;
    }

    $id = $_POST[ 'id' ];
    if ( !( preg_match( '/^[0-9]{1,30}$/', $id ) ) ) {
        $result_arr[] = array( 'message'=>'Invalid User id' );
        echo json_encode( $result_arr );
        exit;
    }
    $check = "SELECT `id` FROM $tbname";
    $result1 = mysqli_query( $conn, $check );
    $num = $result1->num_rows;
    for ( $i = 0; $i < $num; $i++ ) {
        $arr = mysqli_fetch_assoc( $result1 );
        if ( $arr[ 'id' ] == $id ) {
            if ( $updatedes != null && $updatetitle != null ) {
                $query = "UPDATE $tbname SET `Description`='$updatedes',Title='$updatetitle'  WHERE id='$id'";
                if ( $conn -> query( $query ) ) {
                    $return_arr[] = array( 'message' => 'Post Title and Description Updated' );
                    echo json_encode( $return_arr );
                    exit;
                }
            }
            if ( $updatedes != null ) {
                $query = "UPDATE $tbname SET `Description`='$updatedes' WHERE id='$id'";
                if ( $conn -> query( $query ) ) {
                    $return_arr[] = array( 'message' => 'Post Description Updated' );
                    echo json_encode( $return_arr );
                    exit;
                }
            }
            if ( $updatetitle != null ) {
                $query = "UPDATE $tbname SET Title='$updatetitle'  WHERE id='$id'";
                if ( $conn -> query( $query ) ) {
                    $return_arr[] = array( 'message' => 'Post Title Updated' );
                    echo json_encode( $return_arr );
                    exit;
                }
            }
        }
    }

}

?>