<?php

/**This is the main login page of tathva15 ondesk registration 
 */

	require 'connectDatabase.php';
	$username=trim(mysqli_real_escape_string($mysql_conn,strtolower($_POST["User_id"])));
	$password=md5(trim(mysqli_real_escape_string($mysql_conn,strtolower($_POST["passwd"]))));
	if(!empty($_POST["log_in"]))
	{
		$query="SELECT * FROM ADMIN_USER where username='$username' AND password='$password'";
		$query_run=mysqli_query($mysql_conn,$query);
		$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['superadmin']=$query_row[2];
		if(mysqli_num_rows($query_run)==0)
		{
			echo "<div id='extra' onclick='hide_extra()'>Invalid User</div>";
		}
		else
		{
			header('Location: menu.php');
		}
	}
	else {
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="AJ/main.css">
		<script src="AJ/jquery.js"></script>
		<script src="AJ/main.js"></script>
		<title>Registration Login</title>
	</head>
	<body>
		<div id="page">
			<div id="alerter" draggable="true">
				<form action="action_post.php" method="post">
					<div class='labelo'>Username:</div>
					<input class="them_boxes" type="text" name="User_id">
					<div class='labelo'>Password:</div>
					<input class="them_boxes" type="password" name="passwd">
					<br>
					<input class="button" type="submit" name="log_in" value="Log in">
				</form>
			</div>
			<img id="tathva" src="AJ/tathva.png">
		</div>
	</body>
</html>
