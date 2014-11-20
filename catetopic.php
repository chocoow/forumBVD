<?php include("lib/includes.php"); ?>
<?php include("includes/header.php"); ?>
<?php if($_SESSION['auth'] == 0) {header("Location:".WEBROOT."index.php");}?>
	
<?php
if (isset($_POST['addTopic']))
	{
		extract($_POST);

		if (isset($topicArea))
		{
			$requete1 = $bdd->prepare('INSERT INTO topics(TopicLibelle, TopicDate, UserId, CatId) 
				VALUES (:TopicLibelle,now(),:UserId,:CatId)');
			$requete1->bindValue(':TopicLibelle',$topicArea, PDO::PARAM_STR);
			$requete1->bindValue(':UserId',$_SESSION['id'], PDO::PARAM_INT);
			$requete1->bindValue(':CatId',$CatId, PDO::PARAM_INT);
			$requete1->execute();
		}
	}
?>
<?php
	$requete1 = $bdd->prepare('SELECT * FROM Categories');
	$requete1->execute();
	$tmp1count = $requete1->rowCount();

	if($tmp1count > 0)
	{
		for ($i = 0; $i < $tmp1count ; $i++) 
		{
			echo '<div class="container theme-showcase" role="main">';
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
					echo "<li><a href='messages.php?id_topic=".$TopicId."&nom_topic=".$TopicLibelle."'>".$TopicLibelle."</a></li>";
				}
				echo "</ul>";
			}
			else
			{
				setFlash("Aucun Topic encore créé !","danger");
				echo flash();
			}

			if($_SESSION['droit'] == 3)
			{
				echo '<div class = "jumbotron"><form method="post">';
				echo '<textarea id="elm1" name="topicArea">ajouter un nouveau topic ?</textarea>';
				echo '<input type="hidden" name="CatId" value="'.htmlspecialchars($CatId).'" />';
				echo '<input type="submit" class="btn btn-success" value="Ajouter Topic" name="addTopic"/>';
				echo '</form></div>';
			}
			echo '</li></div></div>';
		}

	}
	else
	{
		setFlash("Aucune Categorie encore créée !","danger");
		echo flash();
	}
?>


<?php include("includes/footer.php"); ?>