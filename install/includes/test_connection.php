<?php

$data = array(
	'hostname' =>  $_POST['test_hostname'],
	'username' =>  $_POST['test_username'],
	'password' =>  $_POST['test_password'],
	'database' =>  $_POST['test_database'],
);

$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);
$err_msg =  mysqli_connect_error($mysqli);
//return as object since we use mysqli
if(!$mysqli->connect_error)
{
	echo true;
}

if($mysqli->connect_error)
{	
	echo '<hr>Hint: <code>'.$err_msg.'</code>';
	echo false;
}
