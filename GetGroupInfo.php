<?php

    $dbhost = getenv("MYSQL_SERVICE_HOST");
    $dbport = getenv("MYSQL_SERVICE_PORT");
    $dbuser = getenv("MYSQL_USER");
    $dbpwd = getenv("MYSQL_PASSWORD");
    $dbname = getenv("MYSQL_DATABASE");
    $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    
    $groupid = $_POST['groupid'];
    $final_result = '';
    
    $query = mysqli_query($connection, "SELECT seat1, seat2, seat3, seat4 FROM Groups WHERE groupid='$groupid'");
    $num_rows = mysqli_num_rows($query);
    
    if ($num_rows == 1){
        $row = $query->fetch_array();
        $final_result = $row['seat1'] . ' ' . $row['seat2'] . ' ' . $row['seat3'] . ' ' . $row['seat4'];
        print(json_encode($final_result));
    }
?>