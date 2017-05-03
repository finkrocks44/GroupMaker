<?php
    session_start();
    
    //print(json_encode($_SESSION['username']));
    
    $dbhost = getenv("MYSQL_SERVICE_HOST");
    $dbport = getenv("MYSQL_SERVICE_PORT");
    $dbuser = getenv("MYSQL_USER");
    $dbpwd = getenv("MYSQL_PASSWORD");
    $dbname = getenv("MYSQL_DATABASE");
    
    $username = $_SESSION['username'];
    
    $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    
    $query = mysqli_query($connection, "SELECT firstname FROM Students WHERE username='$username'");
    $num_rows = mysqli_num_rows($query);
    
    if($num_rows == 1){
        $row = $query->fetch_array();
        print($row['firstname']);
    }
    else {
        header('HTTP/1.1 401 Unauthorized');
        header('Content-type: application/json');
        print(json_encode(false));
    }

?>