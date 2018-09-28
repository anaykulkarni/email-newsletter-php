<?php
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];

    $dbc = mysqli_connect('localhost', 'root', 'Home1998', 'elvis_store')
        or die('Couldn\'t connect to the database');
    
    $query = "INSERT INTO email_list(first_name, last_name, email) " .
        "VALUES('$first_name', '$last_name', '$email')";

    $result = mysqli_query($dbc, $query) 
        or die("Couldn't query the database");

    echo 'Customer successfully added to the database';

    mysqli_close($dbc);
?>
