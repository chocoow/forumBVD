<!DOCTYPE html>
<?php session_start();?>
<?php include("lib/includes.php"); ?>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo WEBROOT; ?>favicon.ico">
    <script type="text/javascript" src="<?php echo WEBROOT; ?>/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">tinymce.init({selector: "textarea#elm1",theme: "modern",
    plugins: ["advlist autolink link lists charmap hr anchor pagebreak ",
         "searchreplace wordcount insertdatetime nonbreaking",
         "contextmenu directionality textcolor"],
    content_css: "css/content.css",
    toolbar: " bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor"}); </script>
    <title>Forum DEESWEB 2014</title>
    <link href="<?php echo WEBROOT; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo WEBROOT; ?>css/bootstrap-theme.min.css" rel="stylesheet">
    <?php if(!isset($_SESSION['auth'])){$_SESSION['auth'] = 0;}?>
  </head>

  <body role="document">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <?php
            if($_SESSION['auth']==0)
            {
              echo '<a class="navbar-brand">DeesWebForum</a>';
            }
            else
            {
              echo '<img src="'.WEBROOT.'images/avatars/'.$_SESSION['membre_avatar'].'" alt="pas d avatar" class="navbar-brand" />';
              echo '<a class="navbar-brand">'.$_SESSION['login'].'</a>';
            }
          ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <?php
              if($_SESSION['auth']==0)
              {
                echo " <li><a href='enregistrer.php'>inscription</a></li>";
                echo " <li><a href='login.php'>Login</a></li>";
              }
              else
              {
                echo " <li><a href='catetopic.php'>Forum</a></li>";

                if($_SESSION['droit']==='2' || $_SESSION['droit']==='3')
                {
                  echo " <li><a href='admin.php'>Administration</a></li>";
                }
                echo " <li><a href='profil.php'>Profil</a></li>";
                echo " <li><a href='logout.php'>Logout</a></li>";
              } 
            ?>
          </ul>
        </div>
      </div>
    </nav>