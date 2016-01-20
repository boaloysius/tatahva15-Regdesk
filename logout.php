<?php
	session_start();
	session_unset();
	session_destroy();
	header("Location:action_post.php");
?>