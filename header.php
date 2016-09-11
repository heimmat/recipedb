<?php
	include_once('min_header.php');
?>
<!--Menüleiste-->
<nav id="headernav" class="topnav">
<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="addrecipe.php">Rezept hinzufügen</a></li>
<?php
	if ($_SESSION['user']['userIsAdmin'] == 1)
	{
		print '<li><a href="admin.php">Admin-Menü</a></li>';

	}	
?>
	<li class="right"><a href="logout.php">Logout</a></li>
	<li class="hamburger"><input type="button" value="&#9776;" onclick="hideMenu()">
</ul>
</nav>
</div>
<h1>
<?php
	echo $doctitle;
?>
</h1>