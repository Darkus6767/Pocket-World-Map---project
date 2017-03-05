<?php
	session_start();
	
	if(!isset($_SESSION['udanarejestracja']))
	{
		
		header('Location: zaloguj.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
	
	//usuwamy zmienne sluzace do zapamietnia wartosci
	if(isset($_SESSION['fr_nick']))unset($_SESSION['fr_nick']);
	if(isset($_SESSION['fr_email']))unset($_SESSION['fr_email']);
	if(isset($_SESSION['fr_password1']))unset($_SESSION['fr_password1']);
	if(isset($_SESSION['fr_password2']))unset($_SESSION['fr_password2']);
	if(isset($_SESSION['fr_regulamin']))unset($_SESSION['fr_regulamin']);
	
	//usuwanie bledow rejstracji
	if(isset($_SESSION['e_nick']))unset($_SESSION['e_nick']);
	if(isset($_SESSION['e_email']))unset($_SESSION['e_email']);
	if(isset($_SESSION['e_password']))unset($_SESSION['e_password']);
	if(isset($_SESSION['e_regulamin']))unset($_SESSION['e_regulamin']);
	if(isset($_SESSION['e_bot']))unset($_SESSION['e_bot']);
?>


<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Stylizowanie formularzy</title>
	<meta name="keywords" content="css, odcinek" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
	<link rel="stylesheet" href="../assets/css/login_style.css" type="text/css" />
	
</head>

<body>

<div id="menu">
<a href="../login.php"><button type="submit" >Home</button></a>
 <a href="../us.html" >  <button type="submit">About Us</button> </a>
  <a href="../about.html"> <button type="submit">Project</button></a>
</div>


	<div id="title">
	Pocket World Map
	
	<hr width="20%" />
	</div>

	<div id="container_login">
	
			<form action = "zaloguj.php" method = "post">
			
						Now you can log in!
						
					<input type="text" placeholder="Login" name="login">
			
			
					<input type="password"  placeholder="Password" name="password">
			
	  <?php
  if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
  ?>
			
					<input type="submit"value="Sing In"> 
			
			
			
				</form>
		
		<form action="rejestracja.php" method="post">
		
				<input type="submit"value="Sing Up">
			
		</form>
		
		
	</div>
	
	
</body>