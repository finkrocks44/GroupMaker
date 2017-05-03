<!DOCTYPE HTML>
<html>
	<head>
		<title>GroupMaker Login</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="jquery.js"></script> 
    	<script> 
    		$(function(){
      			$("#includedContent").load("GroupMakerHome.html"); 
    		});
    	</script>
    	</head>
	<body>
		<div id="includedContent"></div>
		<?php
		
		$alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R');
		function assigngroup ($row, $column){
		    if ($row <= 2){
		        //1-9
		        return checkcolumn(0, $column);
		    }
		    elseif ($row <= 4){
		        //10-18
		        return checkcolumn(9, $column);
		    }
		    elseif ($row <= 6){
		        //19-27
		        return checkcolumn(18, $column);
		    }
		    elseif ($row <= 8){
		        //28-36
		        return checkcolumn(27, $column);
		    }
		    elseif ($row <= 10){
		        //37-45
		        return checkcolumn(36, $column);
		    }
		    elseif ($row <= 12){
		        //46-54
		        return checkcolumn(45, $column);
		    }
		    elseif ($row <= 14){
		        //55-63
		        return checkcolumn(54, $column);
		    }
		    elseif ($row <= 16){
		        //64-72
		        return checkcolumn(63, $column);
		    }
		    elseif ($row <= 18){
		        //73-81
		        return checkcolumn(72, $column);
		    }
		    else {
		        //invalid arguments
		        return null;
		    }
		}
		
		function checkcolumn($add, $column){
		    if ($column <=3){
		        return 1+$add;
		    }
		    elseif ($column >=6 and $column <=7) {
		        return 2+$add;
		    }
		    elseif ($column <= 9) {
		        return 3+$add;
		    }
		    elseif ($column <= 11) {
		        return 4+$add;
		    }
		    elseif ($column <= 13) {
		        return 5+$add;
		    }
		    elseif ($column <= 15) {
		        return 6+$add;
		    }
		    elseif ($column <= 17) {
		        return 7+$add;
		    }
		    elseif ($column <= 19) {
		        return 8+$add;
		    }
		    elseif ($column >= 22 and $column <= 23) {
		        return 9+$add;
		    }
		    else {
		        //not a seat, but the stairs
		        return null;
		    }
		}
		
		function assignregion ($row, $column){
		    if ($column < 4) {
		        if ($row < 11) {
		            return 1;
		        }
		        else {
		            return 2;
		        }
		    }  
		    elseif ($column > 5 and $column < 20) {
		        if ($row < 11) {
		            return 3;
		        }
		        else {
		            return 4;
		        }
		    }
		    elseif ($column > 21) {
		        if ($row < 11) {
		            return 5;
		        }
		        else {
		            return 6;
		        }
		    }
		    else {
		        return null;
		    }
		}


			$dbhost = getenv("MYSQL_SERVICE_HOST");
			$dbport = getenv("MYSQL_SERVICE_PORT");
			$dbuser = getenv("MYSQL_USER");
			$dbpwd = getenv("MYSQL_PASSWORD");
			$dbname = getenv("MYSQL_DATABASE");
			$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
			if ($connection->connect_errno) {
				//printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			} else {
				//printf("Connected to the database\n");
				//$drop1 = mysqli_query($connection, "DROP TABLE Groups");
				//$drop2 = mysqli_query($connection, "DROP TABLE Students");
				//$drop3 = mysqli_query($connection, "DROP TABLE Seats");
				//$drop4 = mysqli_query($connection, "DROP TABLE Surveys");
				
				$sql = "CREATE TABLE Groups (
				    groupid INT(100) AUTO_INCREMENT PRIMARY KEY,
				    seat1 VARCHAR(16) NOT NULL DEFAULT '',
				    seat2 VARCHAR(16) NOT NULL DEFAULT '',
				    seat3 VARCHAR(16) NOT NULL DEFAULT '',
				    seat4 VARCHAR(16) NOT NULL DEFAULT '',
				    region INT(7))";
				$sql2 = "CREATE TABLE Students (
				    username VARCHAR(32) PRIMARY KEY,
				    groupid INT(100),
				    seatid VARCHAR(16) NOT NULL DEFAULT '',
				    firstname VARCHAR(50) NOT NULL,
				    lastname VARCHAR(50) NOT NULL,
				    password VARCHAR(255) NOT NULL,
				    assigned TINYINT(1) NOT NULL DEFAULT 0,
				    pref1 INT(7),
				    pref2 INT(7),
				    pref3 INT(7),
				    pref4 INT(7),
				    pref5 INT(7),
				    pref6 INT(7))";
				$sql3 = "CREATE TABLE Seats (
				    seatid VARCHAR(16) PRIMARY KEY,
				    groupid INT(100), 
				    region INT(7),
				    occupied TINYINT(1) NOT NULL DEFAULT 0)";
				$sql4 = "CREATE TABLE Surveys (
				    enablesurvey TINYINT(1) NOT NULL DEFAULT 0,
				    seatingpreference TINYINT(1) NOT NULL DEFAULT 0,
				    gradehistory TINYINT(1) NOT NULL DEFAULT 0)";
				$exists = mysqli_query($connection, "SHOW TABLES LIKE 'Groups'");
				$existsrow = mysqli_num_rows($exists);
				if ($existsrow == 0){
				    //$connection->query($sql);
				    $create1 = mysqli_query($connection, $sql);
				    //echo "Groups table created";
				    for ($k = 0; $k < 81; $k++){
				        $query = mysqli_query($connection, "INSERT INTO Groups (groupid) VALUES (NULL)");
				    }
				    //$selectgroups = mysqli_query($connection, "SELECT * FROM Groups");
				    //while($row = $selectgroups->fetch_array()){
				    //    print_r($row);
				    //}
				}
				else {
				    //echo "Groups table already exists";
				    /*
				    $showstuff = "SHOW COLUMNS FROM Groups";
				    $stuff = mysqli_query($connection, $showstuff);
				    if (mysqli_num_rows($stuff) > 0) {
				        while ($row = $stuff->fetch_array()) {
				            print_r($row);
				        }
				    }
				    */
				}
				
				$exists2 = mysqli_query($connection, "SHOW TABLES LIKE 'Students'");
				$existsrow2 = mysqli_num_rows($exists2);
				if ($existsrow2 == 0){
				    $create2 = mysqli_query($connection, $sql2);
				    //echo "Students table created";
				}
				else {
				    //echo "Students table already exists";
				    /*
				    $showstuff2 = "SHOW COLUMNS FROM Students";
				    $stuff2 = mysqli_query($connection, $showstuff2);
				    if (mysqli_num_rows($stuff2) > 0) {
				        while ($row = $stuff2->fetch_array()) {
				            print_r($row);
				        }
				    }
				    */
				}
				
				$exists3 = mysqli_query($connection, "SHOW TABLES LIKE 'Seats'");
				$existsrow3 = mysqli_num_rows($exists3);
				if ($existsrow3 == 0){
				    $create3 = mysqli_query($connection, $sql3);
				    //echo "Seats table created";
				    $rows = 18;
				    $columns = 22;
				    for ($i = 1; $i < $rows+1; $i++){ //$rows = 18
				        for ($j = 2; $j < $columns+2; $j++){ //columns = 22
				            if ($j != 4 and $j != 5 and $j != 20 and $j != 21){
				                $group = assigngroup($i, $j);
				                $region = assignregion($i, $j);
				                if ($group != null){
				                    $seatid = ($alphabet[$i-1] . "_" . $j);
				                    $query = mysqli_query($connection, "INSERT INTO Seats (seatid, groupid, region) VALUES ('$seatid', '$group', '$region')");
				                    
				                    $check1 = mysqli_query($connection, "SELECT seat1 FROM Groups WHERE groupid='$group'");
				                    //$check1rows = mysqli_num_rows($check1);
				                    $row1 = $check1->fetch_array();
				                    if ($row1['seat1'] == ""){
				                        $query = mysqli_query($connection, "UPDATE Groups SET seat1='$seatid' WHERE groupid='$group'");
				                        continue;
				                    }
				                    
				                    $check2 = mysqli_query($connection, "SELECT seat2 FROM Groups WHERE groupid='$group'");
				                    //$check2rows = mysqli_num_rows($check2);
				                    $row2 = $check2->fetch_array();
				                    if ($row2['seat2'] == ""){
				                        $query = mysqli_query($connection, "UPDATE Groups SET seat2='$seatid' WHERE groupid='$group'");
				                        continue;
				                    }
				                    
				                    $check3 = mysqli_query($connection, "SELECT seat3 FROM Groups WHERE groupid='$group'");
				                    //$check3rows = mysqli_num_rows($check3);
				                    $row3 = $check3->fetch_array();
				                    if ($row3['seat3'] == ""){
				                        $query = mysqli_query($connection, "UPDATE Groups SET seat3='$seatid' WHERE groupid='$group'");
				                        continue;
				                    }
				                    
				                    $check4 = mysqli_query($connection, "SELECT seat4 FROM Groups WHERE groupid='$group'");
				                    //$check4rows = mysqli_num_rows($check4);
				                    $row4 = $check4->fetch_array();
				                    if ($row4['seat4'] == ""){
				                        $query = mysqli_query($connection, "UPDATE Groups SET seat4='$seatid' WHERE groupid='$group'");
				                        continue;
				                    }
				                    
				                    $updateregion = mysqli_query($connection, "UPDATE Groups SET region='region' WHERE groupid='$group'");
				                }
				            }
				        }
				    }
				    //$selectseats = mysqli_query($connection, "SELECT COUNT(*) FROM Seats");
				    //while($row = $selectseats->fetch_array()){
				    //    print_r($row);
				    //}
				    //$countseats = mysqli_num_rows($selectseats);
				    //print_r($countseats);
				    //$selectgroups = mysqli_query($connection, "SELECT * FROM Groups");
				    //while ($row = $selectgroups->fetch_array()){
				    //    print_r($row);
				    //}
				}
				else {
				    //echo "Seats table already exists";
				    /*
				    $showstuff3 = "SHOW COLUMNS FROM Seats";
				    $stuff3 = mysqli_query($connection, $showstuff3);
				    if (mysqli_num_rows($stuff3) > 0) {
				        while ($row = $stuff3->fetch_array()) {
				            print_r($row);
				        }
				    }
				    */
				}
				
				$exists4 = mysqli_query($connection, "SHOW TABLES LIKE 'Surveys'");
				$existsrow4 = mysqli_num_rows($exists4);
				if ($existsrow4 == 0){
				    $create4 = mysqli_query($connection, $sql4);
				    $insertSurvey = mysqli_query($connection, "INSERT INTO Surveys (enablesurvey, seatingpreference) VALUES (DEFAULT, DEFAULT)");
				    
				    //$checksurvey = mysqli_query($connection, "SELECT * FROM Surveys");
				    //$row = $checksurvey->fetch_array();
				    //print_r($row);
				    //echo "Surveys table created";
				}
				else {
				    //echo "Surveys table already exists";
				    /*
				    $showstuff4 = "SHOW COLUMNS FROM Surveys";
				    $stuff4 = mysqli_query($connection, $showstuff4);
				    if (mysqli_num_rows($stuff4) > 0) {
				        while ($row = $stuff4->fetch_array()) {
				            print_r($row);
				        }
				    }
				    */
				}
			}
			
			
			$connection->close();
		?>
	
	</body>
</html>
