<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

require_once "connect_sql.php";

$connection=new mysqli($host,$db_user,$db_password,$db_name);
if($connection->connect_errno!=0){
	echo "Error:".$connection->connect_errno;
}

echo $_POST['sql_id'];

$sql=" DELETE FROM markers WHERE id='".$_POST['sql_id']."'";






if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
	header('Location: ../index.php');
}
//echo " DELETE FROM markers WHERE lat='".$_POST['lat']."' and g_long='".$_POST['lon']."' and user_id='".$_POST['user_id']."'";

die();
?>