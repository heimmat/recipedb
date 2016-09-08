<?php
	$doctitle = "Kategorien";
	include_once('header.php');
?>
<?php
	if ($_POST)
	{
		if (isset($_POST['categoryName']) && isset($_POST['categoryDescription']))
		{
			$insert_statement = $pdo->prepare("INSERT INTO tblCategory (categoryName, categoryDescription) VALUES (:categoryName, :categoryDescription);");
			$insert_statement->execute($_POST);
		}		
	}
?>
<table>
<tr><th>Name</th><th>Beschreibung</th></tr>
<?php
	foreach ($pdo->query("Select categoryName, categoryDescription from tblCategory;") as $row)
	{
		echo "<tr><td>" . $row['categoryName'] . '</td><td>' . $row['categoryDescription'] . "</td></tr>";
	}
?>
<form action="categories.php" method="post">
<tr><td><input type="text" name="categoryName"/></td><td><input type="text" name="categoryDescription"/></td><td><input type="submit" value="Hinzufügen"/></td></tr>
</table>
<?php
	include_once('footer.php');
?>
