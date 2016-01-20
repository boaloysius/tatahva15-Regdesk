<?php
	// Purpose	: Display team of a candidate for an event
	// Input	:Tathva ID , Event ID as get

?>

<?php require_once('connectDatabase.php');
	function string_prepare($string){
		global $mysql_conn;
		return trim(mysqli_real_escape_string($mysql_conn,$string));
	}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	

	//$TathvaID="TID10001";
	//$EventID="CS003";
	$TathvaID=$_GET['TathvaID'];
	$EventID=$_GET['EventID'];
	
	
	$query ="Select * from Registration ";
	$query.="WHERE ";
	$query.="TathvaID ='$TathvaID' AND ";
	$query.="EventCode ='$EventID'";

	//echo $query."<br>";

	$query_run = mysqli_query($mysql_conn,$query);
	if(mysqli_num_rows($query_run)<0){die("Not Found");}
	$row=mysqli_fetch_assoc($query_run);
	$CaptainID=$row["CaptainID"];
	
	//echo $CaptainID."<br>";
	
	$query ="Select ";
	$query.="Participants.TathvaID as TathvaID ,";
	$query.="Participants.Name as Name ,";
	$query.="Participants.PhoneNumber as PhoneNumber ,";
	$query.="Participants.College as College ,";
	$query.="Registration.Participating as Participating ,";
	$query.="Events.EventName as EventName ";
	$query.="from Registration,Participants,Events ";
	$query.="WHERE ";
	$query.="Participants.TathvaID=Registration.TathvaID and ";
	$query.="Registration.CaptainID='$CaptainID' and ";
	$query.="Registration.EventCode='$EventID' and ";
	$query.="Events.EventCode='$EventID'";

	//echo $query."<br>";


	$query_run = mysqli_query($mysql_conn,$query);
	$query1_row=mysqli_fetch_assoc($query_run);
?>
	<h1>Team of <?php  echo $TathvaID; ?> for <?php  echo $query1_row['EventName'];?></h1>

	<?php

	$query_run = mysqli_query($mysql_conn,$query);
	if(mysqli_num_rows($query_run)<0){die($query);}
?>
	<table>
    	<tr class="title">
        	<td>TathvaID</td>
            <td>Name</td>
            <td>Contact</td>
            <td>College</td>
            <td>Event Confirmation</td>
        </tr>
<?php
	while($row=mysqli_fetch_assoc($query_run)){
	?>
    		<tr <?php if($row['TathvaID']==$CaptainID){echo "class=\"captain\"";} ?>>
            	<td><?php echo $row['TathvaID']; ?></td>
            	<td><?php echo $row['Name']; ?></td>
             	<td><?php echo $row['PhoneNumber']; ?></td>
              	<td><?php echo $row['College']; ?></td>
             	<td><?php if($row['Participating']){echo "Confirmed";}else{echo 'Not confirmed';} ?></td>        
            </tr>
	<?php }?>

	</table>
<?	
?>
<style>
	body{
		background:#f4f4f4;		
	}
	table{
		width:100%;
		border:2px solid #ccc;	
	}
	
	tr{	height:40px;
		}
	td{	border:1px solid #ccc;
		font-size:18px;
		}
	.title td{
		font-size:30px;
		color:#333;
		font-weight:bold;
		color:#F30;	
	}
	
	.captain{
		color:#F00;	
	}
</style>

</body>
</html>

