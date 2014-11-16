<?php include("lib/includes.php"); ?>
<?php include("includes/header.php"); ?>
<?php if($_SESSION['auth'] == 0) {header("Location:".WEBROOT."index.php");}?>

<div class="container theme-showcase" role="main">
	
<?php
	$TopicId = $_GET['id_topic'];
	$TopicLibelle = $_GET['nom_topic'];

	echo '<div class = "jumbotron">';
	echo '<h1>'.$TopicLibelle.'</h1>';
	echo '</div>';

	$requete = $bdd->prepare('SELECT MesId, MesText, MesDate, u.UserLogin FROM messages m inner join user u on m.UserId = u.UserId where topicid = :topicid');
	$requete->bindValue(':topicid',$TopicId, PDO::PARAM_INT);
	$requete->execute();
	$tmpcount = $requete->rowCount();
	if($tmpcount > 0)
	{
		echo '<div class = "jumbotron">';
		for ($k = 0; $k < $tmpcount ; $k++) 
		{
			extract($requete->fetch());
			echo '<p>Message du '.$MesDate.' posté par '.$UserLogin.'</p>';
			echo $MesText;
			echo '<p>--------------------</p>';
		}
		echo '</div>';
	}
?>

<div class = 'jumbotron'>
<form method="post">
    <textarea id="elm1" name="area"></textarea>
    <input type="submit" class="btn btn-success" value="Poster" name="submit"/>
</form>

</div>

<?php include("includes/footer.php"); ?>