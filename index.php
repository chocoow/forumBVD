<?php require_once("includes/header.php"); ?>

    <div class="container theme-showcase" role="main">
        <div class = "jumbotron">
        	<?php
              if($_SESSION['auth']==0)
                {
                	echo "<h1>Hello</h1>";
                	echo "<h3>Veuillez vous identifier via le boutton 'Login'</h3>";
                    $requete = $bdd->prepare('SELECT UserLogin FROM user WHERE UserPassword != ""'); 
                    $requete->execute();
                    $tmp1count = $requete->rowCount();
                    if( $tmp1count > 0)
                    {
                        for ($i = 0; $i < $tmp1count ; $i++) 
                        {
                            extract($requete->fetch());
                            echo '<p>Compte '.($i + 1).' login : '.$UserLogin.'</p>';
                        }
                    }
                    else
                    {
                        setFlash("Aucun compte present en base, allez on s'inscrit !","Danger");
                        echo flash();
                    }
                }
                else
                {
                	echo "<h1>Bonjour ".$_SESSION['login']."</h1>";
                    echo "<h3><b>Consignes : </b></h3>
                            <ol>
                                <li>differents topics</li>
                                <li>triés par categories</li>
                                <li>commentables</li>
                            </ol>
                            <h3>Utilisateur</h3>
                            <ol>
                                <li>s'inscrire</li>
                                <li>Enregistrer une image avatar</li>
                                <li>modifier et supprimer ses propres posts</li>
                            </ol>
                            <h3>Moderateurs</h3>
                            <ol>
                                <li>supprimer tout posts</li>
                                <li>bannir / supprimer tout utilisateur</li>
                                <li>+ droits utilisateurs</li>
                            </ol>
                            <h3>Administrateur</h3>
                            <ol>
                               <li>creation topics</li>
                                <li>creation categories</li>
                                <li>promulgation de droits moderateur/administrateur</li>
                                <li>+ droit modo</li>
                                <li>+ droit utilisateurs</li>
                            </ol>";
                } 
            ?>
        </div>
    </div>
    
<?php require_once("includes/footer.php"); ?>