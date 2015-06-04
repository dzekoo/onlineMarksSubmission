<script type="text/javascript">
var a=0;
function func()
{
	a++;
}
function funct()
{
	if(a>=1)
	return true;
	else
	return false;
}
</script>
<?php
	//require_once("../Includes/FeedbackLayout.php");
	require_once("define.php");
	require_once("connection.php");
	//drawHeader();
	if(!isset($_SESSION))
		session_start();
	
	
?>

<?php
		$query="SELECT branch_id FROM feedback_subjectdetails WHERE  subject_id='".$_GET['b']."'";
				
		$subj_id=mysql_query($query);
		
		if(!$subj_id) die ("Database access failed :" .mysql_error());
		
		
	
			//echo'<form method="post" action="marks.php">';
			
				echo "<center><br><h1><b>BRANCHES</b></h1></center>";
				while($row=mysql_fetch_assoc($subj_id))
				{
					$sid=$row['branch_id'];
					
					$query_subject_name = "SELECT branch_name FROM feedback_branch WHERE branch_id = '$sid'";
					$subj_name = mysql_query($query_subject_name);
					if(!$subj_name)
					{
						die('invalid query3:'.mysql_error());
					}
					$sub_name = mysql_fetch_assoc($subj_name);
					$subject = $sub_name['branch_name'];
					echo"<center><h3><br>";
					echo $subject." (".$sid.")"."<input type='radio' name='branch' value='".$sid."' onchange='func()'/>";
					echo "<div name = 'branch' style='display:none;'></div>";
					echo"</h3>";
				}
			//	echo'</form><center>';
		?>
			
	
	
	
	</body>

	<?php
	if(isset($connection)){
	mysql_close($connection);
	}
	//drawFooter();
	?>


</html>
