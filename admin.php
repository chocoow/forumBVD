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
      elseif($_GET['c'] == "c")
      {
        echo'<h1>Création d une catégorie</h1>';
        echo'<form method="post" action="'.WEBROOT.'majadmin.php?cat=forum&action=creer&c=c">';
        echo'<label> Indiquez le nom de la catégorie :</label>
        <input type="text" id="nom" name="nom" /><br /><br />   
        <input type="submit" value="Envoyer"></form>';
      }
      break;

      case "edit":
      if(!isset($_GET['e']))
      {
        echo'<p><a href="'.WEBROOT.'admin.php?cat=forum&action=edit&amp;e=editc">Editer une catégorie</a></p>';
      }
      elseif($_GET['e'] == "editc")
      {
        //On commence par afficher la liste des catégories
        if(!isset($_POST['cat']))
        {
          $requete = $bdd->query('SELECT * FROM categories ORDER BY CatDate DESC');
          echo'<form method="post" action="'.WEBROOT.'admin.php?cat=forum&amp;action=edit&amp;e=editc">';
          echo'<p>Choisir une catégorie :</br />
          <select name="cat">';
          while($data = $requete->fetch())
          {
            echo'<option value="'.$data['CatId'].'">'.$data['CatLibelle'].'</option>';
          }
          echo'<input type="submit" value="Envoyer"></p></form>';         
          $requete->CloseCursor();                                                                  
        }         
        //Puis le formulaire
        else
        {
          $requete = $bdd->prepare('SELECT CatLibelle FROM categories WHERE CatId = :catid');
          $requete->bindValue(':catid',(int) $_POST['cat'],PDO::PARAM_INT);
          $requete->execute();
          $data = $requete->fetch();
          echo'<form method="post" action="'.WEBROOT.'majadmin.php?cat=forum&amp;action=edit&amp;e=editc">';
          echo'<label> Indiquez le nom de la catégorie :</label>';
          echo'<input type="text" id="nom" name="nom" value="'.stripslashes(htmlspecialchars($data['CatLibelle'])).'" /><br /><br />';
          echo'<input type="hidden" name="cat" value="'.$_POST['cat'].'" />';
          echo'<input type="submit" value="Envoyer" /></p></form>';
          $requete->CloseCursor();                            
        }
      }
      break;

      default; //action n'est pas remplie, on affiche le menu
      if($_SESSION['droit']==='3')
      {
        echo'<h1>Administration du forum</h1>';
        echo'<a href="'.WEBROOT.'admin.php?cat=forum&amp;action=creer">Creation d\'une catégorie</a><br />
        <a href="'.WEBROOT.'admin.php?cat=forum&amp;action=edit">Edition d\'une catégorie</a><br />
        <a href="'.WEBROOT.'admin.php?cat=forum&amp;action=supprimer"><s>Supprimer une catégorie</s></a><br />';
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
      //Droits d'un membre (rang)
      echo'<h1>Edition des droits d un membre</h1>';  

      if(!isset($_POST['membre']))
      {
        echo'De quel membre voulez-vous modifier les droits ?<br />';
        echo'<br /><form method="post" action="'.WEBROOT.'admin.php?cat=membres&action=droits">
        <p><label for="membre">Inscrivez le pseudo : </label> 
        <input type="text" id="membre" name="membre">
        <input type="submit" value="Chercher"></p></form>';
      }
      else
      {
        $pseudo_d = $_POST['membre'];
        $requete = $bdd->prepare('SELECT UserLogin,UserRole
          FROM user WHERE LOWER(UserLogin) = :pseudo'); 
        $requete->bindValue(':pseudo',strtolower($pseudo_d),PDO::PARAM_STR);
        $requete->execute();
        if ($data = $requete->fetch())
        {       
          echo'<form action="'.WEBROOT.'majadmin.php?cat=membres&amp;action=droits" method="post">';
          $rang = array
          ( 0 => "Banni",
            1 => "Utilisateur Lambda", 
            2 => "Modérateur", 
            3 => "Administrateur");
          echo'<label>'.$data['UserLogin'].'</label>';
          echo'<select name="droits">';
          for($i=0;$i<4;$i++)
          {
            if ($i == $data['UserRole'])
            {
              echo'<option value="'.$i.'" selected="selected">'.$rang[$i].'</option>';
            }
            else
            {
              echo'<option value="'.$i.'">'.$rang[$i].'</option>';
            }
          }
          echo'</select>
          <input type="hidden" value="'.stripslashes($pseudo_d).'" name="pseudo">               
          <input type="submit" value="Envoyer"></form>';
          $requete->CloseCursor();
        }                                                                   
        else echo' <p>Erreur : Ce membre n existe pas, <br />
          cliquez <a href="'.WEBROOT.'admin.php?cat=membres&amp;action=edit">ici</a> pour réessayer</p>';
      }
      break;

      default; //action n'est pas remplie, on affiche le menu 
        echo'<h1>Administration des membres</h1>';
        echo'<a href="'.WEBROOT.'admin.php?cat=membres&amp;action=supprimer"><s>Supprimer un membre</s></a><br />';
        if($_SESSION['droit']==='3')
        {
          echo'<a href="'.WEBROOT.'admin.php?cat=membres&amp;action=droits">Modifier les droits d\'un membre</a><br />';
        }
      break;
    }
    break;
    default;
      echo'<h1>Administration</h1>';
      if($_SESSION['droit']==='3')
      {
        echo'<a href="'.WEBROOT.'admin.php?cat=forum&amp;action=">Administration du forum</a><br />';
      }
      echo'<a href="'.WEBROOT.'admin.php?cat=membres&amp;action=">Administration des membres</a><br /></p>';
    break;
  }
?>
</div></div>

<?php require_once("includes/footer.php"); ?>