<?php
	require 'connectDatabase.php';
	$EventCode = trim(mysqli_real_escape_string($mysql_conn , strtoupper($_POST['EventCode'])));
	$query = "SELECT Price FROM Events WHERE EventCode = '$EventCode'";
	$query_run = mysqli_query($mysql_conn,$query);
	$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
	echo json_encode($query_row[0]);
?>