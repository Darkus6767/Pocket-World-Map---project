<?php



	session_start();
	
	if(isset($_POST['email']))
	{
		//Udana walidacja? 
		$wszystko_OK=true;
		
		// sprawdzimy poprawnosc nickname
		$nick = $_POST['nick'];
		
		//sprawdzenie dlugosci nicka
		
		if((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick'] = "Nickname lenght must be from 3 to 20 signs!";
		}
		
		if(ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick'] = "Nickname can contain only letters and numbers!";
		}
		
		//sprawdz emial
		$email = $_POST['email'];
		$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
		
		
		if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email'] = "Please enter the correct e-mail!";
		}
		
		//sprawdzanie hasel
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		
		if((strlen($password1)<8) || (strlen($password1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_password'] = "Password lenght must be from 8 to 20 signs!";
		}
		
		if($password1!=$password2)
		{
			$wszystko_OK=false;
			$_SESSION['e_password'] = "Passwords aren't the same!";
		}
		
		$password_hash = password_hash($password1,PASSWORD_DEFAULT);
		
		if(!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin'] = "You need to accept the rule!";
		}
		
		//recaptcha
		
		$secret = "6LdiOAsUAAAAALGFmBq2sn5PZrslByYXdYSdm6CP";
		
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$response = json_decode($check);
		
		if($response->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot'] = "Confirm that you aren't bot!";
		}
		//zapamietaj wprowadzone dane
		
		$_SESSION['fr_nick'] =$nick;
		$_SESSION['fr_email'] =$email;
		$_SESSION['fr_password1'] =$password1;
		$_SESSION['fr_password2'] =$password2;
		if(isset($_POST['regulamin']))$_SESSION['fr_regulamin'] =true;
		
		
		
		//sprawdzenie pwotorzen w bazie
		
		require_once "connect_sql.php";
		
		//mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
			
			if($polaczenie->connect_errno!=0) #zajscie bledu
			{
				 throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//sprwdzenie maila w bazie
				$result = $polaczenie->query("SELECT Id FROM users WHERE Email='$email'");
				if(!$result) throw new Exception($polaczenie->error);
				
				$how_many_mails = $result->num_rows;
				if($how_many_mails>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email'] = "There is account with this e-mail adress!";
					
				}
				
				//Sprawdzenie nicku
				$result = $polaczenie->query("SELECT Id FROM users WHERE Login='$nick'");
				if(!$result) throw new Exception($polaczenie->error);
				
				$how_many_nick = $result->num_rows;
				if($how_many_nick>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick'] = "There is account with this nickname. Please choose another nickname!";
					
				}
				
				
				if($wszystko_OK==true)
				{
					//Wszystkie testy zaliczone
					if($polaczenie->query("INSERT INTO users VALUES (NULL,'$nick','$password_hash','$email',10)"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: welcome.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
		
				$polaczenie->close();
			}
			
	
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Sever Error! We are sorry for problems, please try again later!</span>';
			 echo '<br / >Informacje developerskie: '.$e;
		}
		
		
	}
	
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="uft-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	<link rel="stylesheet" href="../assets/css/login_style.css" type="text/css" />
<script src='https://www.google.com/recaptcha/api.js'></script>

<style>
.error
{
	color:red;
	margin-top: 10px;
	margin-bottom: 10px;
}
</style>
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
	<form method="post">
	
	Nickname: <br /> <input type="text" value="<?php
	
	If(isset($_SESSION['fr_nick']))
	{
		echo $_SESSION['fr_nick'];
		unset($_SESSION['fr_nick']);
	}
	
	?>" name="nick" /><br />
	
	<?php
		if(isset($_SESSION['e_nick']))
		{
			echo'<div class="error">'.$_SESSION['e_nick'].'</div>';
			unset($_SESSION['e_nick']);
		}
	
	?>
	
	E-mail: <br /> <input type="text" value="<?php
	If(isset($_SESSION['fr_email']))
	{
		echo $_SESSION['fr_email'];
		unset($_SESSION['fr_email']);
	}
	?>" name="email" /><br />
	
	<?php
		if(isset($_SESSION['e_email']))
		{
			echo'<div class="error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}
	
	?>
	
	
	Password: <br /> <input type="password" value="<?php
	If(isset($_SESSION['fr_password1']))
	{
		echo $_SESSION['fr_password1'];
		unset($_SESSION['fr_password1']);
	}
	?>" name="password1" /><br />
	
	<?php
		if(isset($_SESSION['e_password']))
		{
			echo'<div class="error">'.$_SESSION['e_password'].'</div>';
			unset($_SESSION['e_password']);
		}
	
	?>
	
	Repeat Password: <br /> <input type="password" value="<?php
	If(isset($_SESSION['fr_password2']))
	{
		echo $_SESSION['fr_password2'];
		unset($_SESSION['fr_password2']);
	}
	?>" name="password2" /><br />
	
	
	<label>
		<input type="checkbox" name="regulamin" <?php
		if(isset($_SESSION['fr_regulamin']))
		{
			echo "checked";
			unset($_SESSION['fr_regulamin']);
		}
		?>/>  I accept the rule
	</label>
	
		<?php
		if(isset($_SESSION['e_regulamin']))
		{
			echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
		}
	
	?>
	
	
	<div class="g-recaptcha" data-sitekey="6LdiOAsUAAAAAAAMQ12pF4j0eUZvBD2Qg9caxY0c"></div>
	
		<?php
		if(isset($_SESSION['e_bot']))
		{
			echo'<div class="error">'.$_SESSION['e_bot'].'</div>';
			unset($_SESSION['e_bot']);
		}
	
	?>
	
	
	<br/>
	
	<input type="submit" value="Sign Up"/>
	</div>
	</form>




  
</body>