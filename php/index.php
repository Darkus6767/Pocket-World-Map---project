<?php
	session_start();
	
	if((isset($_SESSION['login']))&&($_SESSION['login']==true))
	{
		header('Location: /PWM/index.html');
		exit();
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="uft-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

<link rel="stylesheet" href="style_login.css" type="text/css" />

</head>


<body>

<div id="container">

<form action="zaloguj.php" method="post">
 
  Login: <br /> <input type="text" name="login" /> <br />
  Password: <br /> <input type="password" name="password" /> <br /> <br />
  <input type="submit" value="Log In" />
  
  </form>
  
  <form action="rejestracja.php" method="post">
  <input type="submit" value="Sing Up"/>
  </form>
  </div>
  
  <?php
  if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
  ?>
  
  </body>