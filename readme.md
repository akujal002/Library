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
