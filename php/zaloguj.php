<?php
	session_start();
	require_once "connect_sql.php";

	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
	
	if($polaczenie->connect_errno!=0) #zajscie bledu
	{
		echo "Error:".$polaczenie->connect_errno;
	}
	
	else
	{
		
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login,ENT_QUOTES,"UTF-8");
		$password = htmlentities($password, ENT_QUOTES,"UTF-8");
		
		
		
		if($rezultat =@$polaczenie->query(
		sprintf("SELECT * FROM users WHERE Login='%s'",
		mysqli_real_escape_string($polaczenie,$login))));
		{
			$ilu_userow = $rezultat->num_rows;
			
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if(password_verify($password,$wiersz['Password']))
				{
					$_SESSION['login'] = true;
					
					
					$_SESSION['id'] = $wiersz['Id'];
					$_SESSION['user'] = $wiersz['Login'];
					
					$rezultat->close();
					
					unset($_SESSION['blad']);
					header('Location: ../index.php');
				}
				else
				{
					$_SESSION['blad']= '<span style="color:red"> Unvailid login or password!</span>';
					header('Location: ../login.php');
				}
				
				
			}
			
			else
			{
				$_SESSION['blad']= '<span style="color:red"> Unvailid login or password!</span>';
				header('Location: ../login.php');
			}
			
		
		}
		
		$polaczenie->close();
	
	}

	
	
	
?>