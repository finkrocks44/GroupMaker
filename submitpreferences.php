<?php

  session_start();
  
  $dbhost = getenv("MYSQL_SERVICE_HOST");
  $dbport = getenv("MYSQL_SERVICE_PORT");
  $dbuser = getenv("MYSQL_USER");
  $dbpwd = getenv("MYSQL_PASSWORD");
  $dbname = getenv("MYSQL_DATABASE");
  $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
  
  $query = mysqli_query($connection, "SELECT enablesurvey FROM Surveys WHERE enablesurvey=1");
  $numrows = mysqli_num_rows($query);
  
  $pref1 = $_POST['preference1'];
  $pref2 = $_POST['preference2'];
  $pref3 = $_POST['preference3'];
  $pref4 = $_POST['preference4'];
  $pref5 = $_POST['preference5'];
  $pref6 = $_POST['preference6'];
  $username = $_SESSION['username'];
  
  if ($numrows == 1){
    $query2 = mysqli_query($connection, "UPDATE Students SET pref1='$pref1', pref2='$pref2', pref3='$pref3', pref4='$pref4', pref5='$pref5', pref6='$pref6' WHERE username='$username'");
    
    $checkquery = mysqli_query($connection, "SELECT pref1, pref2, pref3, pref4, pref5, pref6 FROM Students WHERE username='$username'");
    $checkrows = mysqli_num_rows($checkquery);
    
    if ($checkrows == 1){
        $row = $checkquery->fetch_array();
        if($pref1 == $row['pref1'] and $pref2 == $row['pref2'] and $pref3 == $row['pref3'] and $pref4 == $row['pref4'] and $pref5 == $row['pref5'] and $pref6 == $row['pref6']){
            print(json_encode("Success. Query results match user inputs. User entered:" . ' ' . $row['pref1'] . ' ' . $row['pref2'] . ' ' . $row['pref3'] . ' ' . $row['pref4'] . ' ' . $row['pref5'] . ' ' . $row['pref6']));
        }
        else {
            print(json_encode("Failed to insert correct fields. Results from query:" . ' ' . $row['pref1'] . ' ' . $row['pref2'] . ' ' . $row['pref3'] . ' ' . $row['pref4'] . ' ' . $row['pref5'] . ' ' . $row['pref6']));
        }
    }
    else {
        print(json_encode("Something went wrong with the values. Number of rows returned: " . $checkrows . ' ' . "Username: " . $username));
    }
  }
  else {
      print(json_encode("Surveys are disabled"));
  }
?>