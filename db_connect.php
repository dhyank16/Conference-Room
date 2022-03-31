<?php
    $dbHost = '127.0.0.1'; //or localhost
    $dbName = 'conference'; // your db_name
    $dbUsername = 'root'; // root by default for localhost 
    $dbPassword = '';  // by default empty for localhost

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
?>