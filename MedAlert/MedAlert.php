<?php

$error='Sorry, we\'re expecting some connection errors';
mysql_connect('mysql6.000webhost.com','a7256403_iot','saurabh123') or die(mysql_error());
mysql_select_db('a7256403_iot') or die(mysql_error($error)); 

$timezone = new DateTimeZone("Asia/Kolkata" );

$date = new DateTime();

$date->setTimezone($timezone );

$t=$date->format( 'His' );



?>

<!--<meta http-equiv="refresh" content="5">-->

<?php

if (isset($_GET["w1"])){
	$val=$_GET['w1'];


	if(mysql_result(mysql_query("SELECT * FROM `flag` "), 0)==0){
	
	
	if($val>1000 && $t<144000){
		
		$remark="Everything is fine and awesome. Just like me.";
		mysql_query("INSERT INTO `ir` (`value`,`time`,`remark`) VALUES ($val,$t,'$remark')");

	}
	if($t>144000){
		if(mysql_result(mysql_query("SELECT * FROM `ir` WHERE `value`<'1000' && `time`>'14:40:00'"), 0)>=1){
			$remark1="You\'ve taken the medicine for the day";
			mysql_query("INSERT INTO `ir` (`value`,`time`,`remark`) VALUES ($val,$t,'$remark1')");
			
			mysql_query("UPDATE `flag` SET `value`=1 ");

			//mail(+ve)
			
		}
		else{
			$remark3="Oh man! you have not taken your medicine for the day.";
			mysql_query("INSERT INTO `ir` (`value`,`time`,`remark`) VALUES ($val,$t,'$remark3')");
			//mail(-ve);
		}
	}
	if($val<1000 && $t<144000){
		$remark2="Something is wrong with the device.";
		mysql_query("INSERT INTO `ir` (`value`,`time`,`remark`) VALUES ($val,$t,'$remark2')");
	}
	}
	
	
	sleep(60);
	

	header('Location: http://10.49.2.249');
}

else{
	echo "no result";
	$remark4="Error in the device. Contact the Admin";

	//this value not entered because val does not come. error and hence to be corrected.
	mysql_query("INSERT INTO `ir` (`value`,`time`,`remark`) VALUES (0,$t,'$remark4')");
}

?>		