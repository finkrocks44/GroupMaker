<?php
  //require_once 'connect.php';
  //session_start();
    
  $dbhost = getenv("MYSQL_SERVICE_HOST");
  $dbport = getenv("MYSQL_SERVICE_PORT");
  $dbuser = getenv("MYSQL_USER");
  $dbpwd = getenv("MYSQL_PASSWORD");
  $dbname = getenv("MYSQL_DATABASE");

  $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
  
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['rusername'];
  $password = $_POST['rpassword'];
  $password2 = $_POST['confirmpassword'];

  $query = mysqli_query($connection, "SELECT username FROM Students WHERE username='$username'");
  $num_rows = mysqli_num_rows($query);
  //print($num_rows);
  if($num_rows == 0 and $password == $password2 and $firstname != "" and $lastname != "" and $username != ""){
    $newpassword = md5($password);
    $query = mysqli_query($connection, "INSERT INTO Students(firstname, lastname, username, password) VALUES ('$firstname', '$lastname', '$username', '$newpassword')");

    //print("ran through sql");
    print(json_encode(true));
  }
  else{
    //print("didnt run through sql");
    header('HTTP/1.1 401 Unauthorized');
    header('Content-type: application/json');
    //print(json_encode($num_rows . ' ' . $firstname . ' ' . $lastname . ' ' . $username . ' ' . $password . ' ' . $password2));
    print(json_encode(false));
  }
  
  mysqli_close($connection);
?>
