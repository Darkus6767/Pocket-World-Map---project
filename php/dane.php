<?php


require_once "connect_sql.php";
  
$connection=new mysqli($host,$db_user,$db_password,$db_name);

 if($connection->connect_errno!=0){
	echo "Error:".$connection->connect_errno;
}

	
mysqli_select_db($connection,$db_name) or die("Could not select database");

$sql = "SELECT id,lat,g_long,description,place,Icon,user_id FROM markers ORDER BY id";

$connection->query($sql);

$result =  $connection->query($sql);

include('JSON.php');
$json = new Services_JSON();

$tablica = array();

while($row = $result->fetch_assoc())
{
	$panstwo = array(
	'id' => $row['id'],
	'description' => $row["description"],
	'lat' => (float) $row["lat"],
	'g_long' => (float) $row["g_long"],
	'place' => $row["place"],
	'Icon' => $row["Icon"],
	'user_id' => $row["user_id"]
	);
	array_push($tablica,$panstwo);
}

$wynik = $json->encode($tablica);
print($wynik);
?>
