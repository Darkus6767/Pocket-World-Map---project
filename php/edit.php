<?php  

session_start();

require_once "connect_sql.php";

$connection=new mysqli($host,$db_user,$db_password,$db_name);
if($connection->connect_errno!=0){
	echo "Error:".$connection->connect_errno;
}

$sql = "UPDATE markers SET description='".$_POST['edit_name']."' WHERE ID=".$_POST['edit_id']."		";

echo $sql;

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
	header('Location: ../index.php');
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

?>