forumBVD (BURBAUD VO DARID)
========

Forum - Projet DEESWEB 

un utilisateur a un login, un mdp, un "role" (droit)
-> 0 utilisateur banni
-> 1 utilisateur classique
-> 2 moderateur
-> 3 admin

toute creation se fait de base en utilisateur lambda

seul un admin a acces a l'integralité du site

login/mdp standard :
	admin - password
	moderateur - password
	utilisateur - password
	banni - password

le menu home pointe vers l'index

non connecté :
	le menu inscription permet de creer un compte
	le menu login permet de se logger

connecté
	le menu forum permet d'acceder a l'ecran des categories et topics, qui permet d'acceder a la page des topics/messages
	le menu admin (accessible uniquement pour les modo et admin) permet de gerer les creation de categories et les suppressions de 		membres ainsi que la modification des droits utilisateurs
	logout permet de se deconnecter et revenir au home
	profil permet d'acceder au profil actuellement connecté