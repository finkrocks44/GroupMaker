<?php

  if (isset($_SESSION)){
      session_unset();
      session_destroy();
  }
  session_start();
  
  $dbhost = getenv("MYSQL_SERVICE_HOST");
  $dbport = getenv("MYSQL_SERVICE_PORT");
  $dbuser = getenv("MYSQL_USER");
  $dbpwd = getenv("MYSQL_PASSWORD");
  $dbname = getenv("MYSQL_DATABASE");

  $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);

  if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  } else {
    echo "connected";
  }

  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $hashpassword = md5($password);
  $query = mysqli_query($connection, "SELECT * FROM Students WHERE username='$username' AND password='$hashpassword'");
  //$result = mysqli_fetch_row($query);
  $num_rows = mysqli_num_rows($query);
  if($num_rows == 1) {
    $_SESSION['username'] = $username;
    print($_SESSION['username']);
  }
  else {
    //unset($_SESSION['username']);
    header('HTTP/1.1 401 Unauthorized');
    header('Content-type: application/json');
    print(json_encode(false));
  }
  
  mysqli_close($connection);
?>
