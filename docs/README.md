# Documentation

Ici se trouve la documentation technique du développement du jeu

## Liste des fonctionnalités

Une équation mathématique est à résoudre dans un temps imparti.
Un décompte entoure l'équation, c'est le décompte du temps que l'on a pour resoudre l'équation.
À chaque victoire le décompte est raccourci.Quand le joueur se trompe, le décompte est multiplié par 2.

On a un temps fixe pour faire un maximum d'équation.Chaque opération donne 1pts multiplier par la différence entre le max du temps - le temps du décompte (ou du temps mis à répondre.

Le score est la somme des points obtenus dans le temps imparti.

Interface :
- un cercle avec un espace pour le décompte
- dans le cercle un espace de l'équation
- un pavé numérique en dessous pour taper la réponse
- le score en haut à droite qui augmente à chaque réussite
- un menu en haut à gauche pour
  - changer son pseudo
  - avoir accès au tableau des scores
  - recommencer la partie

Ordre de dev :
- Équation
- Pavé numérique
- Vérification
- Compteur et sa gestion augmentation ou diminution
- Score

Amélioration :
- mettre des niveaux dans les equations, avec une API pour le score

## Composants

- Equation :
  - affiche l'équation à résoudre
  - affiche la réponse de l'utilisateur
- Keypad :
  - affiche un page numérique pour la réponse à l'équation
  - met à jour la réponse utilisateur
- MentalCalculation :
  - instancie les composants visuels
  - vérifie la réponse à la touche "Entrer"