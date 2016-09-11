<?php
	$pdo = new PDO('mysql:host=localhost;dbname=recipedb', 'recipeuser', 'recipeuser');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	function newUser($userName, $userPassword, $userLastname, $userFirstname)
	{
		global $pdo;
		$sql = 'INSERT INTO tblUsers (userName, userPassword, userLastname, userFirstname) VALUES(:userName, :userPassword, :userLastname, :userFirstname);';
		$prep_stat = $pdo->prepare($sql);
		$argArray = array(
			':userName' => $userName,
			':userPassword' => password_hash($userPassword, PASSWORD_DEFAULT),
			':userLastname' => $userLastname,
			'userFirstname' => $userFirstname
		);
		$prep_stat->execute($argArray);
	}

	function listUsers()
	{
		global $pdo;
		$sql = 'SELECT userId, userName, userLastname, userFirstname, userLastlogin, userIsAdmin FROM tblUsers;';
		$prep_stat = $pdo->prepare($sql);
		$prep_stat->execute();
		return $prep_stat->fetchAll();
	}

	function listUser_byId($userId)
	{
		global $pdo;
		$sql = 'SELECT userId, userName, userLastname, userFirstname, userLastlogin, userIsAdmin FROM tblUsers;';
		$prep_stat = $pdo->prepare($sql);
		$prep_stat->execute();
		return $prep_stat->fetch();
	}

	/*function selectUser_byUsername($userName)
	{
		global $pdo;
		$sql = 'SELECT * FROM '
	}*/

	//returns user when successful. else false
	function authenticateUser($userName, $userPassword)
	{
		global $pdo;
		$retval = false;
		$sql = 'SELECT * FROM tblUsers WHERE userName = :userName;';
		$prep_stat = $pdo->prepare($sql);
		$prep_stat->bindParam(':userName', $userName);
		$prep_stat->execute();
		$result = $prep_stat->fetch();
		if ($result)
		{
			if (password_verify($userPassword, $result['userPassword']))
			{
				updateLastlogin($result['userId']);
				$retval = $result;
			}
		}
		return $retval;
	}

	function updateLastlogin($userId)
	{
		global $pdo;
		$sql = 'UPDATE tblUsers SET userLastlogin = NOW() WHERE userId = :userId;';
		$prep_stat = $pdo->prepare($sql);
		$prep_stat->bindParam(':userId', $userId);
		$prep_stat->execute();

	}

	function listRecipes_byUser($userId)
	{
		global $pdo;
		$sql = 'SELECT recipeId, recipeTitle, recipeSubtitle FROM tblRecipes WHERE userId = :userId;';
		$prep_stat = $pdo->prepare($sql);
		$prep_stat->bindParam(':userId', $userId);
		$prep_stat->execute();
		$result = $prep_stat->fetchAll();
		return $result;
	}

	function listCategories_byRecipeId($recipeId)
	{
		global $pdo;
		$sql = 'SELECT c.categoryName FROM tblRecipeCategory rc JOIN tblCategory c ON rc.categoryId=c.categoryId WHERE rc.recipeId= :recipeId;';
		$prep_stat = $pdo->prepare($sql);
		$prep_stat->bindParam(':recipeId', $recipeId);
		$prep_stat->execute();
		return $prep_stat->fetchAll();
	}
?>
