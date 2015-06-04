<?php
	if(!isset($_SESSION))
		session_start();
		
	require_once("../Includes/FeedbackLayout.php");
	drawHeader();
	if(isset($_SESSION['SESS_USERNAME']) && ($_SESSION['SESS_AUTH']== "FT" || $_SESSION['SESS_AUTH']== "FA"))
		header("Location:semester.php");
	else
		echo '<div class="notification error">Sorry!, You are not allowed to enter here.</div>';
	drawFooter();
?>
