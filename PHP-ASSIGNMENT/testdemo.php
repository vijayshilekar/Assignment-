<?php
$ip=array();
$mail=array();
$url=array();


if (isset($argv[1])) 
     $argv[1];
$file_handle = fopen( $argv[1], "r");

	while (!feof($file_handle) ) {

	$line_of_text = fgets($file_handle);
	$pieces = explode(" ", $line_of_text);


	$temp=mailfun($pieces);
	array_push($mail,$temp);


	$temp1=ipfun($pieces);
	array_push($ip,$temp1);


	$temp2=urlfun($pieces);
	if(!empty($temp2))
	array_push($url,$temp2);
	}
function mailfun($pieces)
{
	$count=sizeof($pieces);

	for($i=0;$i<$count;$i++)
	{	
	$mailvar = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $pieces[$i]);

	if($mailvar)
		{
	
			$var=$pieces[$i];
			return $var;
	
		}	
	}
}


function ipfun($pieces)
{
	$count=sizeof($pieces);

	for($i=0;$i<$count;$i++)
	{	
	$ipvar =preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])'.'\.){3}(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]?|[0-9])$/', $pieces[$i]);
		if($ipvar)
		{
	
			$var=$pieces[$i];
			return $var;
	
		}
	}
}

function urlfun($pieces)
{
	$count=sizeof($pieces);

	for($i=0;$i<$count;$i++)
	{	
	$urlvar=preg_match("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i", $pieces[$i]);
		if ($urlvar) {

			$var1=$pieces[$i];
			return $var1;
			
		}
	}
}
$cnt=sizeof($mail);
echo "MAILS:\n";
for($i=0;$i<$cnt;$i++)
{
echo $mail[$i];
}
$cnt1=sizeof($ip);
echo "IP:\n";
for($i=0;$i<$cnt;$i++)
{
echo $ip[$i];
}
$cnt2=sizeof($url);
echo "URL:\n";
for($i=0;$i<$cnt2;$i++)
{
echo $url[$i]."\n";
}
echo "\n";
?>
