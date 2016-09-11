<?php
	$doctitle = "Rezepte-Übersicht";
	include('header.php');
	print 'Hallo ' . $_SESSION['user']['userFirstname'] . '!';
?>

<table>
<tr><th>Titel</th><th>Untertitel</th><th>Kategorie(n)</th></tr>
<?php
	foreach (listRecipes_byUser($_SESSION['user']['userId']) as $row)
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
<?php
	include_once('footer.php');
?>