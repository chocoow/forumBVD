<?php require_once("includes/header.php"); ?>

<?php
	if (isset($_POST['submit']))
	{
		extract($_POST);
		$password = sha1($password);
		$requete = $bdd->prepare('SELECT * FROM user WHERE userlogin =:login AND userpassword = :password AND UserRole <> 0');
		$requete->bindValue(':login',$login, PDO::PARAM_STR);
		$requete->bindValue(':password',$password, PDO::PARAM_STR);
		$requete->execute();
		if($requete->rowCount()==1)
		{
			extract($requete->fetch());
			$_SESSION['auth'] = 1;
			$_SESSION['id'] = $UserId;
			$_SESSION['login'] = $UserLogin;
			$_SESSION['droit'] = $UserRole;
			$_SESSION['membre_avatar'] = $UserAvatar;
			setFlash("Vous etes maintenant connecté, enjoy !","");
			echo flash();
			header("Location:".WEBROOT."index.php");
		}
		else
		{
			setFlash("Veuillez verifier vos identifiants ou contacter un administrateur.<br/><a href='enregistrer.php'>Créer un compte</a> <br> ","Danger");
			echo flash();
		}
	}
?>
</div>
	<div class="container theme-showcase" role="main">
		<div class = "jumbotron">
			<h1>Connexion</h1>
			<form method="post" action="">
				<div class="form-group">
					<label for="login">Login:</label>
					<input type="text" class="form-control" name="login" id="login" placeholder="Login"/>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
				</div>
				<input type="submit" class="btn btn-success" value="Se Connecter" name="submit"/>
			</form>
		</div>
	</div>

<?php require_once("includes/footer.php"); ?>