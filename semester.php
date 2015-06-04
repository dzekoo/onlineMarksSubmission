<script type="text/javascript">
var a=0;var b=0;
function funct()
{
	if(a>=1 && b>=1)
		return true;
	return false;
}
function funca()
{
	a++;
}
function funcb()
{
	b++;
}

</script>
<?php
	require_once("../Includes/FeedbackLayout.php");
	require_once("define.php");
	require_once("connection.php");
	drawHeader();
	if(!isset($_SESSION))
		session_start();
	if(isset($_SESSION['a']))
		unset($_SESSION['a']);
	if(isset($_SESSION['row_num']))
		unset($_SESSION['row_num']);
	if(isset($_SESSION['rows']))
		unset($_SESSION['rows']);
	if(isset($_SESSION['subj_id']))
		unset($_SESSION['subj_id']);
	?>


<html>
	<?php
	/*
	$month=date('M');
	$session_year=date(' Y');
	
	if($month=='Dec'	||$month=='Aug' ||$month=='Sept' ||$month=='Oct' ||$month=='Nov' ||$month=='Jan' )
	{
		$session='MONSOON';
		}
	else
	{
		$session='WINTER';
		}
		*/
	$session='WINTER';
	$session_year=2012;
	
	$_SESSION['session']=$session;
	
	$_SESSION['session_year']=$session_year;
		
 
	?>

	
	
	<head>
	
	<title>Online Marks Submission</title>
	
	</head>
	

	<body>
			
			<center>
			<h1>Online Marks Submission</h1><hr><br>
			
			<h2><a href="subject.php">ENTER THE MARKS OF THE  <?php echo"$session  ";  echo"SEMESTER ";echo"$session_year"; ?></a></h2>
			
			<h2><a href="previous.php">VIEW PREVIOUSLY ENTERED MARKS</a>
			
			
			</center>
		
	
	
	</form>



	</body>
	
	<?php
	if(isset($connection)){
	mysql_close($connection);
	}
	drawFooter();
	?>

</html>
