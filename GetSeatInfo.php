<?php

    $dbhost = getenv("MYSQL_SERVICE_HOST");
    $dbport = getenv("MYSQL_SERVICE_PORT");
    $dbuser = getenv("MYSQL_USER");
    $dbpwd = getenv("MYSQL_PASSWORD");
    $dbname = getenv("MYSQL_DATABASE");
    $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    
    $seatid = $_POST['seatid'];
    
    $query = mysqli_query($connection, "SELECT groupid, region FROM Seats WHERE seatid='$seatid'");
    $num_rows = mysqli_num_rows($query);
    
    $query2 = mysqli_query($connection, "SELECT username FROM Students WHERE seatid='$seatid'");
    $num_rows2 = mysqli_num_rows($query2);
    
    $studentid = 'None';
    
    if($num_rows2 == 1){
        $row2 = $query2->fetch_array();
        $studentid = $row2['username'];
    }
    
    if($num_rows == 1){
        $row = $query->fetch_array();
        print(json_encode($row['groupid'] . ' ' . $row['region'] . ' ' . $studentid));
    }
    else {
        print(json_encode('None' . ' ' . 'None' . ' ' . 'None'));
    }
?>