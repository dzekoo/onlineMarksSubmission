<?php
	require_once("../Includes/FeedbackLayout.php");
	require_once("define.php");
	require_once("connection.php");
	drawHeader();
	//if(isset($_POST['submitmarks']))
		//var_dump($_SESSION);
	if(!isset($_SESSION))
		session_start();
	if(isset($_POST['branch']))	
	$_SESSION['branch']=$_POST['branch'];
	$branch=$_SESSION['branch'];
	if(isset($_POST['subject']))
	$_SESSION['subject']=$_POST['subject'];
?>

<script type="text/javascript">
function home(){
	window.location.href="semester.php";
}

function grade(){
	if(parseInt(document.getElementById("totalmark").value)<30)
		document.getElementById("grade").value="D";
	else if(parseInt(document.getElementById("totalmark").value)<50)
		document.getElementById("grade").value="C";
	else if(parseInt(document.getElementById("totalmark").value)<70)
		document.getElementById("grade").value="B";
	else if(parseInt(document.getElementById("totalmark").value)<100)
		document.getElementById("grade").value="A";
	document.getElementById("grade_hid").value=document.getElementById("grade").value;
}

function totalmarks(){

	
	document.getElementById("theorymarks").value=Math.ceil(Number(document.getElementById("theorymarks").value));
	document.getElementById("practicalmarks").value=Math.ceil(Number(document.getElementById("practicalmarks").value));
	document.getElementById("sessionalmarks").value=Math.ceil(Number(document.getElementById("sessionalmarks").value));
	
	if(document.getElementById("sessionalmarks").value=="")
		document.getElementById("sessionalmarks").value=0;
	else if(parseInt(document.getElementById("sessionalmarks").value)<0)
		document.getElementById("sessionalmarks").value=0;
	else  if(parseInt(document.getElementById("sessionalmarks").value)>60)
		document.getElementById("sessionalmarks").value=60;
	if(document.getElementById("theorymarks").value=="")
		document.getElementById("theorymarks").value=0;
	else if(parseInt(document.getElementById("theorymarks").value)<0)
		document.getElementById("theorymarks").value=0;
	else  if(parseInt(document.getElementById("theorymarks").value)>60)
		document.getElementById("theorymarks").value=60;
	if(document.getElementById("practicalmarks").value=="")
		document.getElementById("practicalmarks").value=0;
	else if(parseInt(document.getElementById("practicalmarks").value)<0)
		document.getElementById("practicalmarks").value=0;
	else  if(parseInt(document.getElementById("practicalmarks").value)>40)
		document.getElementById("practicalmarks").value=40;
	document.getElementById("totalmark_hid").value = parseInt(document.getElementById("sessionalmarks").value)+
												parseInt(document.getElementById("theorymarks").value)+
												parseInt(document.getElementById("practicalmarks").value);
	document.getElementById("totalmark").value = document.getElementById("totalmark_hid").value;
	//alert(document.getElementById("totalmark_hid").value);
	grade();
}
function grades(i){
	if(parseInt(document.getElementById(5+i*i*i).value)<30)
		document.getElementById(6+i*i*i).value="D";
	else if(parseInt(document.getElementById(5+i*i*i).value)<50)
		document.getElementById(6+i*i*i).value="C";
	else if(parseInt(document.getElementById(5+i*i*i).value)<70)
		document.getElementById(6+i*i*i).value="B";
	else if(parseInt(document.getElementById(5+i*i*i).value)<100)
		document.getElementById(6+i*i*i).value="A";
	document.getElementById("grade_hid").value=document.getElementById(6+i*i*i).value;
}
function totalmarkss(i){
	
	document.getElementById(i*i*i).value=Math.ceil(Number(document.getElementById(i*i*i).value));
	document.getElementById(1+i*i*i).value=Math.ceil(Number(document.getElementById(1+i*i*i).value));
	document.getElementById(3+i*i*i).value=Math.ceil(Number(document.getElementById(3+i*i*i).value));
	
	if(parseInt(document.getElementById(3+i*i*i).value)<0)
		document.getElementById(3+i*i*i).value=0;
	else  if(parseInt(document.getElementById(3+i*i*i).value)>100)
		document.getElementById(3+i*i*i).value=100;

	if(parseInt(document.getElementById(i*i*i).value)<0)
		document.getElementById(i*i*i).value=0;
	else  if(parseInt(document.getElementById(i*i*i).value)>60)
		document.getElementById(i*i*i).value=60;
		
	if(parseInt(document.getElementById(1+i*i*i).value)<0)
		document.getElementById(1+i*i*i).value=0;
	else  if(parseInt(document.getElementById(1+i*i*i).value)>40)
		document.getElementById(1+i*i*i).value=40;

	document.getElementById(5+i*i*i).value = parseInt(document.getElementById(3+i*i*i).value)+
												parseInt(document.getElementById(i*i*i).value)+
												parseInt(document.getElementById(1+i*i*i).value);
	document.getElementById("totalmark_hid").value = document.getElementById(5+i*i*i).value;
	//alert(document.getElementById("totalmark_hid").value);
	grades(i);

}
function func(i)
{
	if(document.getElementById((2+i*i*i)+"").value!="Submit Marks"){
		document.getElementById(i*i*i).disabled=false;
		document.getElementById(1+i*i*i).disabled=false;
		document.getElementById(3+i*i*i).disabled=false;
		document.getElementById(4+i*i*i).disabled=false;
		//document.getElementById(5+i*i*i).disabled=false;
		//document.getElementById(6+i*i*i).disabled=false;
		document.getElementById(2+i*i*i).value="Submit Marks";
		return false;
	}
	else return true;
}
</script>

<?php
	
	if(isset($_POST['submitmarks'])){
		$_SESSION['row_num'] = $_SESSION['row_num']-5;
		$insert = "INSERT INTO `marksubmission_marks`(`adm_no`, `firstname`, `middlename`, `lastname`, `theorymarks`, `practicalmarks`, `subject_id`, `totalmarks`, `sessionalmarks`, `remarks`, `grade`) VALUES ('".$_POST['admn_no']."','".$_POST['firstname']."','".$_POST['middlename']."','".$_POST['lastname']."','".$_POST['theorymarks']."','".$_POST['practicalmarks']."','".$_POST['subjectid']."','".$_POST['totalmark']."','".$_POST['sessionalmarks']."','".$_POST['remarks']."','".$_POST['grade']."')";
		$insert_result = mysql_query($insert);
	}
	else if(isset($_POST['editmarks'])){
		$_SESSION['row_num']=$_SESSION['row_num']-5;
		$update ="UPDATE `marksubmission_marks` SET `theorymarks`='".$_POST['theorymarks']."',`practicalmarks`='".$_POST['practicalmarks']."',`remarks`='".$_POST['remarks']."',`totalmarks`='".$_POST['totalmark_hid']."',`sessionalmarks`='".$_POST['sessionalmarks']."',`grade`='".$_POST['grade_hid']."' WHERE adm_no='".$_POST['admn_no']."'";
		$update_result= mysql_query($update);
	}
	else if(isset($_POST['gobutton']))
	nexts();
	else if(isset($_POST['backbutton']))
	back();
	else if(isset($_GET['back']))
		header("Location:semester.php");
		

	
	
	echo "<center><h2>".$_SESSION['subject']."</h2><br>";
	echo"</br>";
	if(!isset($_SESSION['a']))
		$_SESSION['a']=0;
	if(!isset($_SESSION['row_num']))
		$_SESSION['row_num']=0;
		
		$query="SELECT sp.first_name,sp.last_name,sp.middle_name,sp.admn_no  FROM feedback_studentpersonal as sp, feedback_studentacademic as sa ,feedback_subjectdetails as sd where sd.subject_id='".$_SESSION['subject']."' and sd.branch_id='$branch' and sp.admn_no =sa.admn_no and sp.admn_no = sa.admn_no and sd.course_id=sp.course_id and sd.branch_id=sp.branch_id and sa.semester =sd.semester";
			
		
		
		$result=mysql_query($query);
		
		if(!$result)echo "error";// die ("Database access failed :" .mysql_error());
		$rows=mysql_num_rows($result);
		$_SESSION['rows']=$rows;
	
	function back(){
		if($_SESSION['a'] > 0){
			$_SESSION['a']--;
			$loop=1;
			$_SESSION['row_num'] = $_SESSION['row_num']-10;
		}
		else if($_SESSION['a'] == 0){
			$_SESSION['row_num']=0;
		}
	}
	function nexts(){
		if($_SESSION['row_num']<$_SESSION['rows']){
			$_SESSION['a']++;
			$loop=1;
		}
	}
?>

<html>

	<head>
	
	<title>Marks Submission
	</title>
	
	</head>
	
	<?php
		echo '<input type = "hidden" id = "course" />
		<input type = "hidden" id = "branch" />
		<input type = "hidden" id = "semester" />
		<input value = "subject" type = "hidden" id = "subject" />
		<input value = "session" type = "hidden" id = "session" />
		';
	?>
	<body>
			
			<div><center><input type="button" value="HOME" onclick="home()"/></center></div>
		<table id ="table_toprint">
		
			<tr>
				<th>S.No</th>
				<th id = "admn_no" width="4px">ADMNISSION NO</th>
				<th id ="name" width="4px">Name</th>
				<th id ="theorymarks" width="4px">T(60)</th>
				<th id ="practicalmarks" width="4px"> S(40)</th>
				<th id ="sessionalmarks" width="4px">P(100)</th>
				<th id ="totalmark" width="4px">TM(100)</th>
				<th id = "grade" width="4px">GRADE</th>
				<th id = "remarks" width="4px">REMARKS</th>
				<th width="4px">SUBMIT</th>
			</tr>
			<?php
		
			
			$loop=1;$flag=0;
			while(1){
				if(!$loop)
				break;
				$i = 1;
				for($j=5*$_SESSION['a']; $j< (5*$_SESSION['a'] + 5); ++$j)
				{
					if($j<mysql_num_rows($result)){
					$getmarks = "SELECT adm_no, theorymarks, grade, practicalmarks, remarks, sessionalmarks, totalmarks from marksubmission_marks where adm_no ='".mysql_result($result,$j,'admn_no')."'";
					$result_getmarks = mysql_query($getmarks);
					if(!$result_getmarks) die ("Database access failed :" .mysql_error());
					$num_rows = mysql_num_rows($result_getmarks);
					$loop=0;
						echo "<form action='marks.php' name='form1' id='form1' method='post'>";
						
					if($_SESSION['row_num']<$rows){
						$flag=1;
						$_SESSION['row_num']++;
						echo"<tr>";
							echo "<input type='hidden' value='".$_SESSION['subject']."' name='subjectid'/>";
							echo "<input type='hidden' name='grade_hid' id='grade_hid'  value='0' />";
							echo "<input type='hidden' name='totalmark_hid' id='totalmark_hid' value='0' />";
							echo "<input type='hidden' value='$branch' name='branch'/>";
							echo "<td name = 'serialnumber'>".$i."</td>";
							$i = $i +1;
							echo "<td><input type='hidden' value='".mysql_result($result,$j,'admn_no')."' name='admn_no'/>". mysql_result($result,$j,'admn_no')."</td>";
							echo "<td><input type='text' value='".mysql_result($result,$j,'first_name')." ".mysql_result($result,$j,'middle_name')." ".mysql_result($result,$j,'last_name')."' name='firstname'/></td>";
							/*echo "<td><input type='hidden' value='".mysql_result($result,$j,'middle_name')."' name='middlename'/>".mysql_result($result,$j,'middle_name')."</td>";
							echo "<td><input type='hidden' value='".mysql_result($result,$j,'last_name')."' name='lastname'/>".mysql_result($result,$j,'last_name')."</td>";					*/
							echo "<td>";if($num_rows){$arow=mysql_fetch_assoc($result_getmarks);echo "<input type='integer' value='".$arow['theorymarks']."' disabled='disabled' id='".(($j+1)*($j+1)*($j+1))."' name='theorymarks'/ onblur='totalmarkss(".($j+1).")'>";}else echo "<input type='integer' name='theorymarks' id='theorymarks' onblur='totalmarks()'/></td>";
							echo "<td>";if($num_rows)echo "<input type='integer'  value='".$arow['practicalmarks']."' disabled='disabled' id='".(1+(($j+1)*($j+1)*($j+1)))."' name='practicalmarks' onblur='totalmarkss(".($j+1).")'/>";else echo"<input type='integer' name='practicalmarks' id='practicalmarks' onblur='totalmarks()'/></td>";
							echo "<td>";if($num_rows)echo "<input type='integer'  value='".$arow['sessionalmarks']."' disabled='disabled' id='".(3+(($j+1)*($j+1)*($j+1)))."' name='sessionalmarks' onblur='totalmarkss(".($j+1).")'/>";else echo"<input type='integer' name='sessionalmarks' id='sessionalmarks' onblur='totalmarks()'/></td>";
							echo "<td>";if($num_rows) echo "<input type='integer' value='".$arow['totalmarks']."' disabled='disabled' id='".(5+(($j+1)*($j+1)*($j+1)))."' readonly='' name='totalmark'/>";else echo"<input type='text' name='totalmark' id='totalmark' readonly=''/></td>";
							echo "<td>";if($num_rows)echo "<input type='text' value='".$arow['grade']."'  id='".(6+(($j+1)*($j+1)*($j+1)))."' name='grade' readonly=''/>";else echo"<input type='text' name='grade' id='grade'  readonly=''/></td>";
							echo "<td>";if($num_rows)echo "<input type='text' value='".$arow['remarks']."' disabled='disabled' id='".(4+(($j+1)*($j+1)*($j+1)))."' name='remarks'/>";else echo"<input type='text' name='remarks' /></td>";
							echo "<td>";if($num_rows) echo "<input type='submit' name='editmarks' value='Edit Marks' onclick='return func(".($j+1).")' id='".(2+(($j+1)*($j+1)*($j+1)))."'>";else echo"<input type='submit' name='submitmarks' value='Submit Marks' /></td>";
						echo "</tr>";
  						echo "</form>";
					}
					else
						break;
					}
					else $loop=0;
				}
			if($flag)
			echo "</table><div><center><form action='' method='post'><input type='submit' name='backbutton' value='back'>"; if($_SESSION['row_num']<$_SESSION['rows']){ echo "<input type='submit' name='gobutton' value='Next'>";} else{ echo "<input type='button' value='Next'>";} echo "</form></center></div>";
			}
			?>
		</table>
		<br />
		<form action="update.php"  method="post">  <input type="submit"  value="FINALIZE" name="final" /></form>
	<button id="printBtn">Print this page</button>

	<script>
	function myFunction()
	{
	alert();
	//var toprint = "<table><tr>"+document.getElementById("admn_no")+"</tr>"
	var toprint = document.getElementById("table_toprint");
	var text = "<center><table><tr><td><h1>INDIAN SCHOOL OF MINES,DHANBAD</h1></td></tr>";
	text = text + "<tr><td><h2>Assesment of Marks/Grades</h2></td></tr>";
	text = text + "<tr><td><h2>"+document.getElementById("course").value + "(";
	text = text + document.getElementById("branch").value + ")</h2></td></tr>";
	text = text + "<tr><td>"+document.getElementById("semester").value + document.getElementById("session").value;
	text = text + "</td></tr></table></center>" + toprint.outerHTML;
	//alert(text);
	newWin = window.open("");
	newWin.document.write(text);
	newWin.print();
	newWin.close();
	//document.innerHTML = toprint;
	}
	</script>	
	
	</center>
	

	</body>
	
	<?php
	if(isset($connection)){
	mysql_close($connection);
	}
	drawFooter();
	?>
<style type="text/css" media="print">
			.print-content {
				display: block;
				width: parent;
				height: auto;
				margin: auto;
				position: relative;
				top: 0;
				left: 0;
			}
		</style>	
		<script type="text/javascript">
		var pr = document.getElementById("printBtn");
		$("#printBtn").click(function() {
			$(".-feedback-search-bar, .-feedback-navbar, .-feedback-footer").hide();
			$(".-feedback-content").addClass("print-content");
			$(this).hide();
			window.print();
			$(".-feedback-search-bar, .-feedback-navbar, .-feedback-footer").show();
			$(".-feedback-content").removeClass("print-content");
			$(this).show();

		});
	</script>	

</html>
