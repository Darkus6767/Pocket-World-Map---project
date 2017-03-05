<?php
header('Content-Type: text/html; charset=utf-8');

require_once "connect_sql.php";

$connection=new mysqli($host,$db_user,$db_password,$db_name);
if($connection->connect_errno!=0){
	echo "Error:".$connection->connect_errno;
}

mysqli_select_db($connection,$db_name) or die("Could not select database");


$pobierz = mysql_query("SELECT lat,lng,description FROM markers");

include('JSON.php');
$json = new Services_JSON();

$tablica = array();

while($dane = mysql_fetch_array($pobierz, MYSQL_BOTH))
{
	$panstwo = array(
	'lat' => (double) $dane['lat'],
	'lng' => (double) $dane['lng'],
	'location' => $dane['description']
	);
	array_push($tablica,$panstwo);
}

$wynik = $json->encode($tablica);
print($wynik);
?>