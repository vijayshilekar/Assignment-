<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'demo');
define('DB_USER','root');
define('DB_PASSWORD','root');

$con1 = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,true);
if(!$con1) {
    die("Not connected: ". mysql_error());
}else{
    mysql_select_db(DB_NAME, $con1);
}

if (isset($argv[1])) 
     $argv[1];
$handle = fopen( $argv[1], "r");




if ($handle !== FALSE) {
	
	fgetcsv($handle);   

   	while (($data = fgetcsv($handle,1000, ",")) !== FALSE) {
		
		$c=0;	
		foreach($data as $value)
		{
	
			$col[$c]=$value;
			$c++;
		}										
	
	
		$var1=date("Y-m-d", strtotime($col[0]));

		
			$query2="insert into Attendance(Employee_code,Date,card_id,In_Time,Out_Time,Work_hours) values('$col[2]','$var1','$col[3]','$col[4]','$col[5]','$col[6]')";
			$s5 = mysql_query($query2, $con1 );
		
	
	}
    	fclose($handle);


}

echo "File data successfully imported to database!!";

mysql_close($con1);
?>
