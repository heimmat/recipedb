<?php
	include('dbconnection.php');

	if (isset($_POST))
	{
		if (isset($_POST['userName']) && isset($_POST['userPassword']))
		{
			newUser($_POST['userName'], $_POST['userPassword'], $_POST['userLastname'], $_POST['userFirstname']);
		}
	}

	$users = listUsers();
?>
<html>
<head>
<title>User Management</title>
</head>
<body>
<h1>User Management</h1>
<h2>Benutzerübersicht</h2>
<table>
<tr><th>Benutzername</th><th>Nachname</th><th>Vorname</th><th>Letzter Login</th></tr>
<?php
	foreach ($users as $user)
	{
		echo '<tr><td>' . $user['userName'] . '</td><td>' . $user['userLastname'] . '</td><td>' . $user['userFirstname'] . '</td><td>' . $user['userLastlogin'] . '</td></tr>';
	}
?>
</table>
<h2>Neuen Benutzer hinzufügen</h2>
<form name="newUser" action="usermgmt.php" method="POST">
<label for="userName">Benutzername</label>
<input type="text" name="userName" required="true"/><br>
<label for="userPassword">Passwort</label>
<input type="password" name="userPassword"/><br>
<label for="userLastname">Nachname</label>
<input type="text" name="userLastname"/><br>
<label for="userFirstname">Vorname</label>
<input type="text" name="userFirstname"/><br>
<input type="submit" value="Hinzufügen"/>
</form>

