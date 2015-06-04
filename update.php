
<?php
	require_once("../Includes/FeedbackLayout.php");
	require_once("define.php");
	require_once("connection.php");
	drawHeader();
	if(!isset($_SESSION))
		session_start();
	
	$subject=$_SESSION['subj_id'];
	
	if(isset($_POST['final']))
	{
		$query="SELECT * FROM marksubmission_marks WHERE subject_id='$subject' ";
		
		
		$result=mysql_query($query);
                                                          
		if(!$result)
		{
		echo "error";
			die ("Database access failed :" .mysql_error());
			}
	
		while($row=mysql_fetch_assoc($result))
		{
					
					
			$insert = "INSERT INTO failstudentlist (`adm_no`, `stu_name`, `theory`, `practical`, `subje_code`,`sessional`,`grade`,`totalmarks`,`remarks`) VALUES 
			('".$row['adm_no']."' , '".$row['firstname'] ."','".$row['theorymarks']."','".$row['practicalmarks']."','".$row['subject_id']."','".$row['sessionalmarks']."','".$row['grade']."','".$row['totalmarks']."','".$row['remarks']."')";
			$result1 = mysql_query($insert);
			if(!$result1)
			{
				die('invalid query3:'.mysql_error());
			}

		}
	}	
		
?>

<html>

	<head>
		
		<title>UPDATE</title>
	
	</head>
	
	<body>
		
		<?php echo '<div class="notification success"> You have successfully enetered marks of all the students .</div>'; ?>
		
		<?php echo '<div class="notification success"> To enter marks of other subjects click on online marks submission again.</div>'; ?>
		
		<?php echo '<div class="notification success"> Press logout button to exit from the feedback system.</div>'; ?>
	
	</body>
	
	<?php
	if(isset($connection)){
	mysql_close($connection);
	}
	drawFooter();
	?>
