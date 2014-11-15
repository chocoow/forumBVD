<?php include("lib/includes.php"); ?>
<?php include("includes/header.php"); ?>
<?php if($_SESSION['auth'] == 0) {header("Location:".WEBROOT."index.php");}?>
	
<div class="container theme-showcase" role="main">
	<div class = "jumbotron">
		<?php
			$requete1 = $bdd->prepare('SELECT * FROM Categories');
			$requete1->execute();
			$tmp1count = $requete1->rowCount();

			if($tmp1count > 0)
			{
				for ($i = 0; $i < $tmp1count ; $i++) 
				{
					extract($requete1->fetch());
					echo "<table>";
					echo "<tr><h1>".$CatLibelle."</h1></tr>";

					$requete2 = $bdd->prepare('SELECT * FROM topics where CatId = :catid');
					$requete2->bindValue(':catid',$CatId, PDO::PARAM_INT);
					$requete2->execute();
					$tmp2count = $requete2->rowCount();

					if($tmp2count > 0)
					{
						echo "";
						for ($j = 0; $j < $tmp2count ; $j++) 
						{
							extract($requete2->fetch());
							echo "<tr><h3><a href='messages.php'>".$TopicLibelle."</a></h3></tr>";
						}
					}
					else
					{
						echo "<h3>Aucun Topic encore créé.</h3>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<h1>Aucune Categorie encore créée.</h1>";
			}
		?>
    </div>
</div>

<?php include("includes/footer.php"); ?>