<?php
	session_start();

	function string_prepare($string){
		global $mysql_conn;
		return trim(mysqli_real_escape_string($mysql_conn,$string));
	}
	
	function check_log(){
		$username = " ".$_SESSION['username'];
		if(strcmp($username," ") == 0){?>
		
			<script>window.location.href="action_post.php"</script><?php
		}	
		return $username;
	}
	
	$username=check_log();
	

?>