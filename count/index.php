<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tathva Count</title>
<link href="style.css" rel="stylesheet" />
</head>

<body>
<div>
	
<?php
	require '../connectDatabase.php';
	$query = "SELECT * FROM Participants WHERE Verified=1";
	$query_run = mysqli_query($mysql_conn,$query);
	$Verified=mysqli_num_rows($query_run);
//	echo "verified ".$verified;

	$query = "SELECT * FROM Participants";
	$query_run = mysqli_query($mysql_conn,$query);
	$Total=mysqli_num_rows($query_run);
//	echo "Total ".$Total;

?>	
	
</div class="main_back">
	<h1 class="tathva_heading">tathva'15 Reg</h1>

	<h1 class="box"><span></span><?php echo $Verified; ?>/<?php echo $Total ;?></h1>
</body>
</html>