<?php
	$doctitle = "Einheiten";
	include('header.php');
?>
<?php
	if ($_POST)
	{
		$insert_statement = $pdo->prepare("INSERT INTO tblUnits (unitShortname, unitName) VALUES (:unitShortname, :unitName);");
		$insert_statement->execute($_POST);
	}
?>
<table>
<tr><th>Abkürzung</th><th>Bedeutung</th></tr>
<?php
	foreach ($pdo->query("SELECT unitShortname, unitName FROM tblUnits;") as $row)
	{
		echo "<tr><td>" . $row['unitShortname'] . '</td><td>' . $row['unitName'] . "</td></tr>";
	}
?>
<form action="units.php" method="post">
<tr><td><input type="text" name="unitShortname"/></td><td><input type="text" name="unitName"/></td><td><input type="submit" value="Hinzufügen"/></td></tr>
</table>
<?php
	include_once('footer.php');
?>
