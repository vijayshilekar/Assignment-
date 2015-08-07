<html>
<haed><title> Attendance</title>
<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		var col= table.getElementsByTagName("td"); 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
				
				
			}else{
				rows[i].className = "oddrowcolor";
				
			}      
		}
	}
}
window.onload=function(){
	altRows('alternatecolor');
}
</script>

<script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

        <script type="text/javascript">
                $(document).ready(function(){
                    $("#name").autocomplete({
                        source:'autocomplete.php',
                        minLength:1
                    });
                });
        </script>

<style type="text/css">
table.altrowstable {
	
	font-size:11px;
	color:#333333;
	border-width: 5px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
.oddrowcolor{
	background-color:#d4e3e5;
}
.evenrowcolor{
	background-color:#c3dde0;
}
.red{
background-color: #ff0000;
}
</style>




</head>
<body>
<p>WELCOME</p>
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'demo');
define('DB_USER','root');
define('DB_PASSWORD','root');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
echo "successfuly connected....";
$q="select Employee_code,Employee_name from employee ORDER BY Employee_name";
echo "<br>";
$s = mysql_query($q, $con);

?>


<form method="post" action="Att.php">
<label>EMPLOYEE NAME:</label>
<select id="Select1" name="ResultName" tabindex="2"  title="Select a Employee code" required >
<option value="">SELECT EMPLOYEE NAME</option>
<option value="all">ALL</option>
        
<?php
while ($row = mysql_fetch_array($s))
	{
 
 	
?>

<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
 <?php 
}

?>
</select>

<!--<input type="submit" value="VIEW"><br /> 
 Name : <input type="text" id="name" name="name" />-->
<input type="submit" value="VIEW"><br />
</form>

<form method="post" action="Att.php">

Name : <input type="text" id="name" name="name" />

<input type="submit" value="VIEW">
</form>



<?php

$option = isset($_POST['ResultName']) ? $_POST['ResultName'] : false;
   if ($option=="all") {
	$v=$_POST['ResultName'];
	//echo $v;
	$q="select e.Employee_name,a.Date,a.card_id,a.In_Time,a.Out_Time,a.Work_hours from Attendance a, employee e where a.Employee_code=e.Employee_code ORDER BY Date,e.Employee_name ASC";
	$s= mysql_query($q, $con );
 
   } else if($option!="all")
	{
	$v=$_POST['ResultName'];
	$q1="select Employee_name from employee where Employee_code='$v'";
	$s1=mysql_query($q1, $con);
	$q="select Date,card_id,In_Time,Out_Time,Work_hours from Attendance where Employee_code='$v' ORDER BY Date ASC";
	
	$s2= mysql_query($q, $con );
	}
	else {
     echo "task option is required";
     exit; 
   }

$new=isset($_POST['name']) ? $_POST['name'] : false;
echo $new;
if($new)
{
$q2="select Employee_code from employee where Employee_Name='$new'";
	$s3=mysql_query($q2, $con);

	while($row2 = mysql_fetch_array($s3))
	$v=$row2[0];
	echo "-".$v;
	$q1="select Employee_name from employee where Employee_code='$v'";
	$s1=mysql_query($q1, $con);
	$q="select Date,card_id,In_Time,Out_Time,Work_hours from Attendance where Employee_code='$v' ORDER BY Date ASC";
	
	$s2= mysql_query($q, $con );
}

//$q="select Date,card_id,In_Time,Out_Time,Work_hours from Attendance where Employee_code='$v' ORDER BY DAte ASC";
//$s= mysql_query($q, $con );
?>
<table class="altrowstable" id="alternatecolor" align="center">
<tr>
<td>EMPLOYEE NAME</td>
<td>DATE</td>
<td>CARD ID</td>
<td>In Time</td>
<td>Out Time</td>
<td>Work Hours</td>
</tr> 
<?php
$less=false;
while ($row = mysql_fetch_array($s))
	{	
	
	//$var=$row[0]
?>

<tr>
<td><?php echo $row[0];?></td>
<td><?php echo $row[1];?></td>
<td><?php echo $row[2];?></td>
<td><?php echo $row[3];?></td>
<td><?php echo $row[4];?></td>
<td    <?php if($row[5]<8){$less=true;} else $less=false; if($less) {?>class="red"<?php } ?>> <?php echo $row[5];?></td>
</tr>

<?php 
}
?>
<!--</table>



<!--<table class="altrowstable" id="alternatecolor">
<tr>
<td>EMPLOYEE NAME</td>
<td>DATE</td>
<td>CARD ID</td>
<td>In Time</td>
<td>Out Time</td>
<td>Work Hours</td>
</tr> -->
<?php
$less=false;
while ($row = mysql_fetch_array($s2))
	{	
$row1 = mysql_fetch_array($s1)	
	
?>

<tr>
<td><?php echo $row1[0];?></td>
<td><?php echo $row[0];?></td>
<td><?php echo $row[1];?></td>
<td><?php echo $row[2];?></td>
<td><?php echo $row[3];?></td>
<td <?php if($row[4]<8){$less=true;} else $less=false; if($less) {?>class="red"<?php } ?>>    <?php echo $row[4];?></td>
</tr>

<?php 
}
?>
</table>



<?php
mysql_close($con1);
?>
</body>
</html>
