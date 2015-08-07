<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'demo');
define('DB_USER','root');
define('DB_PASSWORD','root');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT * FROM employee where Employee_Name like '".$term."%' order by Employee_Name ");

 $json=array();
 
    while($student=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $student["Employee_Name"],
                    'label'=>$student["Employee_Name"]
                        );
    }
 
 echo json_encode($json);
 
?>
