<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Teacher Homepage </title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="SeatStyle.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="SeatGrid.js"></script>
<script src="SeatGridMaker.js"></script>
<script src="Teacher.js"></script>
<link rel="stylesheet" type="text/css" href="TeacherHome.css">
</head>
<body>
<div class="container-fluid" id="cont1">
  <div class="page-header" id="header">
        <div>
          <form id="logout-form">
                <button type="submit"class="btn btn-default pull-right" id="logout">
                  <span class="glyphicon glyphicon-log-out"></span>
                  Logout</button>
          </form>
          </div>
          <h2 class="header2"> Welcome to GroupMaker! </h2>
          <?php
            echo $_SESSION['username'];
          ?>
          <p class="text1"> is logged in.</p>
  </div>
</div>

<div class="container-fluid" id="cont3">
  <div class="container-fluid">
      <ul class="sidebar-nav nav-pills nav-stacked navbar-inverse">
        <li class="active">
          <a href="#home" data-toggle="tab">
          <span class="glyphicon glyphicon-home"></span>
           Home</a></li>
        <li>
        <a href="#group_management" data-toggle="tab">
          <span class="glyphicon glyphicon-cog"></span>
          Manage Groups</a></li>
        <li>
          <a href="#classroom1" data-toggle="tab">
            <span class="glyphicon glyphicon-th"></span>
          Seating Chart</a></li>
        <li>
          <a href="#surveys" data-toggle="tab">
            <span class="glyphicon glyphicon-list-alt"></span>
          Distribute Surveys </a></li>
      </ul>
    </div>
   <div class="tab-content">
     <div class="tab-pane fade in active text-center" id="home">
       <!--<span> Please choose a class to get started!</span>
       <div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
    <a href="#">Course 1</a>
    <a href="#">Course 2</a>
    <a href="#">Course 3</a>
  </div>
</div>
-->   </div>
     <div class="tab-pane fade" id="group_management">
         <div class="col-md-offset-2">
           <div class="panel panel-default" id="panel1">
             <div class="panel-header text-center">
             <h3><strong>Group Management</strong></h3>
             <div class="panel-body">
             <p>Create a new group</p>
             <form method="POST">
                Group Name:<br>
                <input type="text" name="group_name"><br>
                <br>
                <p>Add another member:</p>
                <script src="addInput.js" language="Javascript" type="text/javascript"></script>
                <div id="dynamicInput">
                    Username 1<br><input type="text" name="myInputs[]">
                </div>
                <input type="button" class="btn btn-primary" value="Add another user" onClick="addInput('dynamicInput');">
                <input type="submit" class="btn btn-primary" value="Submit"><br>
             </form>
             <br>
             <p>Delete a group</p>
             <form>
                 Group id:<br>
                 <input type="text" name="id"><br>
                 <input type="submit" class="btn btn-primary" value="Delete">

             </form>
             <br>
             <?php
                /*
                $dbhost = getenv("MYSQL_SERVICE_HOST");
                $dbport = getenv("MYSQL_SERVICE_PORT");
                $dbuser = getenv("MYSQL_USER");
                $dbpwd = getenv("MYSQL_PASSWORD");
                $dbname = getenv("MYSQL_DATABASE");

                $connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);

                if ($connection->connect_errno) {
                    printf("Connection failed: %s\n", $mysqli->connect_error);
                    exit();
                } else {
                    echo "Connected to database". "<br>";
                }

                $result = $connection->query("SELECT * FROM Groups");
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "groupid: " . $row["groupid"]. "<br>";
                    }
                } else {
                    echo "0 results";
                }
                */
             ?>
        </div>
     </div>
   </div>
 </div>
 </div>
      <div class="tab-pane fade" id="classroom1">
        <div class="col-md-offset-2">
          <div id="classroom"></div>
        </div>
      </div>
      <div class="tab-pane fade" id="surveys">
        <div class="col-md-offset-2">
            <h3>Surveys</h3>
              <form class="form-horizontal" id="Survey_Form">
                  Include Seating Preferences?
                  <input type="checkbox" name="Seating_Preference"><br>
                  Group by previous Grades?
                  <input type="checkbox" name="Previous_Grades"><br>
                <!--  Question 3:
                  <input type="text" name="group_name"><br>
                  Question 4:
                  <input type="text" name="group_name"><br>
                  Question 5:
                  <input type="text" name="group_name"><br>!-->
                  <button type="submit" class="btn btn-primary" value="Enable Survey">Enable Survey</button>
              </form>
              
              <form class="form-horizontal" id="disablesurvey">
                  <button type="submit" class="btn btn-primary" value="Enable Survey">Disable Survey</button>
              </form>
              <form class="form-horizontal" id="assignseats">
                  <button type="submit" class="btn btn-primary" value="Assign Seats">Assign Seats</button>
              </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
