<?php

$error='Sorry, we\'re expecting some connection errors';
mysql_connect('mysql6.000webhost.com','a7256403_iot','saurabh123') or die(mysql_error());
mysql_select_db('a7256403_iot') or die(mysql_error($error)); 


if (isset($_GET["w1"])){
	$val=$_GET['w1'];

	if($val>1000){
		$remark="Gas leakage detected. Rush to your supply source.";
		mysql_query("INSERT INTO `gas` (`value`,`message`) VALUES ($val,'$remark')");
	}
	else{
		$remark1="Nothing to worry. Gas leakage is under safety limit.";
		mysql_query("INSERT INTO `gas` (`value`,`message`) VALUES ($val,'$remark1')");
	}

	sleep(60);
	header('Location: http://10.36.2.234');

}
else{
	$remark4="Error in the device. Contact the Admin";
	mysql_query("INSERT INTO `gas` (`value`,`message`) VALUES ($val,'$remark4')");
}



?>

