<?php
	$doctitle = 'Admin-Menü';
	include_once('header.php');

	//POST-Verwaltung
	if (isset($_POST))
	{
		if (isset($_POST['userName']) && isset($_POST['userPassword']))
		{
			newUser($_POST['userName'], $_POST['userPassword'], $_POST['userLastname'], $_POST['userFirstname']);
		}

		if (isset($_POST['categoryName']) && isset($_POST['categoryDescription']))
		{
			$insert_statement = $pdo->prepare("INSERT INTO tblCategory (categoryName, categoryDescription) VALUES (:categoryName, :categoryDescription);");
			$insert_statement->execute($_POST);
		}		

		if (isset($_POST['unitShortname']) && isset($_POST['unitName']))
		{
			$insert_statement = $pdo->prepare("INSERT INTO tblUnits (unitShortname, unitName) VALUES (:unitShortname, :unitName);");
			$insert_statement->execute($_POST);
		}
	}
	$users = listUsers();


?>
<nav class="tab">
	<ul>
		<li><a href="#categories" class="tablinks">Kategorien</a></li>
		<li><a href="#units" class="tablinks">Einheiten</a></li>
		<li><a href="#usermgmt" class="tablinks">Benutzerverwaltung</a></li>
	</ul>
</nav>
<br>
<!--Kategorienverwaltung-->
<div id="categories" class="tabcontent">
<h2>Kategorien</h2>	
<table>
<tr><th>Name</th><th>Beschreibung</th></tr>
<?php
	foreach ($pdo->query("Select categoryName, categoryDescription from tblCategory;") as $row)
	{
		echo "<tr><td>" . $row['categoryName'] . '</td><td>' . $row['categoryDescription'] . "</td></tr>";
	}
?>
<form action="admin.php" method="post">
<tr><td><input type="text" name="categoryName"/></td><td><input type="text" name="categoryDescription"/></td><td><input type="submit" value="Hinzufügen"/></td></tr>
</form>
</table>
</div>

<!--Einheitenverwaltung-->
<div id="units" class="tabcontent">
<h2>Einheiten</h2>	
<table>
<tr><th>Abkürzung</th><th>Bedeutung</th></tr>
<?php
	foreach ($pdo->query("SELECT unitShortname, unitName FROM tblUnits;") as $row)
	{
		echo "<tr><td>" . $row['unitShortname'] . '</td><td>' . $row['unitName'] . "</td></tr>";
	}
?>
<form action="admin.php" method="post">
<tr><td><input type="text" name="unitShortname"/></td><td><input type="text" name="unitName"/></td><td><input type="submit" value="Hinzufügen"/></td></tr>
</form>
</table>
</div>

<!--Benutzerverwaltung-->
<div id="usermgmt" class="tabcontent">
	<h2>Benutzerübersicht</h2>
	<table>
	<tr><th>Benutzername</th><th>Nachname</th><th>Vorname</th><th>Letzter Login</th><th>Administrator</th></tr>
	<?php
		foreach ($users as $user)
		{
			echo '<tr><td>' . $user['userName'] . '</td><td>' . $user['userLastname'] . '</td><td>' . $user['userFirstname'] . '</td><td>' . $user['userLastlogin'] . '</td><td>' . $user['userIsAdmin'] . '</tr>';
		}
	?>
	</table>
	<h2>Neuen Benutzer hinzufügen</h2>
	<form name="newUser" action="admin.php" method="POST">
		<label for="userName">Benutzername</label>
		<input type="text" name="userName"/><br>
		<label for="userPassword">Passwort</label>
		<input type="password" name="userPassword"/><br>
		<label for="userLastname">Nachname</label>
		<input type="text" name="userLastname"/><br>
		<label for="userFirstname">Vorname</label>
		<input type="text" name="userFirstname"/><br>
		<input type="submit" value="Hinzufügen"/>
	</form>
</div>

<?php
	include_once('footer.php');
?>
