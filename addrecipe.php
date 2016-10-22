<?php
	$doctitle = 'Rezept hinzufügen';
	include_once('header.php');
?>
<nav class="tab">
	<ul>
		<li><a href="#recipeMeta" class="tablinks">Rezept-Daten</a></li>
		<li><a href="#recipeIngr" class="tablinks">Zutaten</a></li>
	</ul>
</nav>
<form>
	<fieldset id="recipeMeta" class="tabcontent">
		<h2>Rezept-Daten</h2>
		<label for="recipeTitle">Rezepttitel</label>
		<input type="text" id="recipeTitle" name="recipeTitle" required/><br>
		<label for="recipeSubtitle">Rezept-Untertitel</label>
		<input type="text" id="recipeSubtitle" name="recipeSubtitle"/><br>
		<label for="recipePortions">Portionen</label>
		<input type="number" id="recipePortions" name="recipePortions"/><br>
		<label for="recipePreptime">Zubereitungszeit (hh:mm)</label>
		<input pattern="^\d{0,2}:[0-5]\d$" type="text" id="recipePreptime" name="recipePreptime"/><br>
		<label for="recipeCooktime">Garzeit (hh:mm)</label>
		<input pattern="^\d{0,2}:[0-5]\d$" type="text" id="recipeCooktime" name="recipeCooktime"/><br>
		<label for="recipeWaittime">Ruhezeit (hh:mm)</label>
		<input pattern="^\d{0,2}:[0-5]\d$" type="text" id="recipeWaittime" name="recipeWaittime"/><br>
		<label for="recipeSource">Quelle des Rezepts</label>
		<input type="text" id="recipeSource" name="recipeSource"/><br>
		<label for="recipeImage">Foto des Rezepts</label>	
		<input type="file" id="recipeImage" name="recipeImage" multiple/><br>
		<label for="recipeCategories">Rezept-Kategorie(n)</label>
		<select multiple id="recipeCategories[]" name="recipeCategories[]">
		<?php
		foreach ($pdo->query("SELECT categoryId, categoryName FROM tblCategory;") as $row)
		{		
			echo '<option value="' . $row['categoryId'] . '">' . $row['categoryName'] .'</option>';
		}
		?>
		</select>
	</fieldset>
	<fieldset id="recipeIngr" class="tabcontent">
		
	</fieldset>
	<input type="button" id="nextStep" value="Weiter"></input>
</form>

<script type="text/javascript">
	$(document).ready(documentInit);

	function documentInit() 
	{
		$("#nextStep").click(nextStep);	
	}

	function nextStep(clickEvent)
	{
		//check for valid input
		
		//and go to next step
		var active = $(".tab li.current");
		var next = active.next("li");
		next.children().click();
	}
	var recipe = {};

</script>