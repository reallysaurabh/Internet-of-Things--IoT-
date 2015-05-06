<?php

$error='Sorry, we\'re expecting some connection errors';
mysql_connect('mysql6.000webhost.com','a7256403_iot','saurabh123') or die(mysql_error());
mysql_select_db('a7256403_iot') or die(mysql_error($error)); 

mysql_query("TRUNCATE TABLE  `ir`");
mysql_query("UPDATE `flag` SET `value`=0 ");

?>