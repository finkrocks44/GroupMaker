<?php

  $dbhost = getenv("MYSQL_SERVICE_HOST");
  $dbport = getenv("MYSQL_SERVICE_PORT");
  $dbuser = getenv("MYSQL_USER");
  $dbpwd = getenv("MYSQL_PASSWORD");
  $dbname = getenv("MYSQL_DATABASE");

  $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);

  $SeatPref = $_POST["Seating_Preference"];
  
  //if ($SeatPref == "on"){
  if (1== 1){
      $query = mysqli_query($connection, "UPDATE Surveys SET enablesurvey=1, seatingpreference=1");
      
      $results = mysqli_query($connection, "SELECT enablesurvey, seatingpreference FROM Surveys");
      $numrows = mysqli_num_rows($results);
      
      if($numrows == 1){
          $row = $results->fetch_array();
          
          if($row['seatingpreference'] == 1 and $row['enablesurvey'] == 1){
              print(json_encode("query successful"));
          }
          else {
              print(json_encode('Query Results are wrong....   ' . 'seatingpreference = ' . $row['seatingpreference'] . ' enablesurvey = ' . $row['enablesurvey']));
          }
      }
      else {
          print(json_encode('Failed. Number of results from query: ' . $numrows));
      }
  }
  
  /*
  if($_POST['SeatingPreference'] == 'CheckedSeat')
  {
	  $SeatPref= 1;
  }
  else{
	  $SeatPref = 0;
  }
  $SeatingPreference = $_POST['SeatingPreference'];
  if($_POST['Previous_Grades'] == 'CheckedGrades')
  {
	  $GradeHistory = 1;
  }
  else {
	  $GradeHistory = 0;
  }
  $TeacherID = 1;
  */
  
  #$query = mysqli_query($connection, "INSERT INTO Surveys(enablesurvey, seatingpreference, gradehistory, teacherid) VALUES ('$SurveyEnable', '$SeatPref', '$GradeHistory', '$TeacherID')");
  
  mysqli_close($connection);
?>
