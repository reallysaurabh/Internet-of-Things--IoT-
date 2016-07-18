<?php
   	include("connect.php");
   	
   	$link=Connection();


if ( isset($_GET['val']) && isset($_GET['id'])  ) {
	

	$temp1=$_GET['val'];
	$temp2=$_GET['id'];
	$temp3=date("d/m/Y H:i:s");


	if( $temp1==0 ){
		$remark="inactive";
	}else if($temp1==1){
		$remark="active";
	}

	$query = "INSERT INTO `val` (`val`,`CA`,`timestamp`,`remark`)   VALUES ('$temp1', '$temp2', '$temp3','$remark')"; 
	mysql_query($query,$link);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
   	
   	


}else{

	$temp1="NA";
	$temp2="NA";
	$temp3=date("d/m/Y H:i:s");
	$remark="Technical Fault";

	$query = "INSERT INTO `val` (`val`,`CA`,`timestamp`,`remark`)   VALUES ('$temp1', '$temp2', '$temp3','$remark')"; 
	mysql_query($query,$link);

	echo "Data not received.";



}






?>


