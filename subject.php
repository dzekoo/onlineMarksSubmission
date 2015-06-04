
<?php
	require_once("../Includes/FeedbackLayout.php");
	require_once("define.php");
	require_once("connection.php");
	drawHeader();
	if(!isset($_SESSION))
		session_start();
	
	
?>
<html>
	<?php


	
	if(isset($_SESSION['session'])){
	$session=$_SESSION['session'];
	$session_year=$_SESSION['session_year'];
	$faculty_id=$_SESSION['SESS_USERNAME'];
	}
	else
		header("Location:semester.php");
	
	?>
	<head>
	
		<title>
		Select Subject 
		</title>
	
	</head>

	<body>
		<?php
		$query="SELECT subject_id FROM feedback_subjectfaculty WHERE  emp_id=$faculty_id AND session='$session'	AND session_year='$session_year'";
				
		$subj_id=mysql_query($query);
		
		if(!$subj_id) die ("Database access failed :" .mysql_error());
		$rows=mysql_num_rows($subj_id);
		
		if($rows==0)
		{
			echo '<div class="notification error">Sorry!, You do not teach any subject in this semester and year.</div>';
			
			echo '<div class="notification error">Press Back button to go to the previous page</div>';
			
			echo'<form method="GET" action="marks.php"><pre>';
			
			echo'<input type="submit" name="back" value="back" />';
			echo'</pre></form>';
		}
		
		
	
		else
		{
	
			echo'<form method="post" action="marks.php">';
			
				
				while($row=mysql_fetch_assoc($subj_id))
				{
					$sid=$row['subject_id'];
					
					$query_subject_name = "SELECT subject_name FROM feedback_subject WHERE subject_id = '$sid'";
					$subj_name = mysql_query($query_subject_name);
					if(!$subj_name)
					{
						die('invalid query3:'.mysql_error());
					}
					$sub_name = mysql_fetch_assoc($subj_name);
					$subject = $sub_name['subject_name'];
					echo"<center><h3><br>";
					echo $subject." (".$sid.")"."<input type='radio' name='subject' value='".$sid."' onclick='showBranch(this.value)'/>";
					echo"</h3>";
				}
				
		
			
		?>
			
			<div class="get_branch" id="get_branch" name="get_branch">
			
			</div>
	
	<?php 
	
	echo'<input type="submit" name="submit"/>';
				echo'</form><center>';
	
	}
	?>
<script type="text/javascript">
function showBranch(str){
	var xmlhttp;    
	if (str==""){
		document.getElementById("txtHint").innerHTML="";
		return;
	}
  
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
  
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){		
			document.getElementById("get_branch").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","branch.php?b=" + str,true);

	xmlhttp.send();
}
</script>

	</body>

	<?php
	if(isset($connection)){
	mysql_close($connection);
	}
	drawFooter();
	?>


</html>
