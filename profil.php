<?php require_once("includes/header.php"); ?>
<?php if($_SESSION['auth'] == 0) {header("Location:".WEBROOT."index.php");}?>

<div class="container theme-showcase" role="main">
	<div class = "jumbotron">
<?php
       //On récupère les infos du membre
       $query=$bdd->prepare('SELECT * FROM user WHERE UserLogin=:login');
       $query->bindValue(':login',$_SESSION['login'], PDO::PARAM_STR);
       $query->execute();
       $data=$query->fetch();

       echo'<h1>Profil de '.stripslashes(htmlspecialchars($_SESSION['login'])).'</h1>';
       
       switch ($_SESSION['droit']) 
       {
       case '1':
              echo'<h1><img src="'.WEBROOT.'images/avatars/'.$_SESSION['membre_avatar'].'"
       alt="Ce membre n\'a pas d avatar" />UTILISATEUR LAMBDA</h1>';
       break;
       case '2':
              echo'<h1><img src="'.WEBROOT.'images/avatars/'.$_SESSION['membre_avatar'].'"
       alt="Ce membre n\'a pas d avatar" />MODERATEUR</h1>';
       break;    
       case '3':
              echo'<h1><img src="'.WEBROOT.'images/avatars/'.$_SESSION['membre_avatar'].'"
       alt="Ce membre n\'a pas d avatar" />ADMINISTRATEUR</h1>';
       break;
       }

       $query->CloseCursor();
?>
</div></div>
<?php require_once("includes/footer.php"); ?>