<?php
	include_once('dbconnection.php');
	$logged_in = check_logged_in();

	if (!$logged_in)
	{
		include('min_header.php');
		print '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">
		<label for="userName">Benutzername</label>
		<input type="text" name="userName"/>
		<label for="userPassword">Passwort</label>
		<input type="password" name="userPassword"/>
		<input type="submit" value="Einloggen"/>
	</form>';
		include_once('footer.php');
		exit();
	}

	function check_logged_in()
	{
		$retval = false;
		session_start();
		if (isset($_POST))
		{
			if (isset($_SESSION['user']))
			{
				$retval = true;
			}
			else if (isset($_POST['userName']) && isset($_POST['userPassword']))
			{
				$user = authenticateUser($_POST['userName'], $_POST['userPassword']);
				if ($user)
				{
					$_SESSION['user'] = $user;
					$retval = true;
				}				
			}			
		}
		return $retval;
	}
?>