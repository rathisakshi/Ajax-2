<?php

include 'connection.php';
$tbname = 'Registrations';
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

    $firstName = $_POST[ 'fname' ];
    if ( !( preg_match( '/^[a-zA-Z ]{1,30}$/', $firstName ) ) ) {
        $result_arr[] = array( 'message'=>'Invalid First Name' );
        echo json_encode( $result_arr );
        exit;
    }
    $lastName = $_POST[ 'lname' ];
    if ( !( preg_match( '/^[a-zA-Z ]{1,30}$/', $lastName ) ) ) {
        $result_arr[] = array( 'message'=>'Invalid Last Name' );
        echo json_encode( $result_arr );
        exit;
    }
    $email = $_POST[ 'email' ];
    $password = $_POST[ 'password' ];

    $query = "SELECT `email` FROM $tbname";
    $result = $conn -> query( $query );
    if ( mysqli_num_rows( $result ) > 0 ) {
        while ( $row = mysqli_fetch_assoc( $result ) ) {
            if ( $row[ 'email' ] == $email ) {
                $return_arr[] = array( 'message' => 'email aready exists' );
                echo json_encode( $return_arr );
                exit;
            }
        }
    }
    $sql = "INSERT INTO Registrations (firstname, lastname, email, password) 
    VALUES ('$firstName', '$lastName', '$email', '$password')";
    
    if ($conn->query($sql) ) {
        $return_arr[] = array(
            'success' => true,
            'message' => 'Registered successfully'
        );
        echo json_encode( $return_arr );

    }

    
        
        

}

