<?php

include 'connection.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    $username = $_POST[ 'email' ];

    $password = $_POST[ 'password' ];

    $conn->select_db( $dbname );

    $query = 'SELECT `email`,`password` FROM Registrations';
    $result = $conn->query( $query );

    if ( $result === false ) {
        // display any database errors
        echo 'Error: ' . mysqli_error( $conn );
        exit;
    }

    // fetch all rows into an array
    // while( $row = $result->fetch_assoc() ) {
    //     if ( checkusername( $row[ 'email' ], $username ) ) {
    //         echo "<pre>";print_r($_POST);exit;
    //         if ( checkpassword( $row[ 'password' ], $password ) ) {
    //             $return_arr[] = array(
    //                 'success' => true
    //             );
    //             echo json_encode( $return_arr );
    //             exit;
    //         } else {
    //             $return_arr[] = array(
    //                 'success' => false
    //             );
    //             echo json_encode( $return_arr );
    //             exit;
    //         }
    //     } else {
    //         $return_arr[] = array(
    //             'success' => false
    //         );
    //         echo json_encode( $return_arr );
    //         exit;
    //     }

    // }
    while( $row = $result->fetch_assoc() ) {
        if ( $row[ 'email' ] ==  $username  ) {
            // echo "<pre>";print_r($_POST);exit;
            if ( $row[ 'password' ] ==  $password  )  {
                $return_arr[] = array(
                    'success' => true
                );
                echo json_encode( $return_arr );
                exit;
            } else {
                $return_arr[] = array(
                    'success' => false
                );
                echo json_encode( $return_arr );
                exit;
            }
        } else {
            $return_arr[] = array(
                'success' => false
            );
            echo json_encode( $return_arr );
            exit;
        }

    }

}

// function checkpassword( $rows, $password ) {
//     if ( $rows == $password ) {
//         return true;
//     }
//     return false;
// }

// function checkusername( $rows, $username ) {
//     if ( $rows == $username ) {
//         return true;
//     }

//     return false;
// }
?>
