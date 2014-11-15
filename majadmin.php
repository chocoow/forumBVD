<?php require_once("includes/header.php"); ?>
<?php if($_SESSION['droit'] == 0 || $_SESSION['droit'] == 1) {header("Location:".WEBROOT."index.php");}?>
  
<div class="container theme-showcase" role="main">
<div class = "jumbotron">
<?php
$cat = (isset($_GET['cat']))?htmlspecialchars($_GET['cat']):'';

  switch($cat) //1er switch
  {
    case "forum":
    //Ici forum
    $action = htmlspecialchars($_GET['action']); //On récupère la valeur de action

    switch($action) //2eme switch
    {
      case "creer":
      //Création d'un forum
      //1er cas : pas de variable c
      if(empty($_GET['c']))
      {
        echo'<p><a href="'.WEBROOT.'admin.php?cat=forum&action=creer&c=c">Créer une catégorie</a></p>';
      }
      //3ème cas : on cherche à créer une catégorie (c=c)
      if ($_GET['c'] == "c")
      {
        $titre = $_POST['nom'];
        $query=$bdd->prepare('INSERT INTO categories (CatLibelle,CatDate, UserId) VALUES (:titre, now(), :id)');
        $query->bindValue(':titre',$titre, PDO::PARAM_STR); 
        $query->bindValue(':id',$_SESSION['id'], PDO::PARAM_INT); 
        $query->execute();          
        echo'<p>La catégorie a été créée !<br /> Cliquez <a href="'.WEBROOT.'admin.php">ici</a> 
        pour revenir à l administration</p>';
        $query->CloseCursor();
      }
      break;

      case "edit":
      if(!isset($_GET['e']))
      {
        echo'<p><a href="'.WEBROOT.'admin.php?cat=forum&action=edit&amp;e=editc">Editer une catégorie</a></p>';
      }
      elseif($_GET['e'] == "editc")
      {
        //Récupération d'informations
        $titre = $_POST['nom'];

        //Vérification
        $query=$bdd->prepare('SELECT COUNT(*) 
        FROM categories WHERE CatId = :cat');
        $query->bindValue(':cat',(int) $_POST['cat'],PDO::PARAM_INT);
        $query->execute();
        $cat_existe=$query->fetchColumn();
        $query->CloseCursor();
        if ($cat_existe == 0) erreur(ERR_CAT_EXIST);
        
        //Mise à jour
        $query=$bdd->prepare('UPDATE categories
        SET CatLibelle = :name WHERE CatId = :cat');
        $query->bindValue(':name',$titre,PDO::PARAM_STR);
        $query->bindValue(':cat',(int) $_POST['cat'],PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();

        //Message
        echo'<p>La catégorie a été modifiée !<br />
        Cliquez <a href="'.WEBROOT.'admin.php">ici</a> 
        pour revenir à l administration</p>';
      }
      break;

      default; //action n'est pas remplie, on affiche le menu
      if($_SESSION['droit']==='3')
      {
        echo'<h1>Administration du forum</h1>';
        echo'<a href="'.WEBROOT.'admin.php?cat=forum&amp;action=creer">Creation</a><br />
        <a href="'.WEBROOT.'admin.php?cat=forum&amp;action=edit">Edition</a><br />';
      }
      break;
    }
    break;

    case "membres":
    //Ici membres
    $action = htmlspecialchars($_GET['action']); //On récupère la valeur de action
    switch($action) //2eme switch
    {  
      case "droits":
        $membre =$_POST['pseudo'];
        $rang = (int) $_POST['droits'];
        $query=$bdd->prepare('UPDATE user SET UserRole = :rang
        WHERE LOWER(UserLogin) = :pseudo');
              $query->bindValue(':rang',$rang,PDO::PARAM_INT);
              $query->bindValue(':pseudo',strtolower($membre), PDO::PARAM_STR);
              $query->execute();
              $query->CloseCursor();
        echo'<p>Le niveau du membre a été modifié !<br />
        Cliquez <a href="./admin.php">ici</a> pour revenir à l administration</p>';
      break;
    }
    break;
    default;
    if($_SESSION['droit']==='3')
    {
      echo'<h1>Administration</h1>
      <a href="'.WEBROOT.'admin.php?cat=forum&amp;action=">Administration du forum</a><br />
      <a href="'.WEBROOT.'admin.php?cat=membres&amp;action=">Administration des membres</a><br /></p>';
    }
    break;
  }
?>
</div></div>

<?php require_once("includes/footer.php"); ?>