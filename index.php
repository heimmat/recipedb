<?php
	$doctitle = "Rezepte-Übersicht";
	include('header.php');
?>
<table>
<tr><th>Titel</th><th>Untertitel</th><th>Kategorie(n)</th></tr>
<?php
	foreach (listRecipes_byUser($_SESSION['userId']) as $row)
	{
		echo "<tr><td><a href=showrecipe.php?recipeId=" . $row['recipeId'] . ">" . $row['recipeTitle'] . "</a></td><td>" . $row['recipeSubtitle'] . "</td>";
		echo "<td>";
		$counter=0;
		foreach (listCategories_byRecipeId($row['recipeId']) as $category)
		{
			if ($counter > 0)
			{
				echo "/";	
			}
			echo $category['categoryName'];
			$counter++;
		}
		echo "</td>";
		echo "</tr>";
	}
?>
</table>
<a href="categories.php">Kategorien</a><br>
<a href="addrecipe.php">Rezept hinzufügen</a><br>
<a href="units.php">Einheiten</a><br>
<?php
	include_once('footer.php');
?>