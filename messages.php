<?php include("lib/includes.php"); ?>
<?php include("includes/header.php"); ?>
<?php if($_SESSION['auth'] == 0) {header("Location:".WEBROOT."index.php");}?>

<form method="post">
    <textarea id="elm1" name="area"></textarea>
</form>
<?php
	/*$requete = $bdd->prepare('SELECT * FROM messages where topicid = :topicid');
	$requete->bindValue(':topicid',$TopicId, PDO::PARAM_INT);
	$requete->execute();
	$tmpCount = $requete->rowCount();

	if($tmpcount > 0)
	{
		for ($k = 0; $k < $tmpcount ; $k++) 
		{
			extract($requete->fetch());
			echo "<div>".$MesText."</div>";
		}
	}*/
?>

<div><?php var_dump($_SESSION); ?> </div>

<?php include("includes/footer.php"); ?>