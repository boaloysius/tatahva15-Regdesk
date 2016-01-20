<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="AJ/event_confirmation.js"></script>
	</head>
	<body>
		<div id="main_head">Event Managers List</div>
		
	</body>
</html>

<?php
	require 'connectDatabase.php';
	$EventCode = $_POST['EventCode'];
	
	if(!isset($_POST['Submit'])){
		echo "<div id=\"alerter_sp3\" draggable=\"true\">
		<form action = \"event_manager.php\" method = \"POST\" >
			<div class=\"labelo\">Select An Event:</div>
			<select name = 'EventCode' id=\"drop_down\">
				<option value = \"\" selected></option>";
					$query = "SELECT * FROM Events";
					if($query_run = mysqli_query($mysql_conn,$query)){
						while($query_row = mysqli_fetch_array($query_run,MYSQLI_NUM)){
							echo "<option value = '$query_row[2]'>$query_row[1]</option>";
						}
					}
				echo"
			</select><br>
			<input type=\"submit\" name = \"Submit\" class=\"button\">
		</form><br>

	</div>";
	}
	
	if(isset($_POST['Submit']) && !empty($EventCode)){
		$query = "SELECT @row_number := @row_number +1 AS 'S.No', CaptainID FROM Registration , (SELECT @row_number :=0) AS t WHERE Registration.TathvaID =  Registration.CaptainID AND Registration.EventCode = '$EventCode' AND Registration.Participating = 1 ORDER BY SNo";
		if($query_run = mysqli_query($mysql_conn,$query)){
			$query2 = "SELECT EventName FROM Events WHERE EventCode = '$EventCode'";
			$query_run2 = mysqli_query($mysql_conn,$query2);
			$query_row2 = mysqli_fetch_array($query_run2,MYSQLI_NUM);
			echo "<div id=\"edit_button1\" class='button'>Home</div><center><h1>$query_row2[0] List</h1></center>";
			echo "<table class='Table'>
					<tr>
						<th>SNo</th>
						<th>Name</th>
						<th>Tathva ID</th>
						<th>College</th>
					</tr>";
					while($query_row = mysqli_fetch_array($query_run,MYSQLI_NUM)){
						$query1 = "SELECT Participants.Name , Participants.TathvaID , Participants.College , Participants.Department , Participants.RollNumber , Participants.Email , Participants.PhoneNumber ,Participants.Verified FROM Participants , Registration WHERE Registration.CaptainID = '$query_row[1]' AND Registration.EventCode = '$EventCode' AND Participants.TathvaID = Registration.TathvaID";
						$query_run1 = mysqli_query($mysql_conn,$query1);
						$Name = "";
						$TathvaID="";
						$College="";
						while($query_row1 = mysqli_fetch_array($query_run1,MYSQLI_NUM)){
							$Name  .= $query_row1[0].'<br>';
							$TathvaID  .= $query_row1[1].'<br>';
							$College  .= $query_row1[2].'<br>';
						}
							echo "<tr>
								<td>$query_row[0]</td>
								<td>$Name</td>
								<td>$TathvaID</td>
								<td>$College</td>
							</tr>";
					}
				echo "</table><br>";
				echo "<center><input type='button' onclick='window.print()' value='Print' class='button'/></center>";
		}
	}
?>