<?php
  $dbhost = getenv("MYSQL_SERVICE_HOST");
  $dbport = getenv("MYSQL_SERVICE_PORT");
  $dbuser = getenv("MYSQL_USER");
  $dbpwd = getenv("MYSQL_PASSWORD");
  $dbname = getenv("MYSQL_DATABASE");
  $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
  
  $check = mysqli_query($connection, "SELECT * FROM Surveys");
  $numrows = mysqli_num_rows($check);
  
  if ($numrows == 1){
    $query = mysqli_query($connection, "UPDATE Surveys SET enablesurvey=0");
    $query2 = mysqli_query($connection, "SELECT * FROM Surveys");
    $row = $query2->fetch_array();
    print(json_encode("successsfully disabled survey" . $row['enablesurvey']));
  }
  else {
    print(json_encode("Something went wrong with the database"));
  }
  
?>