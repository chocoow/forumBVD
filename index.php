<?php require_once("includes/header.php"); ?>

    <div class="container theme-showcase" role="main">
        <div class = "jumbotron">
        	<?php
              if($_SESSION['auth']==0)
                {
                	echo "<h1>Hello</h1>";
                	echo "<h3>Veuillez vous identifier via le boutton 'Login'</h3>";
                    echo "<h3>comptes standard : </h3><ul><li>admin / password</li><li>moderateur / password</li><li>utilisateur / password</li></ul>";
                }
                else
                {
                	echo "<h1>Bonjour ".$_SESSION['login']."</h1>";
                    echo "<h3>Consignes : </h3>
                            <ol>
                                <li><s>fait : differents topics</s></li>
                                <li><s>fait : triés par categories</s></li>
                                <li><b>commentables</b> (tinymce intégré, reste a faire la page)</li>
                            </ol>
                        <h3>Utilisateur</h3>
                            <ol>
                                <li><s>fait : s'inscrire</s></li>
                                <li><s>fait : Enregistrer une image avatar</s></li>
                                <li><b>modifier/supprimer ses propres posts</b></li>
                            </ol>
                        <h3>moderateurs</h3>
                            <ol>
                                <li><b>supprimer tout posts</b></li>
                                <li><s>fait : bannir</s> a faire : <b>supprimer tout utilisateur standard</b></li>
                                <li>+ droits utilisateurs</li>
                            </ol>
                        <h3>Administrateur</h3>
                            <ol>
                                <li><b>creation topics</b></li>
                                <li><s>fait : creation categories</s></li>
                                <li><s>fait : promulgation de droits moderateur/administrateur </s></li>
                                <li>+ droit modo</li>
                                <li>+ droit utilisateurs</li>
                            </ol>";
                } 
            ?>
        </div>
    </div>
    
<?php require_once("includes/footer.php"); ?>