<?php
	include_once('dbconnection.php');
	$logged_in = check_logged_in();

	if (!$logged_in)
	{
		print '<html>
	<head>
		<title>Einloggen</title>
	</head>
	<body>
		<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">
			<label for="userName">Benutzername</label>
			<input type="text" name="userName"/>
			<label for="userPassword">Passwort</label>
			<input type="password" name="userPassword"/>
			<input type="submit" value="Einloggen"/>
		</form>
	</body>
<html>';
		exit();
	}

	function check_logged_in()
	{
		$retval = false;
		session_start();
		if (isset($_POST))
		{
			if (isset($_SESSION['userId']))
			{
				$retval = true;
			}
			else if (isset($_POST['userName']) && isset($_POST['userPassword']))
			{
				$userId = authenticateUser($_POST['userName'], $_POST['userPassword']);
				if ($userId)
				{
					$_SESSION['userId'] = $userId;
					$retval = true;
				}				
			}			
		}
		return $retval;
	}
?>