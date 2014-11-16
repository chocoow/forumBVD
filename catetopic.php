<?php include("lib/includes.php"); ?>
<?php include("includes/header.php"); ?>
<?php if($_SESSION['auth'] == 0) {header("Location:".WEBROOT."index.php");}?>
	

<?php
	$requete1 = $bdd->prepare('SELECT * FROM Categories');
	$requete1->execute();
	$tmp1count = $requete1->rowCount();

	if($tmp1count > 0)
	{
		for ($i = 0; $i < $tmp1count ; $i++) 
		{
			echo '<div class="container theme-showcase" role="main">';
			echo '<div class = "jumbotron">';
			echo '<div class = "wrap">';
			echo '<ul class =  "menu">';
			extract($requete1->fetch());
			echo "<li><a href=''><h1>".$CatLibelle."</h1></a>";

			$requete2 = $bdd->prepare('SELECT * FROM topics where CatId = :catid');
			$requete2->bindValue(':catid',$CatId, PDO::PARAM_INT);
			$requete2->execute();
			$tmp2count = $requete2->rowCount();

			if($tmp2count > 0)
			{
				echo "<ul>";
				for ($j = 0; $j < $tmp2count ; $j++) 
				{
					extract($requete2->fetch());
					echo "<li><h3><a href='messages.php?id_topic=".$TopicId."&nom_topic=".$TopicLibelle."'>".$TopicLibelle."</a></h3></li>";
				}
				echo "<ul>";
			}
			else
			{
				echo "<h3>Aucun Topic encore créé.</h3>";
			}
			echo '</div></div></div></div>';
		}

	}
	else
	{
		echo "<h1>Aucune Categorie encore créée.</h1>";
	}
?>


<?php include("includes/footer.php"); ?>