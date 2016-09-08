<?php
	include_once('dbconnection.php');
	if ($_GET)
	{	
		if ($_GET['recipeId'])
		{
			$recipeId = $_GET['recipeId'];
		}
		$query_recipe = $pdo->prepare('SELECT * FROM tblRecipes WHERE recipeId = :recipeId;');
		$query_recipe->bindParam(':recipeId', $recipeId);
		$query_recipe->execute();
		$recipe = $query_recipe->fetch();
		if (!empty($recipe))
		{
			$doctitle = $recipe['recipeTitle'];
		}
		else
		{
			$doctitle = "Rezept nicht vorhanden";	
		}		
	}
	include_once('header.php');
?>
<?php
	if (!empty($recipe))
	{
		echo "<h2>" . $recipe['recipeSubtitle'] . "</h2>";	
	}
?>
<div id="ingr">
<h3>Zutaten</h3>
<table>
<?php
	$query_ingr = $pdo->prepare('SELECT * FROM tblRecipeIngredients ri JOIN tblIngredients i ON ri.ingredientId = i.ingredientId JOIN tblUnits u ON ri.unitId = u.unitId WHERE ri.recipeId = :recipeId;');
	$query_ingr->bindParam(':recipeId', $recipeId);
	$query_ingr->execute();
	foreach ($query_ingr->fetchAll() as $ingr)
	{
		echo "<tr>";
		echo "<td>";
		if ($ingr['Amount'] > 0)
		{
			echo $ingr['Amount'];
		}
		echo "</td>";
		echo "<td>";
		echo $ingr['unitShortname'];
		echo "</td>";
		echo "<td>";
		echo $ingr['ingredientName'];
		echo " ";
		if ($ingr['Description'] != "")
		{
			echo "(" . $ingr['Description'] . ")";
		}
		echo "</td>";
		echo "</tr>";
	}  
?>
</table>
</div>
<div id="howto">
<h3>Zubereitung</h3>
<ol>
<?php
	$recipeFilePath = "recipefiles/" . $recipe['recipeFile'];
	if (file_exists($recipeFilePath))
	{
		//include($recipeFilePath);	
		$recipexml=simplexml_load_file($recipeFilePath);
		foreach ($recipexml->Howto->HowtoStep as $step)
		{
			echo "<li>" . $step . "</li>";
		}
		
	}
?>
</ol>
</div>
<?php
	include_once('footer.php');
?>
