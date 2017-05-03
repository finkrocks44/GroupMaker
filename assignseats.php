<?php

  $dbhost = getenv("MYSQL_SERVICE_HOST");
  $dbport = getenv("MYSQL_SERVICE_PORT");
  $dbuser = getenv("MYSQL_USER");
  $dbpwd = getenv("MYSQL_PASSWORD");
  $dbname = getenv("MYSQL_DATABASE");
  $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
  
  function assignseat($pref, $studentid){
    if ($pref == 6){
        $query = mysqli_query($connection, "SELECT pref6 FROM Students WHERE username='$studentid'");
        $row = $query->fetch_array();
        $region = $row['pref6'];
        $available = mysqli_query($connection, "SELECT seatid FROM Seats WHERE region='$region' AND occupied=0");
        $numrows = mysqli_num_rows($available);
        if ($numrows > 0){
            $availablerow = $available->fetch_array();
            $seatid = $availablerow['seatid'];
            $query = mysqli_query($connection, "UPDATE Students SET seatid='$seatid' WHERE username='$studentid'");
            $query = mysqli_query($connection, "UPDATE Seats SET occupied=1 WHERE seatid='$seatid'");
        }
        else {
            return false;
        }
    }
    elseif ($pref == 5){
        $query = mysqli_query($connection, "SELECT pref5 FROM Students WHERE username='$studentid'");
        $row = $query->fetch_array();
        $region = $row['pref5'];
        $available = mysqli_query($connection, "SELECT seatid FROM Seats WHERE region='$region' AND occupied=0");
        $numrows = mysqli_num_rows($available);
        if ($numrows > 0){
            $availablerow = $available->fetch_array();
            $seatid = $availablerow['seatid'];
            $query = mysqli_query($connection, "UPDATE Students SET seatid='$seatid' WHERE username='$studentid'");
            $query = mysqli_query($connection, "UPDATE Seats SET occupied=1 WHERE seatid='$seatid'");
            return true;
        }
        else {
            assignseat($pref+1, $studentid);
        }
    }
    elseif ($pref == 4){
        $query = mysqli_query($connection, "SELECT pref4 FROM Students WHERE username='$studentid'");
        $row = $query->fetch_array();
        $region = $row['pref4'];
        $available = mysqli_query($connection, "SELECT seatid FROM Seats WHERE region='$region' AND occupied=0");
        $numrows = mysqli_num_rows($available);
        if ($numrows > 0){
            $availablerow = $available->fetch_array();
            $seatid = $availablerow['seatid'];
            $query = mysqli_query($connection, "UPDATE Students SET seatid='$seatid' WHERE username='$studentid'");
            $query = mysqli_query($connection, "UPDATE Seats SET occupied=1 WHERE seatid='$seatid'");
            return true;
        }
        else {
            assignseat($pref+1, $studentid);
        }
    }
    elseif ($pref == 3){
        $query = mysqli_query($connection, "SELECT pref3 FROM Students WHERE username='$studentid'");
        $row = $query->fetch_array();
        $region = $row['pref3'];
        $available = mysqli_query($connection, "SELECT seatid FROM Seats WHERE region='$region' AND occupied=0");
        $numrows = mysqli_num_rows($available);
        if ($numrows > 0){
            $availablerow = $available->fetch_array();
            $seatid = $availablerow['seatid'];
            $query = mysqli_query($connection, "UPDATE Students SET seatid='$seatid' WHERE username='$studentid'");
            $query = mysqli_query($connection, "UPDATE Seats SET occupied=1 WHERE seatid='$seatid'");
            return true;
        }
        else {
            assignseat($pref+1, $studentid);
        }
    }
    elseif ($pref == 2){
        $query = mysqli_query($connection, "SELECT pref2 FROM Students WHERE username='$studentid'");
        $row = $query->fetch_array();
        $region = $row['pref2'];
        $available = mysqli_query($connection, "SELECT seatid FROM Seats WHERE region='$region' AND occupied=0");
        $numrows = mysqli_num_rows($available);
        if ($numrows > 0){
            $availablerow = $available->fetch_array();
            $seatid = $availablerow['seatid'];
            $query = mysqli_query($connection, "UPDATE Students SET seatid='$seatid' WHERE username='$studentid'");
            $query = mysqli_query($connection, "UPDATE Seats SET occupied=1 WHERE seatid='$seatid'");
            return true;
        }
        else {
            assignseat($pref+1, $studentid);
        }
    }
    
  }
  
  $region = $_POST['region'];
  $survey = mysqli_query($connection, "SELECT enablesurvey FROM Surveys");
  $checksurvey = $survey->fetch_array();
  
  if ($checksurvey['enablesurvey'] == 0){
      $students = mysqli_query($connection, "SELECT username FROM Students WHERE pref1='$region' AND (seatid='' OR seatid IS NULL)");  //need to change this
      $available = mysqli_query($connection, "SELECT seatid FROM Seats WHERE region='$region' AND occupied=0");
      $checkstudent = mysqli_num_rows($students);
      $checkavailablerows = mysqli_num_rows($available);
      
      $studentcount = $checkstudent;
      $availablecount = $checkavailablerows;
      
      while(true){
          if ($studentcount == 0 or $availablecount == 0){
              break;
          }
          $studentrow = $students->fetch_array();
          $availablerow = $available->fetch_array();
          
          $studentid = $studentrow['username'];
          $seatid = $availablerow['seatid'];
          
          $query = mysqli_query($connection, "UPDATE Students SET seatid='$seatid' WHERE username='$studentid'");
          $query = mysqli_query($connection, "UPDATE Seats SET occupied=1 WHERE seatid='$seatid'");
          
          $studentcount--;
          $availablecount--;
      }
      
      if ($availablecount < 0 or $studentcount < 0){
          print(json_encode("Something went wrong with the loop"));
      }
      elseif ($availablecount >= 0 and $studentcount == 0){
          print(json_encode("done assigned students with pref = " . $region));
      }
      else {
          while ($row = $student->fetch_array()){
              $pref = 2;
              assignseat($pref, $row['username']);
          }
      }
  }
  else {
      print(json_encode("Surveys must be disabled first. surveyenable = " . $checksurvey['enablesurvey']));
  }
?>