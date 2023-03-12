# Logiciel de gestion de bibliothèque
Un client nous a demandé de créer pour lui un logiciel de gestion de bibliothèque.
Il doit permettre de référencer les différents ouvrages, et de gérer les réservations.
Son cahier des charges :
* avoir une interface cliente permettant à toustes de rechercher un livre, selon plusieurs critères :
  - Titre (ordre alphabétique),
  - Auteur,
  - Date de publication,
  - Genre (roman, BD, encyclopédie, ...),
  - disponible à la réservation
* Lorsqu'on clique sur un livre depuis cette page de recherche, on voit une page nous présentant ce livre, avec un petit résumé, ... et la possibilité de le réserver, pour passer le récupérer plus tard en bibliothèque.
* Si on veut réserver, il faut s'authentifier.
* Dans l'espace personnel de la personne, on voit ses réservations en cours :
  - Titre du livre,
  - Nom de l'auteur,
  - Genre,
  - date d'emprunt,
  - date de retour,

et la liste de livres mis de côtés, s'il en a. Il pourra supprimer un livre mis de côté s'il a changé d'avis.

Un livre peut avoir plusieurs exemplaires en stock.

* Une seconde interface permettra aux gestionnaires de la bibliothèque d'ajouter, modifier ou supprimer un livre, une réservation, un lecteur.
* Elle aura donc plusieurs onglets, permettant d'afficher :
  - les livres.
    - voir tous les livres // rechercher
    - Ajouter un nouveau
    - modifier
    - supprimer
  - les réservations.
    - voir toutes
    - ajouter
    - modifier
    - supprimer
  - les lecteurs.
    - voir toustes
    - ajouter
    - modifier
    - supprimer

## Activité 1 : Construire la BDD
On commence par établir un MCD du projet.
Rendez-vous sur JMerise ou looping !

## Activité 2 : Faire ses Classes !
Une fois que le MCD est construit, qu'on a sorti le MLD, nous pouvons construire nos classes. Deux dossiers toujours, les Classes, permettant l'interaction client/serveur, et les repositories (activité 3), permettant l'interaction serveur/BDD.

On créera aussi un fichier init.php, permettant de charger la session et les classes en différé.

## Activité 3 : Construire ses repositories
Faites une première classe qui permet d'établir la connexion à la BDD.
Reliez maintenant vos classes à la Base de Données, en créant vos repositories qui contiennent les méthodes du CRUD. Chaque classe a son repository.

## Activité 4 : Codons le tout
Maintenant que nous avons notre BDD, nos classes et nos repositories, nous pouvons passer à l'interface visuelle.

### Interface gestionnaire
Commencez par l'interface gestionnaire : on veut voir 3 onglets, avec le contenu adéquat rangé dans un tableau.

Dans un premier temps, on va recharger la page à chaque demande de changement d'onglet. Pas de JS nous permettant de cacher ou d'afficher des sections accordéon, on a une barre latérale avec le menu, et un contenu unique, qui change au clic sur le menu.
Construisez toutes les pages nécessaires, avec simplement un titre.

### Contenu des pages
Maintenant que vous avez toutes vos pages vides, il faut les remplir.
Nous allons d'abord nous occuper des pages qui affichent tout le contenu (voir tous les livres, réservations, lecteurs).

Récupérez la méthode du repository concerné, et dans une boucle, affichez le contenu ligne après ligne.

### Formulaires
Maintenant qu'on voit tout, on veut ajouter, modifier, supprimer un élément.

Comme le travail est redondant, nous allons nous concentrer uniquement sur la partie réservations. Ne faites pas le visuel des livres ou des lecteurs.

Nous passerons directement par phpmyadmin pour créer ou modifier un livre ou un lecteur.

Dans un premier temps, ces formulaires apparaitront dans le menu latéral, et leur contenu directement dans le contenu principal.

Pour modifier ou supprimer, passez l'id en get. Demandez une confirmation avant suppression.

## Ergonomie

### Popup
Nous n'allons pour l'instant pas créer plus de contenu visuel : Attardons-nous sur les détails.

Plutôt que de renvoyer sur une autre page, nous aimerions pouvoir modifier ou supprimer une réservation dans une popup, lorsqu'on clique sur une action : en bout de ligne, ajoutez une colonne avec deux liens : modifier, supprimer.

Lorsqu'on clique dessus, ça ouvre une popup, dont le contenu est lié à la ligne en question. Modifier nous ouvre un formulaire pré-rempli, supprimer nous demande de confirmer la suppression de la réservation en question.

### Ajax
Actuellement, à chaque fois que nous soumettons le formulaire de suppression ou modification, nous envoyons une demande au serveur, qui traite d'abord la modification ou suppression d'une ligne, puis, pour afficher la page, fait une seconde requête pour récupérer toutes les lignes à afficher.
Cela alourdit le travail du serveur, donc le temps de réponse. Si on a une grosse bibliothèque, on peut se retrouver embêté...

De plus, le gestionnaire voit tout le site se recharger à chaque fois qu'il fait une manip. C'est long, c'est pas pratique, surtout lorsqu'il veut travailler rapidement.

Nous allons donc différer les commandes. Grâce à Ajax, javascript peut appeler le serveur sans recharger toute la page. De cette manière, JS donne des infos au serveur, qui renvoie une réponse, en fonction de laquelle JS modifie l'interface.

Modifiez votre code pour que les formulaires de modification et suppression soient traités en ajax, et la modification visuelle en js.
Si on force le rechargement de la page, on doit avoir le même résultat !

## Sécurité
Nous n'avons pas fait de formulaire d'authentification, pour se concentrer sur ce qui était important. Bien sûr il sera important de le faire !

Mais plus important encore, il faudra limiter les actions ajax aux utilisateurs authentifiés. En effet, empêcher l'affichage du tableau de bord est une chose, empêcher de réaliser des commandes en est une autre. Quelqu'un qui souhaiterait contacter votre serveur le pourrait, si les commandes ne sont pas protégées. Pour cela, nous allons mettre la condition d'authentification pour chaque commande. Si la personne n'est pas connectée, impossible de réaliser la commande côté serveur.

## Pour aller plus loin
### 1/
Vous avez à présent une interface gestionnaire, qui s'occupe juste des réservations. Faites de même pour les livres et les lecteurs.

Comme vous êtes paresseux, faites un code DRY, et essayez de factoriser au maximum votre code !

### 2/
Comment est-ce possible ? Tout le monde peut accéder à l'interface gestionnaire ! Il est temps de créer le formulaire d'authentification ;)

### 3/
Maintenant que votre interface gestionnaire fonctionne à merveille, créons celle des visiteurs :
Faire une page qui affiche tous les livres, avec les filtres donnés dans le cahier des charges.
Lorsqu'on clique sur un livre il s'affiche dans une page dédiée avec ses infos.

### 4/
Il ne nous reste plus qu'à coder l'interface du lecteur :
  - il doit voir ses réservations,
  - peut demander la mise de côté d'un livre qui lui plait, pour passer le récupérer en bibliothèque plus tard.

Créons tout d'abord sont tableau de bord, et affichons ses réservations en cours.

### 5/
Nous pouvons maintenant modifier la page livre, pour ajouter un bouton de mise de côté, qui ne s'affiche que pour les lecteurs authentifiés. Lorsqu'un lecteur clique sur ce bouton, une popup s'ouvre et lui confirme la mise de côté du livre.

Il pourra retrouver dans son tableau de bord tous les livres qu'il a mis de coté, et les supprimer s'il le veut.
